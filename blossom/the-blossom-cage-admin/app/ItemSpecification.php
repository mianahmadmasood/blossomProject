<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemSpecification extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_specifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'specifications',
        'title',
        'item_id',
        'value',
        'unit',
        'desp_unit',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * get related item
     * @return type
     */
    public function item() {

        return $this->belongsTo(Item::class, 'item_id');
    }

    /**
     * 
     * @param type $col
     * @param type $val
     * return model
     */
    public function getSpecsByColVal($col, $val) {
        return $this->where($col, $val)->first();
    }

}
