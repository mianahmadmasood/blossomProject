<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Categories
 *    use \App\Http\Traits\UploadsService;

 * @author qadeer
 */

use App\Http\Responses\ResponseBrand;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\Config;


class Brands extends Config {



    /**
     * Injecting related response class
     * @return ResponseItem
     */
    public function jsonResponse($brands, $lang, $count)
    {
        return new ResponseBrand($brands, $lang, $count);
    }
    /**
     * showItem method
     * show single item response
     * @param type $slug
     * @return type
     */
    public function listBrands()
    {

        $request_params = Input::all();
        $brands = $this->getBrandModel()->getBrands();

        $count = 0;
        if (empty($brands)) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
        }

        return $this->jsonResponse($brands, $request_params['lang'], $count)->preapreResponse();
    }









}
