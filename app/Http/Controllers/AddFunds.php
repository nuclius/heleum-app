<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AddFundsConfirmationRequest;
use App\Http\Requests\AddFundsTransferRequest;
use App\IoOrder;
use App\Services\CurrencyService;
use App\Services\UpholdAPI;

use Auth;
use Log;

class AddFunds extends Controller
{

    /**
     * Seconds to sleep before confirmation page.  This
     * allows the order to potentially be processed
     * before page load, and avoids confusion for user.
     */
    const SLEEP_TIME = 5;


    public function showUpholdCardForm()
    {
        $user = Auth::user();
        $baseCurrency = $user->getBaseCurrency();
        $currencyMark = $user->getBaseCurrencySymbol();

        $cards = UpholdAPI::getUserCards();
        # Only allow cards that match the user's base currency.
        # No conversion of currencies will be needed...
        $cards = $cards->filter(function($card, $key) use ($baseCurrency) {
            return ($card->getCurrency() === $baseCurrency);
        });
        return view('add-funds.upholdcard', [
            'currencyMark' => $currencyMark,
            'currency' => $baseCurrency,
            'cards' => $cards,
        ]);
    }

    public function transferFunds(AddFundsTransferRequest $r)
    {
        // Data and Card is all validated by the AddFundsTransferRequest
        $amount = CurrencyService::cleanAmount($r->input('amount'));
        $cardId = $r->input('selected-card-id');
        $currencyMark = $r->input('currencyMark');
        $currency = $r->input('currency');

        $card = UpholdAPI::getCard($cardId);
        try {
            // Perform the actual transfer
            $order = IoOrder::placeInboundOrder(Auth::id(), $amount, $card->getId());
            sleep(self::SLEEP_TIME);
        } catch (Exception $e) {
            $errors = [$e->getMessage()];
            return redirect('/add-funds/uphold')->withInput()->withErrors($errors);
        }


        return redirect('/add-funds/transaction-complete')
            ->with('currencyMark', $currencyMark)
            ->with('amount', $amount)
            ->with('cardName', $card->getTitle())
            ->with('currency', $currency);
    }

    public function reviewAndConfirm(AddFundsConfirmationRequest $r)
    {
        // Data and Card is all validated by the AddFundsConfirmationRequest
        $currency = $r->input('selected-currency');
        $amount = CurrencyService::cleanAmount($r->input('select-uphold-amount'));
        $cardId = $r->input('selected-card-id');
        $cardName = $r->input('select-uphold-card');

        $currencyMark = CurrencyService::convertCurrencyToMark($currency);
        Log::debug('Currency Debug', compact('currency', 'currencyMark'));
        return view('add-funds.review-and-confirm', [
            'currency' => $currency,
            'currencyMark' => $currencyMark,
            'amount' => $amount,
            'cardId' => $cardId,
            'cardName' => $cardName,
        ]);
    }
}
