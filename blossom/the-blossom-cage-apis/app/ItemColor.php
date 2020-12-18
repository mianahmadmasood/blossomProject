<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemColor extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'item_colors';

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
        'color_quantity',
        'color_code',
        'color_image',
        'type',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the Color Item record associated with the item.
     */
    public function colorItemsImages() {
        return $this->hasMany(itemColorImages::class, 'item_colors_id','id');

    }

}
