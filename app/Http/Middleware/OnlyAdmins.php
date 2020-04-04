<?php

namespace App\Http\Middleware;

use App\User;

use Auth;
use Closure;


class OnlyAdmins
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (empty($user) || !self::isUserAnAdmin($user))
        {
            abort(404);
        }
        return $next($request);
    }

    /**
     * Checkes to see if a user is an admin
     *
     * @param  App\User  $user User object
     *
     * @return boolean
     */
    public static function isUserAnAdmin(User $user)
    {
        $admin_usernames = [
            'helium',             // pace@heleum.com
            'heleum',             // support@heleum.com
            'bigdawggi',          // matt@bigdawggi.com
            'Pace',               // paceme@gmail.com
            'skylerjcollins',     // skylercollins@gmail.com
            'kamikazechipmunk',   // david.hamaker@gmail.com
        ];

        return in_array($user->uphold_username, $admin_usernames);
    }
}
