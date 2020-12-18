<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'feedback';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ticket',
        'name',
        'email',
        'feedback',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Related user
     * 
     */
    public function user() {
        return $this->belongsTo(App\User::class, 'id', 'user_id');
    }

}
