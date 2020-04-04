<?php

namespace App\Services;

use App\User;

class ReferralService
{
    const BASE_URL = '/r';
    const CODE_LENGTH = 10;

    public static $doingReferralUrl = false;

    public static function generateUserUrl(User $user)
    {
        return url(sprintf(
            '%s/%s',
            self::BASE_URL,
            urlencode($user->referralCode())
        ));
    }

    /**
     * Ensures we have a unique code for each user's referral code
     *
     * @return string   Unique referral code for this user.
     */
    public static function generateReferralCode()
    {
        // Ensure we have a unique code
        do {
            $code = substr(md5(uniqid('', true)), 0, self::CODE_LENGTH);
            $user = \App\User::where('referral_code', $code)->first();
            $notUnique = !empty($user);
        } while ($notUnique);
        return $code;
    }

    public static function isDoingReferralUrl()
    {
        return self::$doingReferralUrl;
    }

    public static function getUrlCode()
    {
        $request = request();
        return $request->code;
    }

}
