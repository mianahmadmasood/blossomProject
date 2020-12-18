<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

/**
 * Description of ResponseCategories
 *
 * @author qadeer
 */
use App\Http\Responses\BaseResponse;
use Illuminate\Database\Eloquent\Collection;

class ResponseCategories extends BaseResponse {

    protected $list;
    protected $lang;
    protected $brands;

    function __construct(Collection $categories, string $lang,$brands) {
        $this->list = $categories;
        $this->lang = $lang;
        $this->brands = $brands;
    }

    /**
     * preapreResponse method
     * prepare response for categories
     * @return json response
     */
    public function preapreResponse() {

        $response = [];

        foreach ($this->list as $key => $category) {

            $response[$key]['uuid'] = $category->uuid;
            $response[$key]['slug'] = $category->slug;
            $response[$key]['title'] = $this->lang == 'ar' ? $category->ar_title : $category->en_title;
            $response[$key]['image'] = !empty($category->image) ? $category->image : 'Category_5daf2155ba6481571758421.jpg';
            $response[$key]['icon_image'] = !empty($category->icon_image) ? $category->icon_image : 'Category_5daf2155ba6481571758421.jpg';

            $response[$key]['sub_categories'] = $this->prepareSubCatgories($category->sub_categories);
        }
        $response_message = $this->getMessageData('success', $this->lang)['general_success'];
        $data['categories'] = $response;
        $data['brands'] = $this->prepareBrands();
        return $this->jsonSuccessResponse($response_message, $data);
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
