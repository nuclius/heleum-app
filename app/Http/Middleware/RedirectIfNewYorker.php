<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RedirectIfNewYorker
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
        if ($user->isNewYorker()) {
            return redirect('/service-unavailable');
        }
        return $next($request);
    }
}
