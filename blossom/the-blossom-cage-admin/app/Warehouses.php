<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouses extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'warehouse';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['en_title', 'ar_title', 'image', 'slug','address','phone', 'zip_code', 'city', 'state', 'country', 'lng', 'lat', 'archive'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    /**
     * getParentCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getWarehouses($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
            if (!empty($searchText)) {
                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                $sql->where('en_title', 'like', "%$searchText%");
                $sql->orWhere('en_title', 'like', "%$searchText%");
            }
        })
            ->orderBy('id', 'DESC')
            ->where('archive', 0)
            ->paginate(10);
    }

    /**
     * getParentCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getWarehousesArhived($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
            if (!empty($searchText)) {
                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                $sql->where('en_title', 'like', "%$searchText%");
                $sql->orWhere('en_title', 'like', "%$searchText%");
            }
        })
            ->where('parent_id', NULL)
            ->where('archive', 1)
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    /**
     * getwarehousesForCreate method get all the warehouse
     * @param type $searchText
     * @return collection
     */
    public function getwarehousesForCreate()
    {
        return $this->where('archive', 0)->get();
    }


}
