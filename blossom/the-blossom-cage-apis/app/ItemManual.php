<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemManual extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'item_manuals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'title',
        'description',
        'type',
        'file',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

}
