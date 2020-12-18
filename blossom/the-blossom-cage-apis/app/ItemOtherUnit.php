<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOtherUnit extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_other_units';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id','label_en','unit_en','value_en','label_ar','unit_ar','value_ar','status'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    /**
     * Get Item other units by column value
     */
    public function getByColVal($col, $value) {
        return $this->where($col, $value)->first();
    }

}
