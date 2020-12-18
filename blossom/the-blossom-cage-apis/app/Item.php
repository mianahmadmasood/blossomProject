<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
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
        'model',
        'item_code',
        'en_title',
        'ar_title',
        'en_description',
        'ar_description',
        'quantity',
        'price',
        'sale_price',
        'is_featured',
        'slug',
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
     * Get the videos record associated with the item.
     */
    public function videos()
    {

        return $this->hasMany(ItemVideo::class, 'item_id');
    }

    /**
     * Get the images record associated with the item.
     */
    public function images()
    {

        return $this->hasMany(ItemImage::class, 'item_id')->where('archive', 0);
    }

    /**
     * Get the image record associated with the item.
     */
    public function image()
    {

        return $this->hasOne(ItemImage::class, 'item_id')->where('is_default', 1);
    }

    /**
     * Get the manuals record associated with the item.
     */
    public function manuals()
    {

        return $this->hasMany(ItemManual::class, 'item_id');
    }

    /**
     * Get the sizes record associated with the item.
     */
    public function sizes()
    {

        return $this->hasMany(ItemSize::class, 'item_id');
    }

    /**
     * Get the sizes record associated with the item.
     */
    public function size()
    {

        return $this->hasOne(ItemSize::class, 'item_id');
    }

    /**
     * Get the colors record associated with the item.
     */
    public function colors()
    {

        return $this->hasMany(ItemColor::class, 'item_id')->where('archive', 0);
    }

    /**
     * Get the image category associated with the item.
     */
    public function category()
    {

        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Get the sub_category record associated with the item.
     */
    public function sub_category()
    {

        return $this->hasOne(Category::class, 'id', 'sub_category_id');
    }

    /**
     * Get the itemAccessories for the items
     */
    public function itemAccessories() {

        return $this->hasMany(ItemAccessories::class, 'item_id', 'id')->where('archive', '=', 0);
    }

    /**
     * Get the specs record associated with the item.
     */
    public function specs()
    {

        return $this->hasMany(ItemSpecification::class, 'item_id');
    }

    /**
     * Get the Color Item record associated with the item.
     */
    public function colorItems() {
        return $this->hasMany(ItemColor::class, 'item_id')->where('archive','0');

    }
    /**
     * Get the Color Item record associated with the item.
     */
    public function itemColorImages() {
        return $this->hasMany(itemColorImages::class, 'item_id')->where('archive','0');

    }

    /**
     * Get the specs record associated with the item.
     */
    public function ordersItems()
    {

        return $this->hasMany(OrderItem::class, 'item_id', 'id');
    }

    /**
     * Get the manuals for the items
     */
    public function variant()
    {

        return $this->hasOne(ItemVariant::class, 'item_id');
    }
    public function otherunits()
    {
        return $this->hasOne(ItemOtherUnit::class, 'item_id');
    }
    public function brand()
    {
        return $this->hasOne(Brands::class, 'id','brand_id');
    }

    public function count()
    {
        return $this->hasMany(Item::class, 'id')->count();
    }

    public function favorites()
    {
        return $this->hasOne(UserFavoriteItem::class, 'item_id', 'id');
    }

    /**
     * getItemDetailsByColumnValue method
     * get collection of item by column and value
     * @param type $col
     * @param type $val
     * @return type
     */
    public function getItemDetailsByColumnValue($col, $val, $user_id = null)
    {

        return $this->where($col, $val)
            ->with('videos', 'manuals', 'category', 'sub_category', 'specs','brand')
            ->with('variant.size')
            ->with('variant.color')
            ->with('otherunits')
            ->with(['images' => function ($sql) use ($user_id) {
                $sql->orderBy('is_default', 'DESC');
            }])->with(['favorites' => function ($sql) use ($user_id) {
                $sql->where('user_id', $user_id);
            }])
            ->whereHas('category', function ($sql) {
                $sql->where('archive', 0);
            })
            ->whereHas('sub_category', function ($sql) {
                $sql->where('archive', 0);
            })
            ->whereHas('brand', function ($brand_sql)  {
                $brand_sql->where('archive', 0);
                $brand_sql->where('status', 0);
            })
            ->where('archive', 0)
            ->where('is_approved', 1)
            ->first();
    }

    /**
     * getItemsByUids method
     * get item collection by uids
     * @param type $uids
     * @return type
     */
    public function getItemsByUids($uids)
    {

        return $this->whereIn('uuid', $uids)
            ->whereHas('category', function ($sql) {
                $sql->where('archive', 0);
            })
            ->whereHas('sub_category', function ($sql) {
                $sql->where('archive', 0);
            })->where('is_approved', 1)->where('archive', 0)->get();
    }

    /**
     * getItemByColumnValue method
     * @param type $col
     * @param type $val
     * @return type
     */
    public function getItemByColumnValue($col, $val)
    {

        return $this->where($col, $val)->first();
    }

    /**
     * updateItemByColVal method updates
     * the resource in the database
     * @param type $col
     * @param type $val
     * @param type $data
     * @return type
     */
    public function updateItemByColVal($col, $val, $data)
    {

        return $this->where($col, $val)->update($data);
    }

    /**
     * getItems method get items
     * @param type $search_params
     * @return type
     */
    public function getItems($search_params)
    {


        if (!empty($search_params['sort_by'])) {
            $searchText = $search_params['sort_by'];
            if($searchText == 'Hightolow') {
                $colName='price';
                $orderBy='DESC';
            }elseif ($searchText == 'Lowtohigh'){
                $colName='price';
                $orderBy='ASC';
            }elseif ($searchText == 'featured'){
                $colName='is_featured';
                $orderBy='DESC';
            }elseif ($searchText == 'mostRecent'){
                $colName='updated_at';
                $orderBy='DESC';
            }elseif ($searchText == 'discounted'){
                $colName='sale_price';
                $orderBy='DESC';
            }else{
                $colName='id';
                $orderBy='DESC';
            }
        }else{
            $colName='id';
            $orderBy='DESC';
        }


        return $this->where(function ($sql) use ($search_params) {
            if (!empty($search_params['search_keyword'])) {
                $searchText = $search_params['search_keyword'];
                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                $sql->Where('en_title', 'like', "%$searchText%");
                $sql->orWhere('ar_title', 'like', "%$searchText%");
            }


            if (isset($search_params['min_price']) && isset($search_params['max_price'])) {
//                $sql->whereBetween('price', [$search_params['min_price'], $search_params['max_price']]);
                if (!empty($search_params['min_price'])) {
                    $sql->where('price','>=', $search_params['min_price']);
                }
                if (!empty($search_params['max_price']) && $search_params['max_price'] > 0) {
                    $sql->where('price','<=', $search_params['max_price']);
                }
            }
        })
            ->where(function ($innerSql)use ($search_params) {
                $innerSql->whereHas('brand', function ($brand_sql) use ($search_params) {
                    $brand_sql->where('archive', 0);
                    $brand_sql->where('status', 0);
                    if (!empty($search_params['brands'])) {
                        $brand_sql->whereIn('slug', $search_params['brands']);
                    }
                });
            })
            ->where(function ($innerSql) use ($search_params) {
                $innerSql->whereHas('category', function ($cat_sql) use ($search_params) {
                    $cat_sql->where('archive', 0);
                    if (!empty($search_params['category']) && $search_params['category'] != 'all') {
                        $cat_sql->where('slug', $search_params['category']);
                    }
                });
                $innerSql->whereHas('sub_category', function ($cat_sql) use ($search_params) {
                    $cat_sql->where('archive', 0);
                    if (!empty($search_params['sub_categories'])) {
                        $cat_sql->whereIn('slug', $search_params['sub_categories']);
                    }
                });
            })
            ->with('videos', 'image', 'manuals', 'sizes', 'colors')
            ->with(['favorites' => function ($fav_sql) use ($search_params) {
                $fav_sql->where('user_id', $search_params['user_id']);
            }])
            ->where('is_approved', 1)
            ->limit($search_params['limit'])
            ->offset($search_params['offset'])
            ->orderBy($colName, $orderBy)
            ->where('archive', 0)
            ->where('is_approved', 1)
            ->get();

    }

    /**
     * getItemsCount method get items
     * @param type $search_params
     * @return type
     */
    public function getItemsCount($search_params)
    {

        if (!empty($search_params['sort_by'])) {
            $searchText = $search_params['sort_by'];
            if($searchText == 'Hightolow') {
                $colName='price';
                $orderBy='DESC';
            }elseif ($searchText == 'Lowtohigh'){
                $colName='price';
                $orderBy='ASC';
            }elseif ($searchText == 'featured'){
                $colName='is_featured';
                $orderBy='DESC';
            }elseif ($searchText == 'mostRecent'){
                $colName='updated_at';
                $orderBy='DESC';
            }elseif ($searchText == 'discounted'){
                $colName='sale_price';
                $orderBy='DESC';
            }else{
                $colName='id';
                $orderBy='DESC';
            }
        }else{
            $colName='id';
            $orderBy='DESC';
        }


        return $this->where(function ($sql) use ($search_params) {
            if (!empty($search_params['search_keyword'])) {
                $searchText = $search_params['search_keyword'];
                $searchText = preg_replace('/\s\s+/', ' ', $searchText);
                $sql->Where('en_title', 'like', "%$searchText%");
                $sql->orWhere('ar_title', 'like', "%$searchText%");
            }


            if (isset($search_params['min_price']) && isset($search_params['max_price'])) {
//                $sql->whereBetween('price', [$search_params['min_price'], $search_params['max_price']]);
                if (!empty($search_params['min_price'])) {
                    $sql->where('price','>=', $search_params['min_price']);
                }
                if (!empty($search_params['max_price']) && $search_params['max_price'] > 0) {
                    $sql->where('price','<=', $search_params['max_price']);
                }
            }
        })
            ->where(function ($innerSql)use ($search_params) {
                $innerSql->whereHas('brand', function ($brand_sql) use ($search_params) {
                    $brand_sql->where('archive', 0);
                    $brand_sql->where('status', 0);
                    if (!empty($search_params['brands'])) {
                        $brand_sql->whereIn('slug', $search_params['brands']);
                    }
                });
            })
            ->where(function ($innerSql) use ($search_params) {
                $innerSql->whereHas('category', function ($cat_sql) use ($search_params) {
                    $cat_sql->where('archive', 0);
                    if (!empty($search_params['category']) && $search_params['category'] != 'all') {
                        $cat_sql->where('slug', $search_params['category']);
                    }
                });
                $innerSql->whereHas('sub_category', function ($cat_sql) use ($search_params) {
                    $cat_sql->where('archive', 0);
                    if (!empty($search_params['sub_categories'])) {
                        $cat_sql->whereIn('slug', $search_params['sub_categories']);
                    }
                });
            })
            ->with('videos', 'image', 'manuals', 'sizes', 'colors')
            ->with(['favorites' => function ($fav_sql) use ($search_params) {
                $fav_sql->where('user_id', $search_params['user_id']);
            }])
            ->where('is_approved', 1)
            ->limit($search_params['limit'])
            ->offset($search_params['offset'])
            ->orderBy($colName, $orderBy)
            ->where('archive', 0)
            ->where('is_approved', 1)
            ->count();
    }

    /**
     * getFeaturedItems method
     * @param type $search_params
     * @return type
     */
    public function getFeaturedItems($search_params, $user_id = null)
    {
        return $this->where('is_featured', 1)
                        ->limit($search_params['limit'])
                        ->offset($search_params['offset'])
            ->with(['favorites' => function ($sql) use ($user_id) {
                $sql->where('user_id', $user_id);
            }])
            ->whereHas('category', function ($sql) {
                $sql->where('archive', 0);
            })
            ->whereHas('sub_category', function ($sql) {
                $sql->where('archive', 0);
            })
            ->whereHas('brand', function ($brand_sql)  {
                    $brand_sql->where('archive', 0);
                    $brand_sql->where('status', 0);
                })
            ->where('archive', 0)
            ->where('is_approved', 1)
            ->with('image')
            ->get();
    }

    /**
     * getFeaturedItems method
     * @param type $search_params
     * @return type
     */
    public function getFeaturedItemsCount()
    {
        return $this->whereHas('category', function ($sql) {
            $sql->where('archive', 0);
        })
            ->whereHas('sub_category', function ($sql) {
                $sql->where('archive', 0);
            })
            ->whereHas('brand', function ($brand_sql)  {
                $brand_sql->where('archive', 0);
                $brand_sql->where('status', 0);
            })
            ->where('archive', 0)
            ->where('is_approved', 1)
            ->count();
    }

    /**
     * get Fresh Items
     * to check items in stock details
     * @return type
     */
    public function getFreshItems($uuids)
    {

        return $this->whereIn('uuid', $uuids)
            ->with('category', 'sub_category','colors')
            ->get();
    }

    /**
     * get Fresh Items
     * to check items in stock details
     * @return type
     */
    public function getFreshItemsCount($col, $val)
    {

        return $this->where($col, $val)
            ->whereHas('ordersItems', function ($sql) {
                $sql->whereHas('order', function ($innderSql) {
                    $innderSql->where('archive', 0);
                    $innderSql->whereIn('order_status_id', [1, 2, 3, 4]);
                });
            })->with('ordersItems')
            ->first();
    }

}
