<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItemAccessries extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'order_items_accessories';

    /**
     * The model's attribute for mass assignment
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'item_id',
        'order_item_id',
        'accessories_id',
        'en_title',
        'ar_title',
        'quantity',
        'price',
        'must_purchase',
        'image'
    ];

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
        return $this->belongsTo(Item::class, 'item_id');
    }

    /**
     * Get the related item
     *
     */
    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }


}
