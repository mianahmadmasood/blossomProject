<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of ItemService
 *
 * @author qadeer
 */

use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use App\Http\Responses\ResponseItem;
use App\Http\Responses\ResponseItemSingle;

class Item extends Config
{

    /**
     * Injecting related response class
     * @return ResponseItem
     */
    public function jsonResponse($items, $lang, $count,$convertRate,$categories,$brands,$pageNo)
    {

        return new ResponseItem($items, $lang, $count,$convertRate,$categories,$brands,$pageNo);
    }

    /**
     * Injecting related single response class
     * @return ResponseItem
     */
    public function jsonResponseSingle($item, $lang)
    {

        return new ResponseItemSingle($item, $lang);
    }

    /**
     * getItems method
     * list all the items
     * @return type
     */
    public function getItems()
    {

        $request_params = Input::all();
        $convertRate=1;
        $request_params['user_id'] = null;
        if (!empty($request_params['user'])) {
            $request_params['user_id'] = $request_params['user']['id'];
        }
        $search_params = $this->prepareSearchParams($request_params);

        if (isset($request_params['currency']) && !empty($request_params['currency'])  && $request_params['currency'] == 'USD') {
//            $unit = $this->fixirConverter(1, 'USD', 'SAR');
            $unit = $this->fixirConverter(1, 'SAR', 'USD');
           if($unit['success'] == true ){
               $convertRate=(double)$unit['converted_amount'];
           }
        }

        $items = $this->getItemModel()->getItems($search_params);


        if ($items->isEmpty()) {

            if (!empty($search_params['category'])  || !empty($search_params['sub_categories'])) {

                if(isset($search_params['category']) && $search_params['category'] !='all') {
                   $cat_result = $this->getCategoryModel()->where('slug', $search_params['category'])->where('archive', "1")->first();
                   if (!empty($cat_result)) {
                       return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['selected_category_is_no_found']);
                   }
               }

                if(!empty($search_params['sub_categories'])){
                $subcat_result = $this->getCategoryModel()->whereIn('slug', $search_params['sub_categories'])->where('archive', "1")->first();
                if (!empty($subcat_result)) {
                    return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['selected_subcategory_is_no_found']);
                }
                }
            }

        }
        $itemsCount = $this->getItemModel()->getItemsCount($search_params);
        if($search_params['page_no'] == 1) {
            $categories = $this->getCategoryModel()->getParentCategories();
            $brands = $this->getBrandModel()->getBrands();

            if (empty($brands)) {
                return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
            }
            if (empty($categories)) {
                return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
            }
        }else{
            $categories =null;
            $brands = null;
        }
        return $this->jsonResponse($items, $request_params['lang'], $itemsCount,$convertRate,$categories,$brands,$search_params['page_no'])->preapreResponse();
    }

    /**
     * prepareSearchParams method
     * prepares search params for get items
     * @param type $request_params
     * @return type
     */
    public function prepareSearchParams($request_params)
    {

        $search_params = [];


        if (!empty($request_params['price'])) {
            $price = explode(",", $request_params['price']);

            if (!empty($request_params['currency'] && $request_params['currency'] == 'USD')) {
                $unit = $this->fixirConverter(1, 'USD', 'SAR');

                $search_params['min_price'] = $price[0] * $unit['converted_amount'];
                $search_params['max_price'] = $price[1] * $unit['converted_amount'];
            } else {
                $search_params['min_price'] = $price[0];
                $search_params['max_price'] = $price[1];
            }
        }
        if (!empty($request_params['category'])) {
            $search_params['category'] = $request_params['category'];
        }
//        if (!empty($request_params['brand'])) {
//            $search_params['brand'] = $request_params['brand'];
//        }
        if (!empty($request_params['brands'])) {
             $search_params['brands'] = !empty($request_params['brands']) ? explode("|", $request_params['brands']) : [];
         }
        $search_params['user_id'] = $request_params['user_id'];
        $search_params['sub_categories'] = !empty($request_params['sub_categories']) ? explode("|", $request_params['sub_categories']) : [];
        $search_params['search_keyword'] = !empty($request_params['search']) ? $request_params['search'] : '';
        $search_params['sort_by'] = !empty($request_params['sort_by']) ? $request_params['sort_by'] : 'id';
        $search_params['page_no'] = !empty($request_params['page_no']) ? $request_params['page_no'] : 1;
        $search_params['currency'] = !empty($request_params['currency']) ? $request_params['currency'] : null;
        $search_params['offset'] = ($this->limits['items_limt'] * $search_params['page_no']) - $this->limits['items_limt'];
        $search_params['limit'] = $this->limits['items_limt'];
        return $search_params;
    }

    /**
     * showItem method
     * show single item response
     * @param type $slug
     * @return type
     */
    public function showItem($slug)
    {

        $request_params = Input::all();
        $request_params['user_id'] = null;
        if (!empty($request_params['user'])) {
            $request_params['user_id'] = $request_params['user']['id'];
        }
        $item = $this->getItemModel()->getItemDetailsByColumnValue('slug', $slug, $request_params['user_id']);

        if (empty($item)) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
        }

        return $this->jsonResponseSingle($item, $request_params['lang'])->preapreResponseSinle();
    }

    /**
     * showItem method
     * show single item response
     * @param type $slug
     * @return type
     */
    public function featuredItems()
    {

        $request_params = Input::all();

        $user_id = !empty($request_params['user']) ? $request_params['user']->id : NULL;
        if (empty($request_params['page_no'])) {
            $request_params['page_no'] = 1;
        }

        $request_params['limit'] = $this->limits['items_featured_limit'];
        $request_params['offset'] = ($request_params['limit'] * $request_params['page_no']) - $this->limits['items_featured_limit'];

        $items = $this->getItemModel()->getFeaturedItems($request_params, $user_id);
//        $count = $this->getItemModel()->getFeaturedItemsCount();
        $count = 0;
        $convertRate=1;
        $categories=null;
        $brands=null;
        $request_params['page_no'] = 1;
        if (empty($items)) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
        }

        return $this->jsonResponse($items, $request_params['lang'], $count,$convertRate,$categories,$brands,$request_params['page_no'])->preapreResponse();
    }

}
