<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'full_address', 'zip_code', 'city', 'city_id', 'state', 'country','country_id',
    ];

    /**
     * Get profile user data
     * by column value
     */
    public function getByColValue($col, $val) {
        return $this->where($col, $val)->first();
    }

}
