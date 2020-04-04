<?php

namespace App\Services;

use Auth;
use App\User;

class SocialService
{
    public static function openGraphTags()
    {
        return;
    }
    public static function facebookShareUrl()
    {
        $referralUrl = ReferralService::generateUserUrl(Auth::user());
        return url(sprintf(
            '%s/%s',
            self::BASE_URL,
            urlencode($user->referralCode())
        ));
    }
}
