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

class ResponseItem extends BaseResponse
{

    protected $list;
    protected $lang;
    protected $count;
    protected $convertRate;
    protected $categories;
    protected $brands;

    function __construct(Collection $items, string $lang, $count = 0,$convertRate = 1,$categories,$brands,$pageNo)
    {


        $this->list = $items;
        $this->lang = $lang;
        $this->count = $count;
        $this->convertRate = $convertRate;
        $this->categories = $categories;
        $this->brands = $brands;
        $this->pageNo = $pageNo;
    }

    /**
     * preapreResponse method
     * prepares response for item
     * @return type
     */
    public function preapreResponse()
    {
        $data = [];
        foreach ($this->list as $key => $item) {
                $data[$key]['uuid'] = $item->uuid;
                $data[$key]['title'] = $this->lang == 'ar' ? $item->ar_title : $item->en_title;
                $data[$key]['en_title'] = $item->en_title;
                $data[$key]['ar_title'] = $item->ar_title;
                $data[$key]['price'] = $item->price;
                $data[$key]['sale_price'] = $item->sale_price;
                $data[$key]['discounted_type'] = $item->discounted_type;
                $data[$key]['discount'] = !empty($item->discount) && $item->discount > 0 ?$item->discount:null;
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
        $response_message = $this->getMessageData('success', $this->lang)['general_success'];
        $response['items'] = $data;
        $response['count'] = $this->count;
        $response['convertRate'] = $this->convertRate;
        if($this->pageNo == 1){
            $response['categories'] = $this->prepareCatgories();
            $response['brands'] = $this->prepareBrands();
        }else {
            $response['categories'] = null;
            $response['brands'] = null;
        }
        return $this->jsonSuccessResponse($response_message, $response);
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

    /**
     * preapreResponse method
     * prepare response for categories
     * @return json response
     */
    public function prepareCatgories() {

        $response = [];

        if (empty($this->categories)) {
            return $this->jsonErrorResponse($this->getMessageData('error', $this->lang)['no_records_found']);
        }
        foreach ($this->categories as $key => $category) {
            $response[$key]['uuid'] = $category->uuid;
            $response[$key]['slug'] = $category->slug;
            $response[$key]['title'] = $this->lang == 'ar' ? $category->ar_title : $category->en_title;
            $response[$key]['image'] = !empty($category->image) ? $category->image : 'Category_5daf2155ba6481571758421.jpg';
            $response[$key]['sub_categories'] = $this->prepareSubCatgories($category->sub_categories);
        }
        return $response;
    }

    /**
     * prepareSubCatgories method
     * prepare response for sub-categories
     * @return json response
     */
    public function prepareSubCatgories($list) {

        $response = [];

        foreach ($list as $key => $category) {

            $response[$key]['uuid'] = $category->uuid;
            $response[$key]['slug'] = $category->slug;
            $response[$key]['image'] = !empty($category->image) ? $category->image : 'Category_5daf2155ba6481571758421.jpg';
            $response[$key]['title'] = $this->lang == 'ar' ? $category->ar_title : $category->en_title;
        }
        return $response;
    }

    /**
     * preapreResponse method
     * prepare response for brand
     * @return json response
     */
    public function prepareBrands() {

        $response = [];
        if (empty($this->brands)) {
            return $this->jsonErrorResponse($this->getMessageData('error', $this->lang)['no_records_found']);
        }
        foreach ($this->brands as $key => $category) {
            $response[$key]['uuid'] = $category->uuid;
            $response[$key]['slug'] = $category->slug;
            $response[$key]['title'] = $this->lang == 'ar' ? $category->ar_title : $category->en_title;
            $response[$key]['image'] = !empty($category->image) ? $category->image : 'Category_5daf2155ba6481571758421.jpg';
        }
        return $response;
    }

}
