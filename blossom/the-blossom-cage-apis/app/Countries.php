<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * The model's attribute for mass assignment
     *
     * @var array
     */
    protected $fillable = ['en_name', 'ar_name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * All the relations goes here
     */
    public function cities() {
        return $this->hasMany(Cities::class, 'country_id')->where('archive', 0)->orderBy('en_name','ASC');
    }

}
