<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;
use App\Services\CurrencyService;
use Log;

class Balloon extends Model
{
    protected $primaryKey = 'balloon_id';
    protected $dates = [
        'primed_timestamp',
    ];

    public function getId()
    {
        return $this->balloon_id;
    }

    public function getCurrencyMark()
    {
        return CurrencyService::convertCurrencyToMark($this->launch_currency);
    }

    public function getStartDate($format = null)
    {
        if (empty($format)) {
            $format = 'Y-m-d';
        }
        return $this->primed_timestamp->format($format);
    }

    public function getEndDate($format = null)
    {
        if (empty($format)) {
            $format = 'Y-m-d';
        }
        if ($this->isActive()) {
            $date = '';
        } else {
            $txn = $this->latestTransaction;
            $date = $txn->transaction_timestamp->format($format);
        }
        return $date;
    }

    public function hasMoves()
    {
        return ($this->number_moves > 0);
    }

    /*
     * LAUNCH INFO METHODS
     */
    public function getLaunchAmount()
    {
        return $this->launch_amount;
    }
    public function getLaunchCurrency()
    {
        return $this->launch_currency;
    }
    public function getLaunchCurrencyMark()
    {
        return CurrencyService::convertCurrencyToMark($this->getLaunchCurrency());
    }



    /*
     * CURRENT INFO METHODS
     */

    /**
     * Gets the current amount of the balloon, in the user's base currency
     *
     * @return float
     */
    public function getCurrentAmount()
    {
        $amount = $this->launch_amount;
        if ($this->hasMoves()) {
            $txn = $this->latestTransaction;
            if ($txn) {
                if ($this->isPopped()) {
                    $amount = $txn->amountIn($txn->dest_currency);
                } else {
                    Log::debug(sprintf(
                        'Doing conversion for Transaction (%s) and Amount (%s).  Currency %s  ->  %s',
                        $txn->transaction_id,
                        $txn->dest_amount,
                        $txn->dest_currency,
                        Auth::user()->base_currency
                    ));
                    $amount = CurrencyService::convertThisToThat(
                        $txn->dest_amount,
                        $txn->dest_currency,
                        Auth::user()->base_currency
                    );
                }
            }
        }
        return $amount;
    }
    public function getCurrentCurrency()
    {
        $currency = $this->launch_currency;
        if ($this->hasMoves()) {
            $txn = $this->latestTransaction;
            if ($txn) {
                $currency = $txn->dest_currency;
            }
        }
        return $currency;
    }
    public function getCurrentCurrencyMark()
    {
        return CurrencyService::convertCurrencyToMark(
            $this->getCurrentCurrency()
        );
    }



    /**
     * Gets the balloons gains or losses - in the user's base currency
     *
     * @return float     Amount up or down (in the user's base currency)
     */
    public function getAmountChange()
    {
        $amountChange = $this->getCurrentAmount() - $this->launch_amount;
        if ($this->isPopped()) {
            $pop = $this->pop;
            $amountChange = ($amountChange - $pop->heleum_fee_amount);
        }
        return round(floatval($amountChange), 2);
    }

    /**
     * Gets the balloons gain or loss percentage
     *
     * @return int     Percentage up or down
     */
    public function getPercentChange()
    {
        $rawPercentChange = round($this->getCurrentAmount() / $this->launch_amount, 2);
        $percentChange = $rawPercentChange * 100;
        if ($percentChange < 100) {
            $percentChange = (100 - $percentChange) * -1;
        } else {
            $percentChange = $percentChange - 100;
        }
        return intval($percentChange);
    }


    /**
     * Returns whether or not the value of the change in the balloon is "up"
     * (greater than or equal to zero)
     *
     * @return boolean Whether or not the value of the change in the balloon
     *                 is "up"
     */
    public function isUp()
    {
        $change = $this->getAmountChange();
        return ($change >= 0.00);
    }

    /**
     * Returns whether or not the value of the change in the balloon is "down"
     *
     * @return boolean Whether or not the value of the change in the balloon
     *                 is "down"
     */
    public function isDown()
    {
        return !$this->isUp();
    }

    public function latestTransaction()
    {
        return $this->hasOne(BalloonLatestTransaction::class, 'balloon', 'balloon_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'balloon', 'balloon_id')->orderBy('move_number', 'DESC');
    }

    public function pop()
    {
        return $this->hasOne(Pop::class, 'balloon', 'balloon_id');
    }

    public function isActive()
    {
        return $this->active;
    }

    public function isPopped()
    {
        return ($this->isActive() === false);
    }
}
