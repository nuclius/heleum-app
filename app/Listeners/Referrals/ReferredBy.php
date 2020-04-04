<?php

namespace App\Listeners\Referrals;

use App\Events\UserLogin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use Cookie;

class ReferredBy
{
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
     * @param  UserLogin  $event
     * @return void
     */
    public function handle(UserLogin $event)
    {
        $user = $event->user;
        // Save referred_by code as needed
        if (empty($user->referred_by)) {
            $referredBy = Cookie::get('referral_code');
            if ($referredBy) {
                $referrer = User::where('referral_code', $referredBy)->first();
                if ($referrer) {
                    // Don't let people refer themselves
                    if ($user->user_id != $referrer->user_id) {
                        $user->referred_by = $referrer->user_id;
                        $user->save();
                    }
                }
            }
        }
    }
}
