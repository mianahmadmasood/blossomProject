<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'order_items';

    /**
     * The model's attribute for mass assignment
     *
     * @var array
     */
    protected $fillable = ['order_id', 'item_id', 'discount', 'discount_type', 'coupon_code'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the related item
     * 
     */
    public function item() {
        return $this->belongsTo(Item::class, 'id');
    }

    /**
     * Get the related item
     * 
     */
    public function order() {
        return $this->belongsTo(Order::class, 'id');
    }

}
