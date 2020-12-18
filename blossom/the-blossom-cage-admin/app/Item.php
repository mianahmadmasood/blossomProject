<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'sub_category_id',
        'brand_id',
        'model',
        'item_code',
        'en_title',
        'ar_title',
        'en_description',
        'ar_description',
        'quantity',
        'cart_quantity',
        'price',
        'sale_price',
        'slug',
        'archive',
        'en_short_description',
        'ar_short_description',
        'discounted_type',
        'discount',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the videos for the items
     */
    public function videos() {

        return $this->hasMany(ItemVideo::class, 'item_id');
    }

    /**
     * Get the images for the items
     */
    public function images() {

        return $this->hasMany(ItemImage::class, 'item_id');
    }

    /**
     * Get the manuals for the items
     */
    public function manuals() {

        return $this->hasMany(ItemManual::class, 'item_id');
    }

    /**
     * Get the manuals for the items
     */
    public function variants() {

        return $this->hasMany(ItemVariant::class, 'item_id');
    }

    /**
     * Get the sizes for the items
     */
    public function sizes() {

        return $this->hasMany(ItemSize::class, 'item_id');
    }

    /**
     * Get the colors for the items
     */
    public function colors() {

        return $this->hasMany(ItemColor::class, 'item_id')->where('archive', '=', 0);
    }

    /**
     * Get the category for the items
     */
    public function category() {

        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Get the sub_category for the items
     */
    public function sub_category() {

        return $this->hasOne(Category::class, 'id', 'sub_category_id');
    }

    /**
     * Get the specs for the items
     */
    public function specs() {

        return $this->hasMany(ItemSpecification::class, 'item_id', 'id');
    }
/**
     * Get the specs for the items
     */
    public function itemAccessories() {

        return $this->hasMany(ItemAccessories::class, 'item_id', 'id')->where('archive', '=', 0);
    }

    /**
     * Get the specs for the items other unit
     */

    public function otherunits()
    {
        return $this->hasOne(ItemOtherUnit::class, 'item_id');
    }

    /**
     * Get the specs record associated with the item.
     */
    public function ordersItems() {
        return $this->hasMany(OrderItem::class, 'item_id', 'id');
    }

    /**
     * getItemDetailsByColumnValue method
     * fetch the item collection by column and value
     * @param type $col
     * @param type $val
     * @return collection
     */
    public function getItemDetailsByColumnValue($col, $val) {

        return $this->where($col, $val)
                        ->with('variants.size')
                        ->with('variants.color')
                        ->with('videos', 'manuals','images', 'category', 'sub_category', 'specs')
                        ->first();
    }

    /**
     * getItemByColumnValue method
     * get single collection of item model by col and value
     * @param type $col
     * @param type $val
     * @return collection
     */
    public function getItemByColumnValue($col, $val) {
        return $this->where($col, $val)->first();
    }

    /**
     * updateItemByColVal method 
     * update the item table record by column value
     * @param type $col
     * @param type $val
     * @param type $data
     * @return type
     */
    public function updateItemByColVal($col, $val, $data) {

        return $this->where($col, $val)->update($data);
    }

    /**
     * getItems method
     * search items from database
     * @param type $searchText
     * @return collection
     */
    public function getItems($searchText) {

        return $this->with('videos', 'images', 'manuals', 'sizes', 'colors')
                        ->where(function ($sql) use($searchText) {
                            if ($searchText) {
                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $sql->where('en_title', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('model', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('ar_title', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('item_code', 'LIKE', '%' . $searchText . '%');
                            }
                        })
                        ->orderBy('id', 'DESC')
                        ->paginate(10);
    }

    /**
     * getIApprovedtems method 
     * fetch approved items from items table
     * @param type $searchText
     * @return collection
     */
    public function getIApprovedtems($searchText) {

//        dd($searchText);
        return $this
            ->where('is_approved', 1)
                        ->where(function ($sql) use($searchText) {
                            if ($searchText) {
//                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $searchText = strtoupper($searchText);
                                $sql->where('en_title', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('ar_title', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('model', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('item_code', 'LIKE', '%' . $searchText . '%');
                            }
                        })
                        ->with('videos', 'images', 'manuals', 'sizes', 'colors')
                        ->where('archive', '0')
                        ->orderBy('id', 'DESC')
                        ->paginate(10);
    }

    /**
     * getIPendingtems method 
     * fetch pending items from items table
     * @param type $searchText
     * @return collection
     */
    public function getIPendingtems($searchText) {

        return $this->where('is_approved', 0)
                        ->where(function ($sql) use($searchText) {
                            if ($searchText) {
                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $sql->where('en_title', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('ar_title', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('model', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('item_code', 'LIKE', '%' . $searchText . '%');
                            }
                        })
                        ->with('videos', 'images', 'manuals', 'sizes', 'colors')
                        ->where('archive', '0')
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(10);
    }
    /**
     * getIPendingtems method
     * fetch pending items from items table
     * @param type $searchText
     * @return collection
     */
    public function getOutofstock($searchText) {

        return $this->where('is_approved', 1)
                        ->where(function ($sql) use($searchText) {
                            if ($searchText) {
                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $sql->where('en_title', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('ar_title', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('model', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('item_code', 'LIKE', '%' . $searchText . '%');
                            }
                        })
                        ->with('videos', 'images', 'manuals', 'sizes', 'colors')
                        ->where('archive', '0')
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(10);
    }

    /**
     * getIDeletedtems method
     * @param type $searchText
     * @return collection
     */
    public function getIDeletedtems($searchText) {

        return $this->where(function ($sql) use($searchText) {
                            if ($searchText) {
                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $sql->where('en_title', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('ar_title', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('model', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('item_code', 'LIKE', '%' . $searchText . '%');
                            }
                        })
                        ->with('videos', 'images', 'manuals', 'sizes', 'colors')
                        ->where('archive', '1')
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(10);
    }

    /**
     * getIPendingtems method
     * fetch pending items from items table
     * @param type $searchText
     * @return collection
     */
    public function getItemsForCategoriesByColumValue($col, $val, $searchText = NULL) {

        return $this->where(function ($sql) use($searchText) {
            if ($searchText) {
                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                $sql->where('en_title', 'LIKE', '%' . $searchText . '%');
                $sql->orwhere('ar_title', 'LIKE', '%' . $searchText . '%');
                $sql->orwhere('model', 'LIKE', '%' . $searchText . '%');
                $sql->orwhere('item_code', 'LIKE', '%' . $searchText . '%');
            }
        })
            ->with('videos', 'images', 'manuals', 'sizes', 'colors')
//            ->where('is_approved', 1)
            ->where('archive', 0)
            ->where($col, $val)
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);
    }



    /**
     * getIPendingtems method 
     * fetch pending items from items table
     * @param type $searchText
     * @return collection
     */
    public function getItemsByColumValue($col, $val, $searchText = NULL) {

        return $this->where(function ($sql) use($searchText) {
                            if ($searchText) {
                                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                                $sql->where('en_title', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('ar_title', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('model', 'LIKE', '%' . $searchText . '%');
                                $sql->orwhere('item_code', 'LIKE', '%' . $searchText . '%');
                            }
                        })
                        ->with('videos', 'images', 'manuals', 'sizes', 'colors')
                        ->where('is_approved', 1)
                        ->where('archive', 0)
                        ->where($col, $val)
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(10);
    }

    /**
     * get Fresh Items 
     * to check items in stock details
     * @return type
     */
    public function getFreshItemsCount($col, $val) {

        return $this->where($col, $val)
                        ->whereHas('ordersItems', function($sql) {
                            $sql->whereHas('order', function ($innderSql) {
                                $innderSql->where('archive', 0);
                                $innderSql->whereIn('order_status_id', [1, 2, 3, 4]);
                            });
                        })->with('ordersItems')
                        ->first();
    }


    /**
     * get Fresh Items 
     * to check items in stock details
     * @return type
     */
    public function getFreshItemsCountAll() {


        return $this->whereHas('ordersItems', function($sql) {
                    $sql->whereHas('order', function ($innderSql) {
                        $innderSql->where('archive', '=', 0);
                        $innderSql->whereIn('order_status_id', [1, 2, 3, 4]);
                    });
                })->with('ordersItems')->get();
    }


    /**
     * getIApprovedtems method
     * fetch approved items from items table
     * @param type $searchText
     * @return collection
     */
    public function getItemsForCreate() {

        return $this->where('is_approved', 1)
            ->with('videos', 'images', 'manuals', 'sizes', 'colors')
            ->where('archive', '0')
            ->get();
    }

    public function getItemsForCreatehomesfeeds($search_params)
    {
        return $this->where(function ($innerSql) use ($search_params) {
                $innerSql->whereHas('category', function ($cat_sql) use ($search_params) {
                    $cat_sql->where('archive', 0);
                    if(!empty($search_params['catType']) && $search_params['catType'] == 'cat') {
                        $cat_sql->where('id', $search_params['id']);
                    }
                });
                $innerSql->whereHas('sub_category', function ($cat_sql) use ($search_params) {
                    $cat_sql->where('archive', 0);
                    if(!empty($search_params['catType']) && $search_params['catType'] == 'subCat') {
                        $cat_sql->where('id', $search_params['id']);
                    }

                });
            })
            ->where(function ($innerSql) use ($search_params) {
            if(!empty($search_params['type']) && $search_params['type'] == "topSaleItem"){
                $innerSql ->where('sale_price', '!=' , 0);
            }

        })
            ->where('is_approved', 1)
            ->orderBy('id', 'desc')
            ->where('archive', 0)
            ->where('is_approved', 1)
            ->get();

    }

    public function getItemDetailsByColumnValueForexist($col, $val, $user_id = null)
    {

        return $this->where($col, $val)
            ->whereHas('category', function ($sql) {
                $sql->where('archive', 0);
            })
            ->whereHas('sub_category', function ($sql) {
                $sql->where('archive', 0);
            })
//            ->whereHas('brand', function ($brand_sql)  {
//                $brand_sql->where('archive', 0);
//                $brand_sql->where('status', 0);
//            })
            ->where('archive', 0)
            ->where('is_approved', 1)
            ->first();
    }



}
