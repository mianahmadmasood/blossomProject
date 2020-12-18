<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemAccessories extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_accessories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'accessories_id',
        'accessories_quantity',
        'accessories_status',
        'archive',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get Item accessorie by column value
     */
    public function accessorieItemsImages() {
        return $this->hasMany(itemAccessorieImages::class, 'item_accessories_id','id');

    }

    public function getByColVal($col, $value) {
        return $this->where($col, $value)->first();
    }
    public function getItemAccessorie($variantId) {
        return $this->where('item_variant_id',$variantId)->with('accessorieItemsImages')->where('archive', '=', 0)->get();
    }


}
