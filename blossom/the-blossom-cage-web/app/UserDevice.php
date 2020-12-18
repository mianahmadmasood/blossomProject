<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'user_devices';

    /**
     * The model's attribute for mass assignment
     *
     * @var array
     */
    protected $fillable = ['user_id', 'device_type', 'device_token'];

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
    public function user() {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * updateByColVal method 
     * updated the model by given values 
     * using $data info
     * @param type $col
     * @param type $val
     * @param type $data
     * @return type
     */
    public function updateByColVal($col, $val, $data) {

        return $this->where($col, $val)->update($data);
    }

    /**
     * getByColumnValue method
     * @param type $col
     * @param type $val
     * @return type
     */
    public function getByColumnValue($col, $val) {

        return $this->where($col, $val)->first();
    }

}
