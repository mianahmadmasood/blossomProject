<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileSettings extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'profile_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'push_notification', 'email_notification', 'text_notification'];

    /**
     * Get profile user data 
     * by column value
     */
    public function getByColValue($col, $val) {
        return $this->where($col, $val)->first();
    }

}
