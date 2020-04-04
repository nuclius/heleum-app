<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    protected $primaryKey = 'funding_id';

    protected $dates = [
        'timestamp'
    ];

}
