<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemColor extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'v_item_colors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'item_variant_id',
        'en_color_name',
        'ar_color_name',
        'color_code',
        'color_image',
        'type',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var string
     */
    public $timestamps = true;

}
