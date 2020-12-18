<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The model's attribute for mass assignment
     *
     * @var array
     */
    protected $fillable = ['en_title', 'ar_title', 'image','icon_image', 'parent_id', 'slug'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * All the relations goes here
     */
    public function sub_categories() {
        return $this->hasMany(Category::class, 'parent_id')->where('archive', 0);
    }

    /**
     * items for categories
     * @return type
     */
    public function items() {
        return $this->hasMany(Item::class, 'category_id')->where('archive', 0)->where('is_approved', 1)->where('is_sold', 0)->where('availability', 1);
    }

    /**
     * All the queries goes here
     */
    public function getParentCategories($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
                            if (!empty($searchText)) {
                                $sql->where('en_title', 'like', "%$searchText%");
                                $sql->orWhere('en_title', 'like', "%$searchText%");
                            }
                        })
                        ->whereHas('sub_categories')
                        ->whereHas('items')
                        ->where('parent_id', NULL)
                        ->where('archive', 0)
                        ->with('sub_categories')
                        ->get();
    }

}
