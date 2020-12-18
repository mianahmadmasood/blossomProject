<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'user_name', 'phone_no', 'image', 'email', 'password', 'user_token', 'gender', 'lang', 'role_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * get related user device
     */
    public function device() {
        return $this->hasOne(UserDevice::class, 'user_id', 'id');
    }

    /**
     * get related user profile
     */
    public function profile() {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    /**
     * getUserByColumnValue method
     * get user by given values
     * @param type $col
     * @param type $val
     * @return type
     */
    public function getUserByColumnValue($col, $val) {
        return $this->where($col, $val)->where('role_id', 2)->with('device')->first();
    }

}
