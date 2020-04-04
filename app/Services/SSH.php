<?php

namespace App\Services;

use Auth;
use Cache;
use Log;

// use App\UpholdCard;

class SSH
{
    private static $coreServer = '138.197.209.8';
    private static $connection = null;
    private static $username = 'heleum';
    public static function connect()
    {
        if (is_null(self::$connection)) {
            self::$connection = ssh2_connect(self::$coreServer, 22, array('hostkey'=>'ssh-rsa'));
            $r = ssh2_auth_pubkey_file(
                self::$connection,
                self::$username,
                self::publicKeyFile(),
                self::privateKeyFile()
            );
            if ($r) {
              echo "Public Key Authentication Successful\n";
            } else {
              echo 'Public Key Authentication Failed';
            }
        }
    }

    public static function sendCommand($command = '')
    {
        $email = 'matthewgrichmond@gmail.com';
        $createDate = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $user_token = 'foobartoken';
        $user_base_currency = 'GBP';

        $command = sprintf(
            "python3 -c 'from /home/heleum/Programs/account_admin import AccountAdmin; aa = AccountAdmin(); user = [\"%s\",\"%s\",\"%s\",\"%s\"]; aa.create_user(user);'",
            $email, $createDate, $user_token, $user_base_currency
        );

        self::connect();
        $stream = ssh2_exec(self::$connection, $command);
        $output = stream_get_contents($stream);
        fclose($stream);
        return $output;
    }

    protected static function keyFilePath()
    {
        $path = base_path().'/resources/ssh';
        return $path;
    }

    private static function publicKeyFile()
    {
        $keyfile = self::keyFilePath().'/public.key';
        return $keyfile;
    }

    private static function privateKeyFile()
    {
        $keyfile = self::keyFilePath().'/private.key';
        return $keyfile;
    }
}
