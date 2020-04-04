<?php

namespace App\Services;

use App\Rate;

use Log;


class CurrencyService
{
    /**
     * Strips out all characters except +/-, numeric, and "."
     *
     * @param  float $amount  Value to get cleaned
     *
     * @return float          Float value of amount
     */
    public static function cleanAmount($amount)
    {
        return floatval(filter_var(
            $amount,
            FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION
        ));
    }

    public static function convertThisToThat($amount, $originCurrency, $destCurrency)
    {
        // If, for some reason we're converting the same currencies...weird, but we'll look into more
        if ($originCurrency === $destCurrency) {
            Log::info(sprintf('Conversion for the same currency %s', $originCurrency));
            return $amount;
        }

        // If neither currency is USD, we need to do an interim conversion.
        // FOO => USD  and then  USD => BAR
        if ($originCurrency != 'USD' && $destCurrency != 'USD') {
            Log::info(sprintf('Doing switcharoo: %s to %s', $originCurrency, 'USD'));
            $amount = self::convertThisToThat($amount, $originCurrency, 'USD');
            $originCurrency = 'USD';
        }
        Log::info(sprintf('Doing Conversion: (%s) %s => %s', $amount, $originCurrency, $destCurrency));
        $pair = strtoupper($originCurrency.$destCurrency);
        $rate = Rate::where('pair', $pair)->orderBy('update_timestamp', 'DESC')->first();
        return ($rate->bid * $amount);
    }

    public static function isValidBaseCurrency($currency)
    {
        $currency = strtolower((string) $currency);
        $currencyOptions = self::getCurrencyOptions();
        return isset($currencyOptions[$currency]);
    }

    public static function getMinimumForCurrency($currency)
    {
        $minimum = 100.00;
        $options = self::getCurrencyOptions();
        $currency = strtolower($currency);
        if (isset($options[$currency])) {
            $minimum = $options[$currency]['minimum'];
        }
        return $minimum;
    }

    public static function getCurrencyOptions()
    {
        return [
            'usd' => [
                'mark' => '$',
                'minimum' => 5.00,
            ],
            'eur' => [
                'mark'    => '€',
                'minimum' => 4.50,
            ],
            'gbp' => [
                'mark' => '£',
                'minimum' => 4.00,
            ],
            'chf' => [
                'mark' => 'CHF',
                'minimum' => 5.25,
            ],
            'cad' => [
                'mark' => '$',
                'minimum' => 6.70,
            ],
            'mxn' => [
                'mark' => '$',
                'minimum' => 100.00,
            ],
            'jpy' => [
                'mark' => '¥',
                'minimum' => 600.00,
            ],
            'aud' => [
                'mark' => '$',
                'minimum' => 6.90,
            ],
            'nzd' => [
                'mark' => '$',
                'minimum' => 7.60,
            ],

        ];
    }

    /**
     * Converts a 3 letter currency to its Mark
     *
     * @param  string $currency
     *
     * @return string           The currency mark
     */
    public static function convertCurrencyToMark($currency)
    {
        $currency = strtolower($currency);
        $currencies = self::getCurrencyOptions();
        return isset($currencies[$currency])
            ? $currencies[$currency]['mark']
            : '';
    }
}
