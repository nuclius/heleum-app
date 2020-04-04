<?php

namespace App\Listeners\ActiveCampaign;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\UserLogin as UserLoginEvent;
use Carbon\Carbon;
use Log;

class UserLogin
{
    /**
     * Array of tags to sign the user up with.
     */
    const TAGS = [
        'app',
    ];

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserLoginEvent $event)
    {
        $user = $event->user;
        $upholdUser = $event->upholdUser;
        Log::info('Doing ActiveCampaign Contact Sync');


        $contact = [
            'email'              => $user->email,
            'first_name'         => $user->first_name,
            'last_name'          => $user->last_name,
            'tags'               => implode(', ', self::TAGS),
            'field[%COUNTRY%,0]'       => $user->country,
            'field[%CURRENCYBASE%,0]'  => $user->base_currency,
            'field[%MEMBER_SINCE%,0]'  => $user->member_since,
            'field[%VERIFIED_AT%,0]'   => $user->verified_at,
            'field[%REFERRAL_CODE%,0]' => $user->referral_code,
            'field[%CODE_VERSION%,0]'  => $user->code_version,
            'field[%OK_TO_BATCH%,0]'   => $user->ok_to_batch,
            'field[%REFERRAL_LINK%,0]' => $user->referralCodeUrl(),
            'field[%TERMS%,0]'         => 'I agree to the terms',
            'field[%LATEST_LOGIN%,0]'  => Carbon::now()->format('Y-m-d'),
            // Remaining items from example documentation
            // 'p[{$list_id}]'      => $list_id,
            // 'status[{$list_id}]' => 1, // "Active" status
        ];
        $referrer = $user->getReferredBy();
        if (!empty($referrer)) {
            $contact['field[%REFERRED_BY%,0]'] = sprintf(
                '%s %s',
                $referrer->first_name, $referrer->last_name
            );
            $contact['field[%REFERRED_BY_EMAIL%,0]'] = $referrer->email;
        }
        Log::debug('Contact: '.print_r($contact, true));
        $activeCampaign = resolve('ActiveCampaign');
        $r = $activeCampaign->api('contact/sync', $contact);
        if ($r->success) {
            Log::info(sprintf(
                'Successfully updated contact (email: %s)',
                $contact['email']
            ));
        } else {
            Log::error(sprintf(
                'Error syncing contact to ActiveCampaign.  Contact (%s), Response (%s)',
                print_r($contact, true),
                print_r($r, true)
            ));
        }

    }
}
