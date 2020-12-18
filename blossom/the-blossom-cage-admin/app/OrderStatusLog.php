<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'order_statuses_log';

    /**
     * The model's attribute for mass assignment
     *
     * @var array
     */
    protected $fillable = ['user_id', 'order_id', 'order_status_id', 'comment', 'employee_id'];

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
    public function order() {
        return $this->belongsTo(Order::class, 'id');
    }

    /**
     * Get the related item
     * 
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
