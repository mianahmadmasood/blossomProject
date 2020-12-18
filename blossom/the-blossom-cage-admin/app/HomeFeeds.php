<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeFeeds extends Model
{

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'home_feeds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id',
        'categories_id',
        'sub_categories_id',
        'item_id',
        'en_banner',
        'ar_banner',
        'ordering_sort',
        'type',
        'status',

    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * getBanners method get all the categories
     * @param type $searchText
     * @return collection
     */

    public function items()
    {

        return $this->hasOne(Item::class, 'id', 'item_id');
    }

    /**
     * Get the image category associated with the item.
     */
    public function category()
    {

        return $this->hasOne(Category::class, 'id', 'categories_id');
    }

    /**
     * Get the sub_category record associated with the item.
     */
    public function sub_category()
    {

        return $this->hasOne(Category::class, 'id', 'sub_categories_id');
    }

    /**
     * Get the Brand record associated with the item.
     */
    public function brand()
    {
        return $this->hasOne(Brands::class, 'id', 'brand_id');
    }

    public function getnewHomefeeds($searchText)
    {
        return $this
            ->whereHas('items', function ($sql) {
        $sql->where('archive', 0)
            ->where('sale_price', '>', 0)
            ->where('is_approved', 1)
            ->whereHas('category', function ($sql) {
                $sql->where('archive', 0);
            })
            ->whereHas('sub_category', function ($sql) {
                $sql->where('archive', 0);
            })
            ;
    })
        ->whereHas('category', function ($sql) {
            $sql->where('archive', 0);
        })
        ->whereHas('sub_category', function ($sql) {
            $sql->where('archive', 0);
        })
        ->with(['brand' => function ($sql) {
            $sql->where('archive', 0);
        }])
        ->where('type', $searchText)
        ->where('archive', 0)
        ->with('items', 'category', 'sub_category')
        ->orderBy('id', 'ASC')
        ->get();
    }

    public function getHomefeeds($searchText)
    {
        return $this->where('archive', 0)
            ->where('type', $searchText)
            ->orderBy('ordering_sort', 'ASC')
//            ->paginate(10);
//            ->take(10)
            ->get();
    }

    public function getHomefeedsTopCategoires()
    {
        return $this
            ->whereHas('items', function ($sql) {
                $sql->where('archive', 0)
                    ->where('sale_price', '>', 0)
                    ->where('is_approved', 1)
                    ->whereHas('category', function ($sql) {
                        $sql->where('archive', 0);
                    })
                    ->whereHas('sub_category', function ($sql) {
                        $sql->where('archive', 0);
                    });
            })
            ->whereHas('category', function ($sql) {
                $sql->where('archive', 0);
            })
            ->whereHas('sub_category', function ($sql) {
                $sql->where('archive', 0);
            })
//            ->whereHas('brand', function ($sql) {
//                $sql->where('archive', 0);
//            })
            ->whereIN('type', ['top_categories_1', 'top_categories_2', 'top_categories_3', 'top_categories_4'])
            ->where('archive', 0)
            ->with('items', 'category', 'brand', 'sub_category')
            ->orderBy('id', 'ASC')
            ->get();
    }

    /**
     * getBanners method get all the categories
     * @param type $searchText
     * @return collection
     */
    public function getBannersArhived($searchText = NULL)
    {
        return $this->where('archive', 1)
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

}
