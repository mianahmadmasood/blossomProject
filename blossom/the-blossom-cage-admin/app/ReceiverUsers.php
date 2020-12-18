<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiverUsers extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'receiver_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'order_status_id',
        'name',
        'phone',
        'national_id',
        'display_stored_information',
        'status',
        'archive',

    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;



}
