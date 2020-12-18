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

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\Config;

class Accessories extends Config {

    /**
     * storeCategory method
     * stores the category record to the database
     * @param type $request
     * @return type
     */
    public function storeAccessorie($request) {

        $request_params = $request->all();

        $request_params['slug'] = $this->prepareSlug($request_params['en_title']);

        return $this->storeAccessorieProcess($request_params);
    }

    /**
     * storeCategoryProcess method
     * process the storeCategory functionality for further
     * @param type $request_params
     * @return type
     */


    public function addImage($request) {
        $upload = $this->uploadSingleImage($request->file('image'), $this->s3_image_paths['accessorie_images'], 'accessorie_');
        if ($upload['success']) {
            $file_name = explode('.', $upload['file_name']);
            $response['file_name'] = $upload['file_name'];
            $response['div_id'] = $file_name[0];
            return $this->jsonSuccessResponse('Image has been uploaded successfully.', $response);
        } else {
            return $this->jsonErrorResponse('Sorry! Something went wrong while uploading. Please try again.');
        }
    }

    public function storeAccessorieProcess($request_params) {

        $store = $this->getAccessorieModel()->create($request_params);

        if ($store) {

            return redirect()->route('getAccessories')->with('success_message', 'Accessorie data is saved successfully');

        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }


    /**
     * getCategoriesList method 
     * get all the categories 
     * @return view
     */
    public function getAccessoriesList() {

        $request_params = \Illuminate\Support\Facades\Input::all();
        $searchText = !empty($request_params['search']) ? base64_decode($request_params['search']) : '';

//        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $accessories = $this->getAccessorieModel()->getAccessories($searchText);

        return view('pages.accessories.all', compact('accessories', 'searchText'));
    }

    /**
     * Deleted categories
     * @return type
     */
    public function getDeletedAccessories() {

        $request_params = Input::all();
        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $accessories = $this->getAccessorieModel()->getAccessoriesArhived($searchText);
        return view('pages.accessories.deleted', compact('accessories', 'searchText'));
    }



    /**
     * editCategory method 
     * takes id or category resource 
     * @param type $uid
     * @return type
     */
    public function editAccessorie($uid) {

        $accessorie = $this->getAccessorieModel()->where('uuid', $uid)->first();

        return view('pages.accessories.edit', compact('accessorie'));
    }



    /**
     * updateCategory method
     * update the category in the database
     * @param type $request
     * @return type
     */
    public function updateAccessorie($request) {

        $request_params = $request->except('_token');

        $accessorie = $this->getAccessorieModel()->where('id', $request_params['id'])->first();

        if (empty($accessorie)) {

            return redirect()->back()->with('error_message', 'No record found.');
        }

        return $this->updateAccessorieProcess($request_params, $accessorie);
    }

    /**
     * updateSubCategoryProcess method 
     * updates sub category in the database
     * @param type $request_params
     * @return type
     */
    public function updateAccessorieProcess($request_params, $accessorie) {

        return $this->updateAccessorieProcessFinal($request_params, $accessorie);
    }

    /**
     * updateCategoryProcessFinal method 
     * updates a category in the database
     * @param type $request_params
     * @param type $category
     * @return type
     */
    public function updateAccessorieProcessFinal($request_params, $accessorie) {

        if(!empty($request_params['image'])){
            $accessorie->image =   $request_params['image'] ;
        }
        $accessorie->en_title = !empty($request_params['en_title']) ? $request_params['en_title'] : $accessorie->en_title;
        $accessorie->ar_title = !empty($request_params['ar_title']) ? $request_params['ar_title'] : $accessorie->ar_title;
        $accessorie->price = !empty($request_params['price']) ? $request_params['price'] : $accessorie->price;
        $accessorie->slug = $this->prepareSlug($accessorie->en_title);

        if ($accessorie->save()) {

            return redirect()->route('getAccessories')->with('success_message', 'Accessorie data is updated successfully');
        } else {
            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }


    /**
     * state method 
     * change the status of the category
     * @param type $uid
     * @param type $state
     * @return redirect
     */
    public function archive($uid, $state) {

        if ($state == 'in-active') {
            $archive = 1;
        } else {
            $archive = 0;
        }

        $accessorie = $this->getAccessorieModel()->getAccessorieItem($uid);
        $itemAccessorie = $this->getItemAccessorieModel()->where('accessories_id',$accessorie->id)->first();
        
        if ($itemAccessorie !== NULL) {
            return redirect()->back()->with('error_message', 'You can not remove this accessorie right now because the items assigned to this accessorie.');
        }

        $update = $this->getAccessorieModel()->where('uuid', $uid)->update(['archive' => $archive]);
        if ($update) {
            return redirect()->back()->with('success_message', 'Accessorie updated saved successfully');
        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }
    /**
     * state method
     * change the status of the category
     * @param type $uid
     * @param type $state
     * @return redirect
     */
    public function state($uid, $state) {

        if ($state == 'in-active') {
            $archive = 1;
        } else {
            $archive = 0;
        }
        $update = $this->getAccessorieModel()->where('uuid', $uid)->update(['status' => $archive]);
        if ($update) {
            return redirect()->back()->with('success_message', 'Accessorie updated saved successfully');
        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }


}
