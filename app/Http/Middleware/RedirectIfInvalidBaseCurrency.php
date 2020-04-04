<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Services\CurrencyService as CurrencyService;

class RedirectIfInvalidBaseCurrency
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
        if (empty($user->base_currency) ||
            !CurrencyService::isValidBaseCurrency($user->base_currency)
        ) {
            return redirect('/settings');
        }
        return $next($request);
    }
}
