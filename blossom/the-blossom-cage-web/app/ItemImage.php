<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'image'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var string
     */
    public $timestamps = true;

}
