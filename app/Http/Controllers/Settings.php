<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Services\CurrencyService;
use App\Http\Requests\SettingsRequest;

use Auth;
use Log;

class Settings extends Controller
{

    public function index()
    {
        $currencies = CurrencyService::getCurrencyOptions();
        return view('settings/overview', [
            'user' => Auth::user(),
            'currencies' => collect(array_keys($currencies)),
        ]);
    }

    public function saveSettings(SettingsRequest $r)
    {

// pending referrals - show "User"
// facebook OG name

        $user = Auth::user();
        $user->hide_name = $r->input('hide_name', false);
        $user->save();
        return redirect('/settings');
    }

}
