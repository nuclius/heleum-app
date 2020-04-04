<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $primaryKey = 'withdrawal_id';

    protected $dates = [
        'timestamp'
    ];
}
