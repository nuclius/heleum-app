<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use Carbon\Carbon;

class Referral extends Model
{
    /**
     * The name that should appear for referrals if the user
     * chooses to "hide_name".
     *
     * @var String
     */
    const DEFAULT_NAME = 'User';

    /**
     * How many days must someone wait till their referral is marked as a boost
     *
     * @var int
     */
    const FUNDING_BOOST_WAITING_DAYS = 30;

    /**
     * Referred User account
     *
     * @var \App\User
     */
    protected $referredUser = null;

    /**
     * Properties that should be converted to Carbon Dates
     *
     * @var array
     */
    protected $dates = [
        'first_funding_timestamp',
    ];

    /**
     * Attempts to find the referred user object
     *
     * @return \App\User | null
     */
    protected function referredUser()
    {
        if (empty($this->referredUser)) {
            $user = User::find($this->referred_id);
            if (!empty($user)) {
                $this->referredUser = $user;
            }
        }
        return $this->referredUser;
    }

    /**
     * Gets the name of the user who is referred.
     *
     * If that user has chosen to hide his name, this
     * class' DEFAULT_NAME is used.
     *
     * @return string
     */
    public function referredName()
    {
        $name = '';
        $user = $this->referredUser();
        if (empty($user)) {
            $name = ($user->hide_name)
                ? self::DEFAULT_NAME
                : $this->referred;
        }
        return $name;
    }

    public function getTimeTillBoostActivation()
    {
        $r = 'No Active Funds';
        $user = $this->referredUser();
        if ($user && !$user->isVerified()) {
            $r = 'Not Uphold Verified';
        }
        if (!empty($this->first_funding_timestamp) && $this->referred_balance > 0) {
            $funding = $this->first_funding_timestamp;
            $boostDay = $funding->copy()->addDays(self::FUNDING_BOOST_WAITING_DAYS);
            if ($boostDay->isPast()) {
                $r = 0;
            } else if ($boostDay->diffInDays() === 1) {
                $r = sprintf('%s day left', $boostDay->diffInDays());
            } else if ($boostDay->diffInDays() > 1) {
                $r = sprintf('%s days left', $boostDay->diffInDays());
            } else {
                $r = sprintf('%s hours left', $boostDay->diffInHours());
            }
        }
        if (!empty($this->first_funding_timestamp) && $this->referred_balance === 0) {
            $r = 'No Active Funds';
        }
        return $r;
    }
}
