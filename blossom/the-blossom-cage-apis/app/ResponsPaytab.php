<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponsPaytab extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'respons_paytab';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_token', 'response'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


}
