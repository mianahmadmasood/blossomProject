<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'brands';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['en_title', 'ar_title', 'image', 'slug','status'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;



    public function items() {

        return $this->hasOne(Item::class, 'brand_id', 'id');
    }


    /**
     * getBrands method get all the getBrands
     * @param type $searchText
     * @return collection
     */
    public function getBrands() {
        return $this->where('archive', 0)
            ->where('status', 0)
            ->orderBy('id', 'DESC')
            ->get();
    }



}
