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
    protected $fillable = ['order_id',
        'item_id',
        'quantity',
        'discount',
        'discount_type',
        'coupon_code',
        'price',
        'converted_price',
        'converted_currency',
        'undiscounted_price',
        'undiscounted_converted_price',
        'color_id',
        'color_name',
        'color_code',
        'color_quantity',
        'color_image'

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

    public function fetchSoldItems($id) {

        $sql ="SELECT SUM(quantity) as total_sum FROM order_items JOIN orders ON order_items.order_id = orders.id WHERE orders.archive = 0 AND orders.order_status_id <> 5 AND order_items.item_id = " . $id;
        $data = \DB::select(\DB::raw($sql));
        return $data[0]->total_sum;
    }
    public function fetchSoldItemsColorQty($id,$color_id) {
        $sql ="SELECT SUM(quantity) as total_sum FROM order_items JOIN orders ON order_items.order_id = orders.id WHERE orders.archive = 0 AND orders.order_status_id <> 5 AND order_items.item_id = ".$id." AND order_items.color_id =" . $color_id;
        $data = \DB::select(\DB::raw($sql));
        return $data[0]->total_sum;
    }

}
