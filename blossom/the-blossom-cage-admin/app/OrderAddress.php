<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'order_addresses';

    /**
     * The model's attribute for mass assignment
     *
     * @var array
     */
    protected $fillable = ['type', 'order_id', 'lat', 'lng', 'full_address', 'city', 'state', 'zip_code', 'country'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the related  order
     * 
     */
    public function orders() {

        return $this->belongsTo(Order::class, 'order_id');
    }

}
