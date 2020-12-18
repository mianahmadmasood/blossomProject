<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlackEmail extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'black_email';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'email', 'type'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;



}
