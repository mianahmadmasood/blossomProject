<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'colors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['en_title', 'ar_title','color_code', 'image', 'slug','status'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function items() {

        return $this->hasOne(Item::class, 'color_id', 'id');
    }
    public function items_color() {

        return $this->hasMany(ItemColor::class, 'color_id', 'id');
    }

    /**
     * getParentCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getColors($searchText = NULL) {
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
    public function getColorsArhived($searchText = NULL) {
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
    public function getColorsForItemsCreate($searchText = NULL) {
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
     * get brands for item
     * to check items in stock details
     * @return type
     */
    public function getColorItem($uid) {

        return $this->where('uuid', $uid)
            ->whereHas('items', function ($sql) {
                $sql->where('archive', 0);
            })->first();
    }
    public function getItemsColor($uid) {

        return $this->where('uuid', $uid)
            ->whereHas('items_color', function ($sql) {
                $sql->where('archive', 0);
            })->first();
    }

}
