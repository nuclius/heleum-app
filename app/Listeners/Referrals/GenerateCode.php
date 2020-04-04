<?php

namespace App\Listeners\Referrals;

use App\Events\UserLogin;
use App\Services\ReferralService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class GenerateCode
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
        if (empty($user->referral_code)) {
            $code = ReferralService::generateReferralCode();
            $user->referral_code = $code;
            $user->save();
        }
    }
}
