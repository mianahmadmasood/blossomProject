<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemSize extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_sizes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'item_variant_id',
        'width',
        'lenght',
        'weight',
        'height',
        'orientation_unit',
        'orientation_unit_ar',
        'weight_unit',
        'weight_unit_ar',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get Item size by column value
     */
    public function getByColVal($col, $value) {
        return $this->where($col, $value)->first();
    }

}
