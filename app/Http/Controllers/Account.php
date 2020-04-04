<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\UpholdAPI;

use Auth;
use Log;

use App\Balloon;
use App\Services\CurrencyService;


class Account extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $performance7Day = $user->getPast7DaysPerformance();
        $performance7DaySymbol = ($performance7Day >= 0.00) ? '+' : '-';
        $activeBalloons = $user->activeBalloons();
        $poppedBalloons = $user->poppedBalloons();
        $data = [
            'activeBalloonAmounts' => $user->activeBalloonAmount(),
            'notInBalloons' =>  ($user->funded_balance - $user->activeBalloonLaunchAmount()),
            'balance' => $user->getBalance(),
            'currency' => $user->getBaseCurrency(),
            'currencyMark' => CurrencyService::convertCurrencyToMark($user->getBaseCurrency()),
            'performance7DaySymbol' => $performance7DaySymbol,
            'performance7Day' => $performance7Day,
            'activeBalloons' => $activeBalloons,
            'poppedBalloons' => $poppedBalloons,
        ];
        Log::debug('Account Data', ['data' => $data]);
        return view('account.overview', $data);
    }
}
