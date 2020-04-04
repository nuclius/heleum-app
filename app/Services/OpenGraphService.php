<?php

namespace App\Services;

class OpenGraphService
{
    const DEFAULT_TITLE = 'Heleum - Let your money move you';
    const DEFAULT_DESCRIPTION = 'Accelerate your long-term savings with Heleum.';

    // FB wants a different name for each image, otherwise it'll never change.
    // Leave the old images in place, so old stories with image will still work!!!
    const IMAGE_PATH = '/images/social/80f41c28dea902e8c8c343d77f3537ca5e49c739.jpg';

    public static function getUrl()
    {
        $url = secure_url('/');
        if (ReferralService::isDoingReferralUrl()) {
            $request = request();
            $path = $request->path();
            $url = secure_url($path);
        }
        return $url;
    }


    public static function getType()
    {
        // This is the best fit I could find here:
        // https://developers.facebook.com/docs/reference/opengraph#object-type
        return 'website';
    }


    public static function getTitle()
    {
        $title = self::DEFAULT_TITLE;
        // ... do anything to modify $title here
        return $title;
    }


    public static function getDescription()
    {
        $description = self::DEFAULT_DESCRIPTION;
        if (ReferralService::isDoingReferralUrl()) {
            $code = ReferralService::getUrlCode();
            $user = \App\User::where('referral_code', (string) $code)->first();
            if ($user && !$user->hide_name) {
                $possessiveFirst = $user->possessiveFirstName();
                if (!empty($possessiveFirst)) {
                    $description = sprintf(
                        '%s Referral Page | %s',
                        $possessiveFirst,
                        $description
                    );
                }
            }
        }
        return $description;
    }


    public static function getImage()
    {
        $useSSL = true;
        $image = asset(self::IMAGE_PATH, $useSSL);
        return $image;
    }

    public static function getImageWidth()
    {
        $filePath = public_path(self::IMAGE_PATH);
        return getimagesize($filePath)[0];
    }
    public static function getImageHeight()
    {
        $filePath = public_path(self::IMAGE_PATH);
        return getimagesize($filePath)[1];
    }

}
