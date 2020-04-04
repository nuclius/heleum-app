<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use CurrencyService;

class Pop extends Model
{
    //
    //
    public function getCurrency()
    {
        return $this->pop_amount_currency;
    }

    public function getGains()
    {
        return $this->pop_amount_gains - $this->heleum_fee_amount;
    }

    public function getCurrencyMark()
    {
        return CurrencyService::convertCurrencyToMark($this->pop_amount_currency);
    }

}
