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
    protected $table = 'v_item_sizes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'item_variant_id',
        'weight',
        'height',
        'orientation_unit',
        'weight_unit',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var string
     */
    public $timestamps = true;

}
