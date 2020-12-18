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
    protected $table = 'item_colors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'item_variant_id',
        'color_id',
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
     * Get Item color by column value
     */
    public function colorItemsImages() {
        return $this->hasMany(itemColorImages::class, 'item_colors_id','id');

    }

    public function getByColVal($col, $value) {
        return $this->where($col, $value)->first();
    }
    public function getItemColor($variantId) {
        return $this->where('item_variant_id',$variantId)->with('colorItemsImages')->where('archive', '=', 0)->get();
    }

}
