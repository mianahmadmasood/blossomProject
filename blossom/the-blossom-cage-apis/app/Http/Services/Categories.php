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
use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use App\Http\Responses\ResponseCategories;

class Categories extends Config {

    /**
     * Injecting related response class
     * @return ResponseCategories
     */
    public function jsonResponse($categories, $lang,$brands) {

        return new ResponseCategories($categories, $lang,$brands);
    }

    /**
     * listCategories method
     * prepares list all the categories
     * @return type
     */
    public function listCategories() {

        $request_params = Input::all();
        $categories = $this->getCategoryModel()->getParentCategories();
        $update_device = $this->updateUserDevice($request_params);
        if (!empty($request_params['title'])) {
            $categories = $this->getCategoryModel()->getParentCategories($request_params['title']);
        } else {
            $categories = $this->getCategoryModel()->getParentCategories();
        }

        $brands = $this->getBrandModel()->getBrands();

        if (empty($brands)) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
        }

        if (!empty($categories)) {
            return $this->jsonResponse($categories, $request_params['lang'],$brands)->preapreResponse();
        } else {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
        }
    }

    /**
     * @param type $request_params
     * @return boolean
     */
    public function updateUserDevice($request_params) {
        if (!empty($request_params['user']) && !empty($request_params['device_token']) && !empty($request_params['device_type'])) {
            $this->updateUserLang($request_params['user'], $request_params);
            $device = $this->getUserDeviceModel()->getByColumnValue('user_id', $request_params['user']->id);
            $device->device_type = $request_params['device_type'];
            $device->device_token = $request_params['device_token'];
            return $device->save();
        } elseif (!empty($request_params['guestemail']) && !empty($request_params['device_token']) && !empty($request_params['device_type'])) {
            $user = $this->getUserModel()->getUserByColumnValue('email', $request_params['guestemail']);
            $this->updateGuestUsesDevice($user, $request_params);
            if (!empty($user)) {
                return $this->updateUserLang($user, $request_params);
            }
        } else {
            return true;
        }
    }

    /**
     *
     * @param type $user
     */
    protected function updateUserLang($user, $request_params) {

        $user->lang = $request_params['lang'];
        return $user->save();
    }

    /**
     *
     * @param type $user
     * @param type $request_params
     * @return type
     */
    protected function updateGuestUsesDevice($user, $request_params) {
        if (!empty($user)) {
            if (!empty($user->device)) {
                $device = $user->device;
                $device->device_type = $request_params['device_type'];
                $device->device_token = $request_params['device_token'];
                return $device->save();
            } else {
                $device_data['user_id'] = $user->id;
                $device_data['device_type'] = $request_params['device_type'];
                $device_data['device_token'] = $request_params['device_token'];
                return $this->getUserDeviceModel()->create($device_data);
            }
        }
        return true;
    }

    /**
     * getSubCategoriesList method
     * prepares list for the sub categories
     * @return type
     */
    public function getSubCategoriesList() {

        $request_params = \Illuminate\Support\Facades\Input::all();

        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $categories = $this->getCategoryModel()->getSubCategories($searchText);

        return view('pages.sub-categories.all', compact('categories', 'searchText'));
    }

}
