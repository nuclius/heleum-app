<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IoOrder extends Model
{
    protected $table = 'io_orders';
    protected $primaryKey = 'io_order_id';

    /**
     * Our current database doesn't have created_at OR updated_at
     * so we have to turn this off from trying to update those
     * when a Model is saved.
     *
     * @var boolean
     */
    public $timestamps = false;


    public static function placeInboundOrder($user_id, $amount, $cardId)
    {
        $order = new self();
        $order->type = 'funding';
        $order->heleum_user = $user_id;
        $order->amount = $amount;
        $order->uphold_card_id = $cardId;
        $order->save();
        return $order;
    }

    public static function placeOutboundOrder($user_id, $amount, $cardId)
    {
        $order = new self();
        $order->type = 'withdrawal';
        $order->heleum_user = $user_id;
        $order->amount = $amount;
        $order->uphold_card_id = $cardId;
        $order->save();
        return $order;
    }

}
