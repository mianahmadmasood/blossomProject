<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The model's attribute for mass assignment
     *
     * @var array
     */
    protected $fillable = ['user_id', 'order_status_id', 'discount', 'discount_type', 'coupon_code', 'transaction_id', 'shipping_amount', 'transaction_status', 'total_amount', 'tax_amount'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the related item to the order
     * 
     */
    public function items() {

        return $this->hasMany(OrderItem::class, 'order_id');
    }

    /**
     * Get the related logs
     * 
     */
    public function logs() {

        return $this->hasMany(OrderItem::class, 'order_id');
    }

}
