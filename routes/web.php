<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider withi n a group which
| contains the "web" middleware group. Now create something great!
|
*/

use \App\Services\CurrencyService;

Route::middleware(['auth', 'no-newyorkers', 'validBaseCurrency'])->group(function() {

    // Adding funds
    Route::view('/add-funds', 'add-funds.index');
    Route::get('/add-funds/uphold', 'AddFunds@showUpholdCardForm');
    Route::post('/add-funds/review-and-confirm', 'AddFunds@reviewAndConfirm');
    Route::post('/add-funds/transfer-funds', 'AddFunds@transferFunds');
    Route::view('/add-funds/transaction-complete', 'add-funds.transaction-complete');


    // Withdrawing Funds
    Route::view('/withdraw-funds', 'withdraw-funds.index');
    Route::get('/withdraw-funds/uphold', 'WithdrawFunds@showUpholdCardForm');
    Route::post('/withdraw-funds/review-and-confirm', 'WithdrawFunds@reviewAndConfirm');
    Route::post('/withdraw-funds/transfer-funds', 'WithdrawFunds@transferFunds');
    Route::view('/withdraw-funds/transaction-complete', 'withdraw-funds.transaction-complete');

    // Account
    Route::get('/account', 'Account@index');
    Route::get('/account/csv', 'CSV@list');
    Route::post('/account/csv', 'CSV@download');
    Route::get('/balloon/{balloonId}', function($balloonId) {
        $balloon = \App\Balloon::where('user_balloon_id', $balloonId)
            ->where('heleum_user', Auth::id())
            ->where('nullified', false)
            ->with('transactions.latestAmounts')
            ->first();
        if (empty($balloon)) {
            abort(404, sprintf('Sorry, but balloon %d could not be found.', $balloonId));
        }
        $data = [
            'balloon' => $balloon,
        ];
        return view('balloon.detail', $data);
    });

    Route::get('/history', function() {
        return view('history.overview', [
            'accountTxns' => Auth::user()->accountHistory()
        ]);
    });

    Route::get('/statistics', function() {
        $user = Auth::user();
        $realizedGainAmount = $user->getGainAmount();
        $unrealizedAmount = $user->getUnrealizedGainAmount();
        return view('statistics', [
            'user' => Auth::user(),
            'gainAmount' => $realizedGainAmount,
            'unrealizedAmount' => $unrealizedAmount,
        ]);
    });

    Route::get('/boosts', function() {
        $user = Auth::user();

        $boostPercentage = $user->boostsSum() * 100;
        $maxPercentage = 40;
        if ($boostPercentage > $maxPercentage) {
            $boostPercentage = $maxPercentage;
        }
        return view('boosts.overview', [
            'user' => $user,
            'boostPercentage' => $boostPercentage,
        ]);
    });
});

Route::middleware('admins')->group(function(){
    Route::get('/cards', function () {
        $userId = Auth::id();
        return \App\Card::where('heleum_user', $userId)->get();
    });

    Route::get('/info', function() {
        phpinfo();
        die();
    });

    Route::get('/populateUpholdUserId', function() {
        $validUsers = $invalidUsers = [];
        \App\User::whereNull('uphold_id')->where('has_valid_token', true)->chunk(200, function($users) use ($validUsers, $invalidUsers) {
            foreach ($users as $user) {
                try {
                    $upholdUser = \App\Services\UpholdAPI::getUser($user->token);
                } catch (\Exception $e) {
                    echo $e->getMessage()."<br>";
                    $user->has_valid_token = false;
                    $user->save();
                    echo "Bad Token: ".$user->email."<br>";
                    $invalidUsers[$user->user_id] = $user;
                    continue;
                }
                if (!empty($upholdUser->id)) {
                    $user->uphold_id = $upholdUser->id;
                    $user->save();
                    $validUsers[$user->user_id] = $user;
                } else {
                    $invalidUsers[$user->user_id] = $user;
                }
            }
            dd(compact('validUsers', 'invalidUsers'));
        });
    });
});

Route::middleware(['auth', 'no-newyorkers'])->group(function() {
    Route::get('/settings', 'Settings@index');
    Route::post('/settings', 'Settings@saveSettings');

    Route::post('/settings/save-currency', function(\Illuminate\Http\Request $r) {
        $inboundCurrency = $r->input('currency');
        $currencies = CurrencyService::getCurrencyOptions();
        if (!CurrencyService::isValidBaseCurrency($inboundCurrency)) {
            return redirect('/settings?invalid_currency');
        }
        $user = Auth::user();
        $user->base_currency = strtoupper($inboundCurrency);
        $user->save();
        return redirect('/settings')->with('updatedCurrency', $user->base_currency);
    });
});


Route::get('/r/{code}', function($code) {
    \App\Services\ReferralService::$doingReferralUrl = true;
    \Cookie::queue('referral_code', $code, 10);
    $user = Auth::user();
    if ($user) {
        $referrer = \App\User::where('referral_code', $code)->first();
        if ($referrer) {
            // Don't let people refer themselves
            if ($user->user_id != $referrer->user_id) {
                $user->referred_by = $referrer->user_id;
                $user->save();
            }
            return redirect('/account');
        }
    }
    return view('landing');
});

Route::get('/throwerror', function(){
    throw new Exception('Testing Exception');
});


# Need a route with different path, so the "name" will stick, and the
# auth middleware (which redirects by "name") will work.
Route::get('/uphold-login', function () {
    return redirect('/login');
})->name('login');


# Force Login Route handling
$r = Route::get('/forceloginas/{id}', function($id) {
    if (is_numeric($id)) {
        $user = \App\User::find($id);
    } else {
        $looksLikeEmail = (filter_var($id, FILTER_VALIDATE_EMAIL) !== false);
        if ($looksLikeEmail) {
            $user = \App\User::where('email', $id)
                ->orderBy('user_id', 'ASC')
                ->first();
        } else {
            $user = \App\User::where('uphold_username', $id)
                ->orderBy('user_id', 'ASC')
                ->first();
        }
    }

    if (empty($user)) {
        dd(sprintf('No User Found by: %s', $id));
    }

    \Auth::login($user);
    return redirect('/account');
});
if (!app()->isLocal()) {
    $r->middleware('admins');
}

Route::get('/service-unavailable', function() {
    return view('service-unavailable', ['user' => Auth::user()]);
});


# Logged out routes
Route::get('/', function() {
    return view('landing');
});
Route::get('/login', 'Login@redirectToUphold');
Route::get('/authorize', 'Login@upholdAuthorize');
Route::get('/logout', 'Login@logout');






# Migration of static routes
$migratedFiles = [
    'balloon-launched',
    'landing',
    'launch-balloon',
    'referrals',
    'review-and-confirm',
    'select-bank-account',
    // 'settings', No Settings page
    // 'support',
    'transaction-detail',
    'withdraw-complete-transaction',
    'withdraw-review-and-confirm',
    'withdraw-select-bank-account',
    'withdraw-select-uphold-card',
    'withdraw',
];
foreach ($migratedFiles as $filename) {
    Route::get('/'.$filename, function() use ($filename) {
        return view($filename);
    });
}



















