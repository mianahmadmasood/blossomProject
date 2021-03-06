<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessories extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accessories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['en_title', 'ar_title', 'image', 'slug','price','status'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;



    public function items() {

        return $this->hasOne(Item::class, 'accessorie_id', 'id');
    }

    /**
     * getParentCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getAccessories($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
            if (!empty($searchText)) {
                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                $sql->where('en_title', 'like', "%$searchText%");
                $sql->orWhere('en_title', 'like', "%$searchText%");
            }
        })
            ->where('archive', 0)
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    /**
     * getParentCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getAccessoriesArhived($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
            if (!empty($searchText)) {
                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                $sql->where('en_title', 'like', "%$searchText%");
                $sql->orWhere('en_title', 'like', "%$searchText%");
            }
        })
            ->where('archive', 1)
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }


    /**
     * getParentCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getAccessoriessForItemsCreate($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
            if (!empty($searchText)) {
                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                $sql->where('en_title', 'like', "%$searchText%");
                $sql->orWhere('en_title', 'like', "%$searchText%");
            }
        })

            ->where('archive', 0)
            ->orderBy('id', 'DESC')
            ->get();
    }

    /**
     * get accessories for item
     * to check items in stock details
     * @return type
     */
    public function getAccessorieItem($uid) {

//        return $this->where('uuid', $uid)
//            ->whereHas('items', function ($sql) {
//                $sql->where('archive', 0);
//            })->first();
        return $this->where('uuid', $uid)->first();
    }

}
