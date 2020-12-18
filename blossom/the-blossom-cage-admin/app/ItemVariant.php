<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemVariant extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_variants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get all the related item colors
     */
    public function color() {
        return $this->hasOne(ItemColor::class, 'item_variant_id');
    }

    /**
     * Get all the related size here
     */
    public function size() {
        return $this->hasOne(ItemSize::class, 'item_variant_id');
    }
    /**
     * Get all the related size here
     */
    public function item() {
        return $this->belongsTo(Item::class, 'item_id','id');
    }

    /**
     * Get Item variant by column value
     */
    public function getByColVal($col, $value) {
        return $this->where($col, $value)->with('color', 'size')->first();
    }

    public function getItemByColumnValue($col, $val) {
        return $this->where($col, $val)->first();
    }

}
