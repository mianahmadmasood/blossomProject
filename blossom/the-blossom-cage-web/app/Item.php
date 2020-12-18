<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'sub_category_id',
        'model',
        'item_code',
        'en_title',
        'ar_title',
        'en_description',
        'ar_description',
        'quantity',
        'price',
        'sale_price'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var string
     */
    public $timestamps = true;

    /**
     * Get the videos record associated with the item.
     */
    public function videos() {

        return $this->hasMany(ItemVideo::class, 'item_id');
    }

    /**
     * Get the images record associated with the item.
     */
    public function images() {

        return $this->hasMany(ItemImage::class, 'item_id');
    }

    /**
     * Get the image record associated with the item.
     */
    public function image() {

        return $this->hasOne(ItemImage::class, 'item_id');
    }

    /**
     * Get the manuals record associated with the item.
     */
    public function manuals() {

        return $this->hasMany(ItemManual::class, 'item_id');
    }

    /**
     * Get the sizes record associated with the item.
     */
    public function sizes() {

        return $this->hasMany(ItemSize::class, 'item_id');
    }

    /**
     * Get the colors record associated with the item.
     */
    public function colors() {

        return $this->hasMany(ItemColor::class, 'item_id');
    }

    /**
     * Get the image category associated with the item.
     */
    public function category() {

        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Get the sub_category record associated with the item.
     */
    public function sub_category() {

        return $this->hasOne(Category::class, 'id', 'sub_category_id');
    }

}
