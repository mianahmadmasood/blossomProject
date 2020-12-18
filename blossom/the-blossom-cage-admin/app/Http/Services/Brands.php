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

class Brands extends Config {

    /**
     * storeCategory method
     * stores the category record to the database
     * @param type $request
     * @return type
     */
    public function storeBrand($request) {

        $request_params = $request->all();

        $request_params['slug'] = $this->prepareSlug($request_params['en_title']);

        return $this->storeBrandProcess($request_params);
    }

    /**
     * storeCategoryProcess method
     * process the storeCategory functionality for further
     * @param type $request_params
     * @return type
     */


    public function addImage($request) {
        $upload = $this->uploadSingleImage($request->file('image'), $this->s3_image_paths['brand_images'], 'brand_');
        if ($upload['success']) {
            $file_name = explode('.', $upload['file_name']);
            $response['file_name'] = $upload['file_name'];
            $response['div_id'] = $file_name[0];
            return $this->jsonSuccessResponse('Image has been uploaded successfully.', $response);
        } else {
            return $this->jsonErrorResponse('Sorry! Something went wrong while uploading. Please try again.');
        }
    }

    public function storeBrandProcess($request_params) {

        $store = $this->getBrandModel()->create($request_params);

        if ($store) {

            return redirect()->route('getBrands')->with('success_message', 'Brand data is saved successfully');

        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }


    /**
     * getCategoriesList method 
     * get all the categories 
     * @return view
     */
    public function getBrandsList() {

        $request_params = \Illuminate\Support\Facades\Input::all();
        $searchText = !empty($request_params['search']) ? base64_decode($request_params['search']) : '';

//        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $brands = $this->getBrandModel()->getBrands($searchText);

        return view('pages.brands.all', compact('brands', 'searchText'));
    }

    /**
     * Deleted categories
     * @return type
     */
    public function getDeletedBrands() {

        $request_params = Input::all();
        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $brands = $this->getBrandModel()->getBrandsArhived($searchText);
        return view('pages.brands.deleted', compact('brands', 'searchText'));
    }



    /**
     * editCategory method 
     * takes id or category resource 
     * @param type $uid
     * @return type
     */
    public function editBrand($uid) {

        $brand = $this->getBrandModel()->where('uuid', $uid)->first();

        return view('pages.brands.edit', compact('brand'));
    }



    /**
     * updateCategory method
     * update the category in the database
     * @param type $request
     * @return type
     */
    public function updateBrand($request) {

        $request_params = $request->except('_token');

        $brand = $this->getBrandModel()->where('id', $request_params['id'])->first();

        if (empty($brand)) {

            return redirect()->back()->with('error_message', 'No record found.');
        }

        return $this->updateBrandProcess($request_params, $brand);
    }

    /**
     * updateSubCategoryProcess method 
     * updates sub category in the database
     * @param type $request_params
     * @return type
     */
    public function updateBrandProcess($request_params, $brand) {

        return $this->updateBrandProcessFinal($request_params, $brand);
    }

    /**
     * updateCategoryProcessFinal method 
     * updates a category in the database
     * @param type $request_params
     * @param type $category
     * @return type
     */
    public function updateBrandProcessFinal($request_params, $brand) {

        if(!empty($request_params['image'])){
            $brand->image =   $request_params['image'] ;
        }
        $brand->en_title = !empty($request_params['en_title']) ? $request_params['en_title'] : $brand->en_title;
        $brand->ar_title = !empty($request_params['ar_title']) ? $request_params['ar_title'] : $brand->ar_title;
        $brand->slug = $this->prepareSlug($brand->en_title);

        if ($brand->save()) {

            return redirect()->route('getBrands')->with('success_message', 'Brand data is updated successfully');
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

        $check_employee_status = $this->getBrandModel()->getBrandItem($uid);

        if ($check_employee_status !== NULL) {
            return redirect()->back()->with('error_message', 'You can not remove this brand right now because the items assigned to this brand.');
        }

        $update = $this->getBrandModel()->where('uuid', $uid)->update(['archive' => $archive]);
        if ($update) {
            return redirect()->back()->with('success_message', 'Brand updated saved successfully');
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
        $update = $this->getBrandModel()->where('uuid', $uid)->update(['status' => $archive]);
        if ($update) {
            return redirect()->back()->with('success_message', 'Brand updated saved successfully');
        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }


}
