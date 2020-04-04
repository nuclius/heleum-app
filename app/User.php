<?php

namespace App;

use CurrencyService;

use Illuminate\Notifications\Notifiable;
use App\Auth\Heleum\User as Authenticatable;

use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * Our current database doesn't have created_at OR updated_at
     * so we have to turn this off from trying to update those
     * when a Model is saved.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Calculates the user's funded balance in addition to the balloon change
     * amounts.
     *
     * @return float
     */
    public function getBalance()
    {
        $balloonChanges = $this->activeBalloonChanges();
        return round($this->funded_balance + $balloonChanges, 2);
    }

    /**
     * Retrieves the current balloon change amounts, not total balloon amounts,
     * for all active balloons.
     *
     * @return float
     */
    public function activeBalloonChanges()
    {
        $balloons = $this->activeBalloons();
        $balloonChanges = $balloons->sum(function($balloon){
            return $balloon->getAmountChange();
        });
        return round($balloonChanges, 2);
    }


    /**
     * Retrieves the current balloon amounts for all active balloons.
     *
     * @return float
     */
    public function activeBalloonAmount()
    {
        $balloons = $this->activeBalloons();
        $amount = $balloons->sum(function($balloon){
            return $balloon->launch_amount + $balloon->getAmountChange();
        });
        return round($amount, 2);
    }

    /**
     * Retrieves the current balloon amounts for all active balloons.
     *
     * @return float
     */
    public function activeBalloonLaunchAmount()
    {
        $balloons = $this->activeBalloons();
        $amount = $balloons->sum(function($balloon){
            return $balloon->getLaunchAmount();
        });
        return round($amount, 2);
    }


    /**
     * Returns 1% over the current balance of the balloons for some wiggle room.
     *
     * !!!! THIS AMOUNT SHOULD NEVER BE SHOWN TO USER !!!!
     *
     * @return float
     */
    public function getMaxWithdrawlAmount()
    {
        $balance = $this->getBalance();
        return ($balance * 1.01);
    }

    public function getFundedBalance()
    {
        return $this->funded_balance;
    }

    public function getPast7DaysPerformance()
    {
        return 'my 7 day performance';
    }

    public function getBaseCurrency()
    {
        return $this->base_currency;
    }

    public function getBaseCurrencySymbol()
    {
        return CurrencyService::convertCurrencyToMark($this->getBaseCurrency());
    }

    public function getUpholdId()
    {
        return $this->uphold_id;
    }

    /**
     * Returns if the member is verified or not.  This is indicated in their
     *
     * @return boolean
     */
    public function isVerified()
    {
        return !empty($this->verified_at);
    }

    /**
     * Returns if the user is in New York.
     *
     * @return boolean
     */
    public function isNewYorker()
    {
        return (strtoupper($this->state) === 'US-NY');
    }

    /**
     * Returns if the user is 'php.brownbag@paceellsworth.com'.
     *
     * @return boolean
     */
    public function isPhpBrownbag()
    {
        return ($this->email === 'php.brownbag@heleum.com');
    }

    /**
     * Check if a user is alright to batch (kick off code)
     *
     * @return boolean
     */
    public function isOkToBatch()
    {
        $hasFundings = count($this->fundings) > 0;
        $hasToken = !empty($this->token);
        $hasFundedBalance = !empty($this->funded_balance);
        return $hasFundings && $hasToken && $hasFundedBalance;
    }

    public function activeBalloons()
    {
        static $activeBalloons = null;
        if (is_null($activeBalloons)) {
            $activeBalloons = $this->balloons()
                ->where('active', true)
                ->where('nullified', false)
                ->orderBy('user_balloon_id', 'DESC')
                ->get();
        }
        return $activeBalloons;
    }
    public function poppedBalloons()
    {
        static $poppedBalloons = null;
        if (is_null($poppedBalloons)) {
            $poppedBalloons = $this->balloons()
                ->where('active', false)
                ->where('nullified', false)
                ->orderBy('user_balloon_id', 'DESC')
                ->get();
        }
        return $poppedBalloons;
    }
    public function balloons()
    {
        return $this->hasMany(Balloon::class, 'heleum_user', 'user_id');
    }

    /**
     * Returns the NET amount of Gains minus Heleum Fee
     *
     * @return float Gains minus Heleum Fee
     */
    public function getGainAmount()
    {
        $poppedBalloons = $this->poppedBalloons();
        $balloonIds = $poppedBalloons->pluck('balloon_id');
        $pops = Pop::whereIn('balloon', $balloonIds)->get();
        $popGainAmount = $pops->sum('pop_amount_gains');
        $heleumAmount = $pops->sum('heleum_fee_amount');
        return $popGainAmount - $heleumAmount;
    }

    /**
     * Summation of all active balloons current amounts
     *
     * @return float Sum of all active balloons' current amounts
     */
    public function getUnrealizedGainAmount()
    {
        $activeBalloons = $this->activeBalloons();
        $amount = $activeBalloons->sum(function($balloon){
            return $balloon->getAmountChange();
        });
        return $amount;
    }

    /**
     * Returns all the fundings and withdrawals, combined and sorted desc
     *
     * @return Collection
     */
    public function accountHistory()
    {
        $fundings = $this->fundings;
        $withdrawals = $this->withdrawals;
        $fees = $this->fees;
        $history = $fundings->concat($withdrawals);
        $history = $history->concat($fees);
        return $history->sortByDesc('timestamp');
    }

    public function fees()
    {
        return $this->hasMany(Fee::class, 'heleum_user', 'user_id');
    }

    public function fundings()
    {
        return $this->hasMany(Funding::class, 'heleum_user', 'user_id');
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class, 'heleum_user', 'user_id');
    }



    /*************************************************
    ******************** BOOSTS **********************
    *************************************************/

    public function boosts()
    {
        return $this->hasMany(Boost::class, 'heleum_user', 'user_id');
    }
    public function boostsSum()
    {
        $boosts = $this->boosts;
        $totalBoosts = $boosts->sum('percentage');
        return $totalBoosts;
    }
    public function hasBoosts()
    {
        $boosts = $this->boosts;
        return ($boosts->count() > 0);
    }
    public function hasBetaBoost()
    {
        $betaBoosts = $this->boosts()->where('type', 'beta')->get();
        return ($betaBoosts->count() > 0);
    }

    /**
     * Referrals who have not yet funded, or who funded within the past 30 days
     *
     * @return Collection of Referral objects
     */
    public function pendingBoosts()
    {
        $referrals = $this->referrals()
                        ->where(function($q){
                            $q->whereNull('first_funding_timestamp');
                            $q->orWhereBetween(
                                'first_funding_timestamp',
                                [
                                    Carbon::now()->subDays(30)->format('Y-m-d H:i:s'),
                                    Carbon::now()->format('Y-m-d H:i:s')
                                ]
                            );
                        })
                        ->orderBy('first_funding_timestamp', 'desc')
                        ->orderBy('referred', 'asc')
                        ->get();
        $timestamps = collect([]);
        $verifieds = collect([]);
        $notActives = collect([]);
        // Bucketize each referral, so we can sort them each differently.
        $referrals->each(function($referral, $key) use ($timestamps, $verifieds, $notActives) {
            if (empty($referral->first_funding_timestamp)) {
                $user = User::find($referral->referred_id);
                if ($user->isVerified()) {
                    $verifieds->push($referral);
                } else {
                    $notActives->push($referral);
                }
            } else {
                $timestamps->push($referral);
            }
        });
        $timestamps = $timestamps->sortBy('first_funding_timestamp');
        $verifieds = $verifieds->sortBy('referred');
        $notActives = $notActives->sortBy('referred_email');
        return collect(array_merge($timestamps->all(), $verifieds->all(), $notActives->all()));
    }

    /*************************************************
    ******************* REFERRALS ********************
    *************************************************/

    /**
     * Returns this user's referral code
     *
     * @return string
     */
    public function referralCode()
    {
        return $this->referral_code;
    }

    /**
     * Returns this user's referral URL
     *
     * @return string
     */
    public function referralCodeUrl()
    {
        return \App\Services\ReferralService::generateUserUrl($this);
    }

    /**
     * Returns the App\User object for the person who referred this user.
     *
     * @return null|Object
     */
    public function getReferredBy()
    {
        $referrer = null;
        if (!empty($this->referred_by)) {
            $referrer = User::find($this->referred_by);
        }
        return $referrer;
    }

    /**
     * Returns all Referrals that a user has
     *
     * @return QueryBuilder
     */
    public function referrals()
    {
        return $this->hasMany(\App\Referral::class, 'heleum_user', 'user_id');
    }





    public function getMinimumAddFundsAmount()
    {
        return CurrencyService::getMinimumForCurrency($this->getBaseCurrency());
    }

    public function hasValidBaseCurrency()
    {
        return CurrencyService::isValidBaseCurrency($this->base_currency);
    }

    public function possessiveFirstName()
    {
        $firstName = $this->first_name;
        if (!empty($firstName)) {
            $firstName .= "'".($firstName[strlen($firstName) - 1] != 's' ? 's' : '');
        }
        return $firstName;
    }
}
