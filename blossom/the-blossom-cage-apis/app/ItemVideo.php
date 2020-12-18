<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemVideo extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'item_videos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'title',
        'video',
        'type',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

}
