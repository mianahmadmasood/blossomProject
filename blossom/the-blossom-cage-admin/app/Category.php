<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
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
    public function parent_category() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * All the relations goes here
     */
    public function sub_category() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function items() {

        return $this->hasOne(Item::class, 'category_id', 'id');
    }
    public function itemsForSubCatgories() {

        return $this->hasOne(Item::class, 'sub_category_id', 'id');
    }

    /**
     * getCategoryByColumnValue 
     * @param type $col
     * @param type $val
     * @return type
     */
    public function getCategoryByColumnValue($col, $val) {
        return $this->where($col, $val)->first();
    }

    /**
     * getParentCategories for drop down
     * @param type $searchText
     * @return type
     */
    public function getParentCategoriesDD($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
                            if (!empty($searchText)) {
                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $sql->where('en_title', 'like', "%$searchText%");
                                $sql->orWhere('ar_title', 'like', "%$searchText%");
                            }
                        })
                        ->where('parent_id', NULL)
                        ->where('archive', 0)
                        ->orderBy('id', 'DESC')
                        ->get();
    }

    /**
     * getParentCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getParentCategories($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
                            if (!empty($searchText)) {
                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $sql->where('en_title', 'like', "%$searchText%");
                                $sql->orWhere('ar_title', 'like', "%$searchText%");
                            }
                        })
                        ->where('parent_id', NULL)
                        ->where('archive', 0)
                        ->orderBy('id', 'DESC')
                        ->paginate(10);
    }

    /**
     * getParentCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getParentCategoriesArhived($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
                            if (!empty($searchText)) {
                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $sql->where('en_title', 'like', "%$searchText%");
                                $sql->orWhere('ar_title', 'like', "%$searchText%");
                            }
                        })
                        ->where('parent_id', NULL)
                        ->where('archive', 1)
                        ->orderBy('id', 'DESC')
                        ->paginate(10);
    }
    /**
     * getParentCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getSubCategoriesArhived($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
                            if (!empty($searchText)) {
                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $sql->where('en_title', 'like', "%$searchText%");
                                $sql->orWhere('ar_title', 'like', "%$searchText%");
                            }
                        })
                        ->where('parent_id', '<>', NULL)
                        ->where('archive', 1)
                        ->orderBy('id', 'DESC')
                        ->paginate(10);
    }

    /**
     * getParentCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getParentCategoriesForItemsCreate($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
                            if (!empty($searchText)) {
                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $sql->where('en_title', 'like', "%$searchText%");
                                $sql->orWhere('ar_title', 'like', "%$searchText%");
                            }
                        })
                        ->whereHas('sub_category')
                        ->with('sub_category')
                        ->where('parent_id', NULL)
                        ->where('archive', 0)
                        ->orderBy('id', 'DESC')
                        ->get();
    }
    /**
     * getSubCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getSubCategoriesForItemsCreate() {
        return  $this->whereHas('parent_category', function ($sql) {
                $sql->where('archive', 0);
            })
            ->where('parent_id', "!=",null)
            ->where('archive', 0)->get();
    }
    /**
     * getSubCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getSubCategoriesForItemsEdit($parent_id = null) {
        return  $this->whereHas('parent_category', function ($sql) {
                $sql->where('archive', 0);
            })
            ->where('parent_id', "!=",null)
            ->where('parent_id',$parent_id)
            ->where('archive', 0)->get();
    }

    /**
     * getParentCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getParentCategoriesWP($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
                            if (!empty($searchText)) {
                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $sql->where('en_title', 'like', "%$searchText%");
                                $sql->orWhere('ar_title', 'like', "%$searchText%");
                            }
                        })
                        ->where('parent_id', NULL)
                        ->where('archive', 0)
                        ->get();
    }
    /**
     * getParentCategories method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getParentCategoriesItemcount($searchText = NULL) {
        return $this->where(function ($sql) use($searchText) {
                    if (!empty($searchText)) {
                        $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                        $sql->where('en_title', 'like', "%$searchText%");
                        $sql->orWhere('ar_title', 'like', "%$searchText%");
                    }
                })
                ->where('parent_id', NULL)
                ->withCount('items')
                ->where('archive', 0)
                ->get();
    }


    /**
     * getSubCategories search and fetch sub-categories
     * @param type $searchText
     * @return collection
     */
    public function getSubCategories($searchText = NULL) {

        return $this->where(function ($sql) use($searchText) {

                            $sql->whereHas('parent_category', function ($sql) use ($searchText) {
                                $sql->where('archive', 0);
                                if (!empty($searchText)) {
                                    $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                    $sql->Where('en_title', 'like', "%$searchText%");
                                    $sql->orWhere('ar_title', 'like', "%$searchText%");
                                }
                            });
                            if (!empty($searchText)) {
                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $sql->orWhere('en_title', 'like', "%$searchText%");
                                $sql->orWhere('ar_title', 'like', "%$searchText%");
                            }

                        })
                        ->where('parent_id', '<>', NULL)
                        ->with('parent_category')
                        ->where('archive', 0)
                        ->orderBy('id', 'DESC')
                        ->paginate(10);
    }

    public function getCategoriesItem($uid) {

        return $this->where('uuid', $uid)
            ->with(['items'=> function ($sql) {
                $sql->where('archive', 0);
            }])->first();
    }
    public function getSubCategoriesItem($uid) {

        return $this->where('uuid', $uid)
            ->with(['itemsForSubCatgories'=> function ($sql) {
                $sql->where('archive', 0);
            }])->first();
    }

}
