<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\UserLogin;
use App\Services\UpholdAPI;
use App\Boost;
use App\User;
use Carbon\Carbon;
use Uphold\Model\User as UpholdUser;
use Uphold\UpholdClient;


use Auth;
use Cookie;
use Log;

class Login extends Controller
{

    public function redirectToUphold()
    {
        // Need the UpholdAPI class initialized with the config vars
        resolve('UpholdAPI');
        $url = sprintf(
            'https://%s/authorize/%s?scope=%s&state=%s&intention=login',
            UpholdAPI::$domain,
            UpholdAPI::$client_id,
            UpholdAPI::$client_scope,
            UpholdAPI::$client_state
        );
        return redirect($url);
    }

    public function upholdAuthorize(Request $r)
    {
        if (self::isValidRequest($r)) {
            self::logUserIn($r);
            $user = Auth::user();
            if (count($user->fundings) > 0) {
                return redirect('/account');
            } else if (!$user->isVerified()) {
                return redirect('/account');
            } else {
                return redirect('/add-funds');
            }
        } else {
            throw new Exception('Invalid request from uphold.');
        }
    }

    protected static function logUserIn(Request $r)
    {
        $api = resolve('Uphold\UpholdClient');
        $upholdUser = $api->authorizeUser($r->input('code'));
        $user = User::where('uphold_id', $upholdUser->id)->first();
        if (empty($user)) {
            $user = User::where('email', $upholdUser->getEmail())->first();
            if ($user) {
                $user->uphold_id = $upholdUser->id;
                $user->save();
            } else {
                $user = self::createUser($upholdUser);
            }
        }
        Auth::login($user);

        // Always refresh some information whenever a login happens
        self::refreshUserInformation($user, $upholdUser);

        // Do Beta Boost till Nov 23, 2017 Pacific Time
        $endDate = new Carbon('November 23, 2017', 'America/Los_Angeles');
        $now = Carbon::now();
        if ($now->lt($endDate) && !Boost::userHasBetaBoost($user->user_id)) {
            Boost::createBetaBoost($user->user_id);
        }


        event(new UserLogin($user, $upholdUser));

    }

    /**
     * Populates the fields we can change locally, with latest information from
     * the UpholdUser object.
     *
     * @param  App\User          $user       User to update
     * @param  Uphold\Model\User $upholdUser The UpholdUser object to pull data from
     *
     * @return null
     */
    protected static function refreshUserInformation(User $user, UpholdUser $upholdUser)
    {
        $user->token           = $upholdUser->getClient()->getOption('bearer');
        $user->has_valid_token = true;
        $user->uphold_username = $upholdUser->getUsername() === NULL ? ' ' : $upholdUser->getUsername();
        $user->first_name      = $upholdUser->getFirstName() === NULL ? ' ' : $upholdUser->getFirstName();
        $user->last_name       = $upholdUser->getLastName() === NULL ? ' ' : $upholdUser->getLastName();
        $user->name            = $upholdUser->getName() === NULL ? ' ' : $upholdUser->getName();
        $user->email           = $upholdUser->getEmail();
        $user->country         = $upholdUser->getCountry();
        $user->state           = $upholdUser->getState() === NULL ? ' ' : $upholdUser->getState();
        $user->address         = self::generateAddress($upholdUser) === NULL ? ' ' : self::generateAddress($upholdUser);
        if (count($user->fundings) === 0) {
            // base currency can change up until they make their first funding
            $user->base_currency = $upholdUser->getSettings()['currency'];
        }
        if (!empty($upholdUser->memberAt)) {
            // only populate the verified_at if we have data for it
            $user->verified_at  = \Carbon\Carbon::parse($upholdUser->memberAt)->format('Y-m-d H:i:s');
        }
        $user->save();
    }

    protected static function createUser(UpholdUser $upholdUser)
    {
        $user = new User();
        $user->uphold_username = $upholdUser->getUsername() === NULL ? ' ' : $upholdUser->getUsername();
        $user->base_currency   = $upholdUser->getSettings()['currency'] === NULL ? 'USD' : $upholdUser->getSettings()['currency'];
        $user->token           = $upholdUser->getClient()->getOption('bearer');
        $user->member_since    = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $user->first_name      = $upholdUser->getFirstName() === NULL ? ' ' : $upholdUser->getFirstName();
        $user->last_name       = $upholdUser->getLastName() === NULL ? ' ' : $upholdUser->getLastName();
        $user->name            = $upholdUser->getName() === NULL ? ' ' : $upholdUser->getName();
        $user->email           = $upholdUser->getEmail();
        $user->country         = $upholdUser->getCountry();
        $user->state           = $upholdUser->getState() === NULL ? ' ' : $upholdUser->getState();
        $user->address         = self::generateAddress($upholdUser) === NULL ? ' ' : self::generateAddress($upholdUser);
        $user->ok_to_batch     = $user->isOkToBatch();
        $user->uphold_id       = $upholdUser->id;
        \Log::debug('Creating User from upholdUser:');
        \Log::debug(json_encode($upholdUser));
        \Log::debug(json_encode($user));
        $user->save();
        return $user;
    }

    protected static function generateAddress(UpholdUser $upholdUser)
    {
        $addressFormat = '%s, %s%s, %s';
        $address = sprintf($addressFormat,
            !empty($upholdUser->address['line1']) ? $upholdUser->address['line1'] : 'No Address1',
            // line2 is optional, so it takes care of the trailing comma itself if needed.
            !empty($upholdUser->address['line2']) ? $upholdUser->address['line2'] . ', ' : '',
            !empty($upholdUser->address['city']) ? $upholdUser->address['city'] : 'No City',
            !empty($upholdUser->address['zipCode']) ? $upholdUser->address['zipCode'] : 'No Zip'
        );
        return $address;
    }

    protected static function isValidRequest(Request $r)
    {
        // Need the UpholdAPI class initialized with the config vars
        resolve('UpholdAPI');

        $code = $r->input('code');
        $state = $r->input('state');
        return (!empty($code) && $state === UpholdAPI::$client_state);
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/?loggedOut');
    }

}
