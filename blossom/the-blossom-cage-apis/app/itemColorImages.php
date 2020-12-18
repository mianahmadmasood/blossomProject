<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemColorImages extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_color_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'image',
        'item_colors_id',
        'item_variant_id',
        'item_colors_id',
        'is_default',
        ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function items() {

        return $this->hasOne(Item::class, 'color_id', 'id');
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

}
