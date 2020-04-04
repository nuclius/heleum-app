<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Services\UpholdAPI;
use App\Services\CurrencyService;

use Auth;
use Log;

class CardRules implements Rule
{
    protected static $latestRequestAmount = null;
    protected static $latestAvailable = null;
    protected static $latestWithdrawRequestAmount = null;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function isValidCard($attribute, $value, $parameters, $validator) {
        Log::info('Validating Card ID: '.$value);
        $card = UpholdAPI::getCard($value);
        return (!empty($card));
    }

    public function lessThanCardAvailable($attribute, $value, $parameters, $validator)
    {
        $cardId = $parameters[0];
        if (empty($cardId)) {
            return false;
        }
        $card = UpholdAPI::getCard($cardId);
        if (empty($card)) {
            return false;
        }
        $available = $card->getAvailable();
        $value = CurrencyService::cleanAmount($value);
        Log::info(sprintf(
            'Validating that we are less than the card available.  Amount (%s), Available (%s)',
            $value,
            $available
        ));
        self::$latestRequestAmount = $value;
        self::$latestAvailable = $available;
        return ($value <= $available);
    }

    public function lessThanCardAvailableMessage($message, $attribute, $rule, $parameters)
    {
        return str_replace(
            [':requestAmount', ':cardAvailable'],
            [self::$latestRequestAmount, self::$latestAvailable],
            $message
        );
    }

    public function greaterThanZero($attribute, $value, $parameters, $validator)
    {
        $amount = CurrencyService::cleanAmount($value);
        return ($amount > 0.00);
    }

    public function lessThanOrEqualToMaxWithdrawAmount($attribute, $value, $parameters, $validator)
    {
        $user = Auth::user();
        $value = CurrencyService::cleanAmount($value);
        $maxAmount = $user->getMaxWithdrawlAmount();
        Log::debug(sprintf(
            'Validating Amount (%s) is less than or equal to the max withdrawl amount (%s)',
            $value, $maxAmount
        ));
        self::$latestWithdrawRequestAmount = $value;
        return ($value <= $maxAmount);
    }

    public function lessThanOrEqualToMaxWithdrawAmountMessage($message, $attribute, $rule, $parameters)
    {
        $user = Auth::user();
        return str_replace(
            [':requestAmount', ':userBalance'],
            [self::$latestWithdrawRequestAmount, $user->getBalance()],
            $message
        );
    }


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
