<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $primaryKey = 'card_id';

    public static function getByUserId($userId = null)
    {
        $r = Card::where('heleum_user', intval($userId))->get();
        return $r;
    }
}
