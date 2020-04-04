<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Txns2 extends Model
{
    protected $table = 'txns2';

    public      $incrementing = false;
    protected   $primaryKey   = 'transaction_id';
    protected   $keyType      = 'string';

    protected $dates = [
        'transaction_timestamp',
    ];

    public function balloon()
    {
        return $this->belongsTo(Balloon::class, 'balloon', 'balloon_id');
    }

    public function getCurrencyMark($currency)
    {
        return Services\CurrencyService::convertCurrencyToMark($currency);
    }

    public function latestAmounts()
    {
        return $this->hasMany(TransactionLatestAmount::class, 'transaction', 'transaction_id');
    }

    public function latestAmountIn($currency)
    {
        $amount = 0.00;
        $amounts = $this->latestAmounts;
        foreach ($amounts as $txnAmount) {
            if ($txnAmount->currency === strtoupper($currency)) {
                $amount = $txnAmount->latest_amount;
                break;
            }
        }
        return $amount;
    }
}
