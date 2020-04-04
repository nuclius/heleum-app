<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalloonLatestTransaction extends Model
{
    protected $table = 'balloon_latest_transaction';
    protected $primaryKey = 'transaction_id';
    protected $dates = [
        'transaction_timestamp',
    ];

    public function amounts()
    {
        return $this->hasMany(TransactionLatestAmount::class, 'transaction', 'transaction_id');
    }

    public function getCurrencyMark($currency)
    {
        return Services\CurrencyService::convertCurrencyToMark($currency);
    }

    public function amountIn($currency)
    {
        $amount = 0.00;
        $amounts = $this->amounts;
        foreach ($amounts as $txnAmount) {
            if ($txnAmount->currency === strtoupper($currency)) {
                $amount = $txnAmount->latest_amount;
                break;
            }
        }
        return $amount;
    }
}
