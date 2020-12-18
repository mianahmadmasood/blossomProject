<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * The model's attribute for mass assignment
     *
     * @var array
     */
    protected $fillable = ['en_name', 'ar_name','country_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


}
