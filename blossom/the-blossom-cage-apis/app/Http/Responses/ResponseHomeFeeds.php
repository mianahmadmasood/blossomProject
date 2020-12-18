<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

/**
 * Description of ResponseItem
 *
 * @author qadeer
 */

use App\Http\Responses\BaseResponse;
use Illuminate\Database\Eloquent\Collection;

class ResponseHomeFeeds extends BaseResponse
{

    protected $list;
    protected $lang;

    function __construct(Collection $homefeeds,$homefeedsBrand,$homefeedsCategories,$homefeedsBanners,$homefeedsTrendyItem,$homefeedsAllBrands,$items, string $lang,$convertRate = 1,$pageNo)
    {


        $this->homefeeds = $homefeeds;
        $this->homefeedsBrand = $homefeedsBrand;
        $this->homefeedsCategories = $homefeedsCategories;
        $this->homefeedsBanners = $homefeedsBanners;
        $this->homefeedsTrendyItem = $homefeedsTrendyItem;
        $this->homefeedsAllBrands = $homefeedsAllBrands;
        $this->items = $items;
        $this->convertRate  = $convertRate;
        $this->pageNo = $pageNo;
        $this->lang = $lang;
    }

    /**
     * preapreResponse method
     * prepares response for item
     * @return type
     */
    public function preapreResponse()
    {
        $data =  Array();
        $response = Array();
        $homefeedsTrendyItemCount  = $falshDealsCount  = $top_categories1Count
            = $top_categories2Count = $top_categories3Count = $top_categories4Count= $bannerCount = $top_salesCount = 0;
        foreach ($this->homefeeds as $key => $homefeed) {


             if ($homefeed->type == 'top_sales') {
                $response['top_sales'][$top_salesCount] = $this->prepareTopSales($homefeed);
                $top_salesCount++;
            } else if ($homefeed->type == 'falshDeals') {
                $response['falshDeals'][$falshDealsCount] = $this->prepareBanners($homefeed);
                $falshDealsCount++;
            }  else if ($homefeed->type == 'top_categories_1') {
                $response['top_categories_1'][$top_categories1Count] = $this->prepareBanners($homefeed);
                $top_categories1Count++;
            }else if ($homefeed->type == 'top_categories_2') {
                $response['top_categories_2'][$top_categories2Count] = $this->prepareBanners($homefeed);
                $top_categories2Count++;
            }else if ( $homefeed->type == 'top_categories_3' ) {
                $response['top_categories_3'][$top_categories3Count] = $this->prepareBanners($homefeed);
                $top_categories3Count++;
            }else if ($homefeed->type == 'top_categories_4') {
                $response['top_categories_4'][$top_categories4Count] = $this->prepareBanners($homefeed);
                $top_categories4Count++;
            }else if ($homefeed->type == 'trendy_item') {
                $response['trendy_item'][$homefeedsTrendyItemCount] = $this->prepareTrendyitems($homefeed);
                $homefeedsTrendyItemCount++;
            }
        }

        $response = $this->preparetopBrands($response);
        $response = $this->preparetopBanners($response);
        // $response = $this->prepareTrendyitems($response);
        $response = $this->prepareCategories($response);
        $response = $this->prepareAllBrands($response);
        $response= $this->preapreResponseItems($response);
        $response['convertRate'] = $this->convertRate;
        $response_message = $this->getMessageData('success', $this->lang)['general_success'];

        return $this->jsonSuccessResponse($response_message, $response);
    }


    public function prepareTopSales($homefeed)
    {
        $response = Array();
        $response['uuid'] = $homefeed->uuid;
        $response['item_id'] = !empty($homefeed->item_id)? $homefeed->item_id:null;

        $response['uuid'] = !empty($homefeed['items']->uuid)?$homefeed['items']->uuid:null;
        $response['slug'] = !empty($homefeed['items']->slug) ? $homefeed['items']->slug : null;
        $response['is_favorite'] = !empty($homefeed['items']->favorites) ? true : false;
        $response['title'] =  $this->lang == 'ar' ? $homefeed['items']->ar_title : $homefeed['items']->en_title;
        $response['en_title'] = !empty($homefeed['items']->en_title) ? $homefeed['items']->en_title : null;
        $response['ar_title'] = !empty($homefeed['items']->ar_title) ? $homefeed['items']->ar_title : null;
        $response['price'] = !empty($homefeed['items']->price) ? $homefeed['items']->price : null;
        $response['sale_price'] = !empty($homefeed['items']->sale_price) ? $homefeed['items']->sale_price : null;


        $response['discounted_type'] = !empty($homefeed['items']->discounted_type)?$homefeed['items']->discounted_type:null;
        $response['discount'] =!empty($homefeed['items']->discount) && $homefeed['items']->discount > 0 ?$homefeed['items']->discount:null;

        $response['image'] = !empty($homefeed->items->images[0]->image) ? $homefeed->items->images[0]->image : null;

        $response['categories_id'] = !empty($homefeed->categories_id)?$homefeed->categories_id:null;
        $response['category_slug'] = !empty($homefeed['category']->slug) ? $homefeed['category']->slug : null;
        $response['category_en_title'] = !empty($homefeed['category']->en_title) ? $homefeed['category']->en_title : null;
        $response['category_ar_title'] = !empty($homefeed['category']->ar_title) ? $homefeed['category']->ar_title : null;
        $response['category_image'] = !empty($homefeed['category']->image) ? $homefeed['category']->image : null;
        $response['sub_categories_id'] = !empty($homefeed->sub_categories_id)?$homefeed->sub_categories_id:null;
        $response['sub_category_en_title'] = !empty($homefeed['sub_category']->en_title) ? $homefeed['sub_category']->en_title : null;
        $response['sub_category_ar_title'] = !empty($homefeed['sub_category']->ar_title) ? $homefeed['sub_category']->ar_title : null;
        $response['sub_category_image'] = !empty($homefeed['sub_category']->image) ? $homefeed['sub_category']->image : null;

        $response['ordering_sort'] = !empty($homefeed->ordering_sort) ? $homefeed->ordering_sort : null;
        $response['type'] = !empty($homefeed->type) ? $homefeed->type : null;
        return $response;
    }

    public function prepareBanners($homefeed)
    {
        $response = Array();
        $response['uuid'] = $homefeed->uuid;
        $response['item_id'] = !empty($homefeed->item_id) ? $homefeed->item_id : null;

        $response['item_uuid'] = !empty($homefeed['items']->uuid) ? $homefeed['items']->uuid : null;
        $response['item_slug'] = !empty($homefeed['items']->slug) ? $homefeed['items']->slug : null;
        $response['item_is_favorite'] = !empty($homefeed['items']->favorites) ? true : false;
        $response['item_en_title'] = !empty($homefeed['items']->en_title) ? $homefeed['items']->en_title : null;
        $response['item_ar_title'] = !empty($homefeed['items']->ar_title) ? $homefeed['items']->ar_title : null;
        $response['item_price'] = !empty($homefeed['items']->price) ? $homefeed['items']->price : null;
        $response['item_sale_price'] = !empty($homefeed['items']->sale_price) ? $homefeed['items']->sale_price : null;

        $response['discounted_type'] = !empty($homefeed['items']->discounted_type)?$homefeed['items']->discounted_type:null;
         $response['discount'] =!empty($homefeed['items']->discount) && $homefeed['items']->discount > 0 ?$homefeed['items']->discount:null;

        $response['item_image'] = !empty($homefeed->items->images[0]->image) ? $homefeed->items->images[0]->image : null;
        $response['categories_id'] = !empty($homefeed->categories_id) ? $homefeed->categories_id : null;
        $response['category_slug'] = !empty($homefeed['category']->slug) ? $homefeed['category']->slug : null;
        $response['category_en_title'] = !empty($homefeed['category']->en_title) ? $homefeed['category']->en_title : null;
        $response['category_ar_title'] = !empty($homefeed['category']->ar_title) ? $homefeed['category']->ar_title : null;
        $response['category_image'] = !empty($homefeed['category']->image) ? $homefeed['category']->image : null;
        $response['sub_categories_id'] = !empty($homefeed->sub_categories_id) ? $homefeed->sub_categories_id : null;
        $response['sub_category_en_title'] = !empty($homefeed['sub_category']->en_title) ? $homefeed['sub_category']->en_title : null;
        $response['sub_category_ar_title'] = !empty($homefeed['sub_category']->ar_title) ? $homefeed['sub_category']->ar_title : null;
        $response['sub_category_image'] = !empty($homefeed['sub_category']->image) ? $homefeed['sub_category']->image : null;

        $response['brand_id'] = !empty($homefeed->brand_id) ? $homefeed->brand_id : null;
        $response['brand_slug'] = !empty($homefeed['brand']->slug) ? $homefeed['brand']->slug : null;
        $response['brand_en_title'] = !empty($homefeed['brand']->en_title) ? $homefeed['brand']->en_title : null;
        $response['brand_ar_title'] = !empty($homefeed['brand']->ar_title) ? $homefeed['brand']->ar_title : null;
        $response['brand_image'] = !empty($homefeed['brand']->image) ? $homefeed['brand']->image : null;

        $response['en_banner'] = !empty($homefeed->en_banner) ? $homefeed->en_banner : 'Category_5daf2155ba6481571758421.jpg';
        $response['ar_banner'] = !empty($homefeed->ar_banner) ? $homefeed->ar_banner : 'Category_5daf2155ba6481571758421.jpg';
        $response['ordering_sort'] = !empty($homefeed->ordering_sort) ? $homefeed->ordering_sort : null;
        $response['type'] = !empty($homefeed->type) ? $homefeed->type : null;
        return $response;
    }




    public function preparetopBrands($response){
        $top_brandsCount = 0 ;
        foreach ($this->homefeedsBrand as $key => $homefeedBrand) {
            if ($homefeedBrand->type == 'top_brands') {
                $response['top_brands'][$top_brandsCount] = $this->prepareBanner($homefeedBrand);
                $top_brandsCount++;
            }
        }
        return $response ;
    }

    public function prepareBanner($homefeed)
    {
        $response = Array();
        $response['uuid'] = $homefeed->uuid;
        $response['id'] = !empty($homefeed->brand_id)?$homefeed->brand_id:null;
        $response['slug'] = !empty($homefeed['brand']->slug) ? $homefeed['brand']->slug : null;
        $response['title'] =  $this->lang == 'ar' ? $homefeed['brand']->ar_title : $homefeed['brand']->en_title;
        $response['en_title'] = !empty($homefeed['brand']->en_title) ? $homefeed['brand']->en_title : null;
        $response['ar_title'] = !empty($homefeed['brand']->ar_title) ? $homefeed['brand']->ar_title : null;
        $response['image'] = !empty($homefeed['brand']->image) ? $homefeed['brand']->image : null;
        $response['en_banner'] = !empty($homefeed->en_banner) ? $homefeed->en_banner : 'Category_5daf2155ba6481571758421.jpg';
        $response['ar_banner'] = !empty($homefeed->ar_banner) ? $homefeed->ar_banner : 'Category_5daf2155ba6481571758421.jpg';
        $response['ordering_sort'] = !empty($homefeed->ordering_sort) ? $homefeed->ordering_sort : null;
        $response['type'] = !empty($homefeed->type) ? $homefeed->type : null;

        return $response;
    }

    public function prepareTrendyitems($homefeed)
    {
        // dd($homefeed['items']);
        $response = Array();
        $response['uuid'] = $homefeed->uuid;
        $response['item_id'] = !empty($homefeed->item_id)? $homefeed->item_id:null;

        $response['uuid'] = !empty($homefeed['items']->uuid)?$homefeed['items']->uuid:null;
        $response['slug'] = !empty($homefeed['items']->slug) ? $homefeed['items']->slug : null;
        $response['is_favorite'] = !empty($homefeed['items']->favorites) ? true : false;
        $response['title'] =  $this->lang == 'ar' ? $homefeed['items']->ar_title : $homefeed['items']->en_title;
        $response['en_title'] = !empty($homefeed['items']->en_title) ? $homefeed['items']->en_title : null;
        $response['ar_title'] = !empty($homefeed['items']->ar_title) ? $homefeed['items']->ar_title : null;
        $response['price'] = !empty($homefeed['items']->price) ? $homefeed['items']->price : null;
        $response['sale_price'] = !empty($homefeed['items']->sale_price) ? $homefeed['items']->sale_price : null;


        $response['discounted_type'] = !empty($homefeed['items']->discounted_type)?$homefeed['items']->discounted_type:null;
        $response['discount'] =!empty($homefeed['items']->discount) && $homefeed['items']->discount > 0 ?$homefeed['items']->discount:null;

        $response['image'] = !empty($homefeed->items->images[0]->image) ? $homefeed->items->images[0]->image : null;

        $response['categories_id'] = !empty($homefeed->categories_id)?$homefeed->categories_id:null;
        $response['category_slug'] = !empty($homefeed['category']->slug) ? $homefeed['category']->slug : null;
        $response['category_en_title'] = !empty($homefeed['category']->en_title) ? $homefeed['category']->en_title : null;
        $response['category_ar_title'] = !empty($homefeed['category']->ar_title) ? $homefeed['category']->ar_title : null;
        $response['category_image'] = !empty($homefeed['category']->image) ? $homefeed['category']->image : null;
        $response['sub_categories_id'] = !empty($homefeed->sub_categories_id)?$homefeed->sub_categories_id:null;
        $response['sub_category_en_title'] = !empty($homefeed['sub_category']->en_title) ? $homefeed['sub_category']->en_title : null;
        $response['sub_category_ar_title'] = !empty($homefeed['sub_category']->ar_title) ? $homefeed['sub_category']->ar_title : null;
        $response['sub_category_image'] = !empty($homefeed['sub_category']->image) ? $homefeed['sub_category']->image : null;

        $response['ordering_sort'] = !empty($homefeed->ordering_sort) ? $homefeed->ordering_sort : null;
        $response['type'] = !empty($homefeed->type) ? $homefeed->type : null;
        return $response;
    }

    public function preparetopBanners($response){
        $bannerCount = 0 ;
        foreach ($this->homefeedsBanners as $key => $homefeedBanner) {
            if ($homefeedBanner->type == 'banners') {
                $response['banners'][$bannerCount] = $this->prepareBanners($homefeedBanner);
                $bannerCount++;
            }
        }
        return $response ;
    }

    public function preparetopBanner($homefeed)
    {
        $response = Array();
        $response['uuid'] = $homefeed->uuid;
        $response['en_banner'] = !empty($homefeed->en_banner) ? $homefeed->en_banner : 'Category_5daf2155ba6481571758421.jpg';
        $response['ar_banner'] = !empty($homefeed->ar_banner) ? $homefeed->ar_banner : 'Category_5daf2155ba6481571758421.jpg';
        $response['ordering_sort'] = !empty($homefeed->ordering_sort) ? $homefeed->ordering_sort : null;
        $response['type'] = !empty($homefeed->type) ? $homefeed->type : null;
        return $response;
    }

    public function prepareCategories($response){

        foreach ($this->homefeedsCategories as $key => $homefeedsCategory) {
            $response['homefeedsCategories'][$key]['uuid'] = $homefeedsCategory->uuid;
            $response['homefeedsCategories'][$key]['slug'] = $homefeedsCategory->slug;
            $response['homefeedsCategories'][$key]['title'] = $this->lang == 'ar' ? $homefeedsCategory->ar_title : $homefeedsCategory->en_title;
            $response['homefeedsCategories'][$key]['ar_title'] =  $homefeedsCategory->ar_title;
            $response['homefeedsCategories'][$key]['en_title'] = $homefeedsCategory->en_title;
            $response['homefeedsCategories'][$key]['image'] = !empty($homefeedsCategory->image) ? $homefeedsCategory->image : 'Category_5daf2155ba6481571758421.jpg';
            $response['homefeedsCategories'][$key]['icon_image'] = !empty($homefeedsCategory->icon_image) ? $homefeedsCategory->icon_image : 'Category_5daf2155ba6481571758421.jpg';
            $response['homefeedsCategories'][$key]['sub_categories'] = $this->prepareSubCatgories($homefeedsCategory->sub_categories);
        }
        return $response ;
    }
    public function prepareAllBrands($response){

        foreach ($this->homefeedsAllBrands as $key => $brand) {
            $response['all_brands'][$key]['uuid'] = $brand->uuid;
            $response['all_brands'][$key]['title'] = $this->lang == 'ar' ? $brand->ar_title : $brand->en_title;
            $response['all_brands'][$key]['en_title'] = $brand->en_title;
            $response['all_brands'][$key]['ar_title'] = $brand->ar_title;
            $response['all_brands'][$key]['slug'] = $brand->slug;
            $response['all_brands'][$key]['image'] = $brand->image;
        }

        return $response ;
    }

    /**
     * prepareSubCatgories method
     * prepare response for sub-categories
     * @return json response
     */
    public function prepareSubCatgories($list) {

        $response = Array();

        foreach ($list as $key => $category) {

            $response[$key]['uuid'] = $category->uuid;
            $response[$key]['slug'] = $category->slug;
            $response[$key]['image'] = !empty($category->image) ? $category->image : 'Category_5daf2155ba6481571758421.jpg';
            $response[$key]['title'] = $this->lang == 'ar' ? $category->ar_title : $category->en_title;
            $response[$key]['ar_title'] =  $category->ar_title;
            $response[$key]['en_title'] = $category->en_title;
        }
        return $response;
    }





    public function preapreResponseItems($response)
    {
        $data = [];

        foreach ($this->items as $key => $item) {

            $data[$key]['uuid'] = $item->uuid;
            $data[$key]['title'] = $this->lang == 'ar' ? $item->ar_title : $item->en_title;
            $data[$key]['en_title'] = $item->en_title;
            $data[$key]['ar_title'] = $item->ar_title;
            $data[$key]['price'] = $item->price;
            $data[$key]['sale_price'] = $item->sale_price;
            $data[$key]['discounted_type'] = $item->discounted_type;
            $response['discount'] =!empty($item->discount) && $item->discount > 0 ?$item->discount:null;
            $data[$key]['discount'] = $item->discount;
            $data[$key]['quantity'] = $this->prepareItemQuantity($item);
            $data[$key]['cart_quantity'] = $item->cart_quantity;
            $data[$key]['slug'] = $item->slug;
            $data[$key]['image'] = $item->image->image;
            $data[$key]['cat_en_title'] = $item->category->en_title;
            $data[$key]['cat_ar_title'] = $item->category->ar_title;
            $data[$key]['cat_slug'] = $item->category->slug;
            $data[$key]['is_favorite'] = !empty($item->favorites) ? true : false;
            $data[$key]['is_featured'] = $item->is_featured;

        }
        $response['featuredItems'] = $data;
        $response['count'] = 1;
        $response['convertRate'] = 1;
        return  $response;
    }

    /**
     *
     * @param type $item
     * @return int
     */
    public function prepareItemQuantity($item)
    {


        $order_items = new \App\OrderItem();
        $itemqtyNew=0;
        $itemqtyOld=0;

//        $total_sold_item = $order_items->fetchSoldItems($item->id);
        foreach ($item->colorItems as $colorItems){
            $total_sold_item = $order_items->fetchSoldItemsColorQty($item->id,$colorItems->id);
            $itemqtyOld =$itemqtyOld+$total_sold_item;
            $itemqtyNew =$itemqtyNew+$colorItems->color_quantity;

        }

        if (!empty($itemqtyOld)) {

            $remaining_stock = $itemqtyNew - $itemqtyOld;
            if ($remaining_stock < 0) {
                return 0;
            }
            return $remaining_stock;
        } else {
            return $itemqtyNew;
        }
    }


}
