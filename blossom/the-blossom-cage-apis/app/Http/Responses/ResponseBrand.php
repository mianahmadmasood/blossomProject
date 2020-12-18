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

class ResponseBrand extends BaseResponse
{

    protected $list;
    protected $lang;
    protected $count;

    function __construct(Collection $brands, string $lang, $count = 0)
    {

        $this->list = $brands;
        $this->lang = $lang;
        $this->count = $count;
    }

    /**
     * preapreResponse method
     * prepares response for item
     * @return type
     */
    public function preapreResponse()
    {
        $data = [];
        foreach ($this->list as $key => $brand) {
                $data[$key]['uuid'] = $brand->uuid;
                $data[$key]['title'] = $this->lang == 'ar' ? $brand->ar_title : $brand->en_title;
                $data[$key]['en_title'] = $brand->en_title;
                $data[$key]['ar_title'] = $brand->ar_title;
                $data[$key]['slug'] = $brand->slug;
                $data[$key]['image'] = $brand->image;
        }
        $response_message = $this->getMessageData('success', $this->lang)['general_success'];
        $response['brands'] = $data;
        return $this->jsonSuccessResponse($response_message, $response);
    }

}
