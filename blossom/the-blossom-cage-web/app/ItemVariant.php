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
    protected $table = 'v_item_variants';

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
     * @var string
     */
    public $timestamps = true;

}
