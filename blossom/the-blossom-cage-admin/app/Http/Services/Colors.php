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

class Colors extends Config {

    /**
     * storeCategory method
     * stores the category record to the database
     * @param type $request
     * @return type
     */
    public function storeColor($request) {
        $request_params = $request->all();
        $request_params['slug'] = $this->prepareSlug($request_params['en_title']);

        return $this->storeColorProcess($request_params);
    }

    /**
     * storeCategoryProcess method
     * process the storeCategory functionality for further
     * @param type $request_params
     * @return type
     */


    public function addImage($request) {
        $upload = $this->uploadSingleImage($request->file('image'), $this->s3_image_paths['color_images'], 'color_');
        if ($upload['success']) {
            $file_name = explode('.', $upload['file_name']);
            $response['file_name'] = $upload['file_name'];
            $response['div_id'] = $file_name[0];
            return $this->jsonSuccessResponse('Image has been uploaded successfully.', $response);
        } else {
            return $this->jsonErrorResponse('Sorry! Something went wrong while uploading. Please try again.');
        }
    }

    public function storeColorProcess($request_params) {
        $store = $this->getColorModel()->create($request_params);
        if ($store) {
            return redirect()->route('getColors')->with('success_message', 'Color data is saved successfully');
        } else {
            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }


    /**
     * getCategoriesList method 
     * get all the categories 
     * @return view
     */
    public function getColorsList() {

        $request_params = \Illuminate\Support\Facades\Input::all();

        $searchText = !empty($request_params['search']) ? base64_decode($request_params['search']) : '';

//        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $colors = $this->getColorModel()->getColors($searchText);

        return view('pages.colors.all', compact('colors', 'searchText'));
    }

    /**
     * Deleted categories
     * @return type
     */
    public function getDeletedColors() {

        $request_params = Input::all();
        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $colors = $this->getColorModel()->getColorsArhived($searchText);
        return view('pages.colors.deleted', compact('colors', 'searchText'));
    }



    /**
     * editCategory method 
     * takes id or category resource 
     * @param type $uid
     * @return type
     */
    public function editColorOnly($uid) {

        $color = $this->getColorModel()->where('uuid', $uid)->first();

        return view('pages.colors.edit', compact('color'));
    }



    /**
     * updateCategory method
     * update the category in the database
     * @param type $request
     * @return type
     */
    public function updateColor($request) {

        $request_params = $request->except('_token');

        $color = $this->getColorModel()->where('id', $request_params['id'])->first();

        if (empty($color)) {

            return redirect()->back()->with('error_message', 'No record found.');
        }

        return $this->updateColorProcess($request_params, $color);
    }

    /**
     * updateSubCategoryProcess method 
     * updates sub category in the database
     * @param type $request_params
     * @return type
     */
    public function updateColorProcess($request_params, $color) {

        return $this->updateColorProcessFinal($request_params, $color);
    }

    /**
     * updateCategoryProcessFinal method 
     * updates a category in the database
     * @param type $request_params
     * @param type $category
     * @return type
     */
    public function updateColorProcessFinal($request_params, $color) {

        $color->en_title = !empty($request_params['en_title']) ? $request_params['en_title'] : $color->en_title;
        $color->ar_title = !empty($request_params['ar_title']) ? $request_params['ar_title'] : $color->ar_title;
        $color->color_code = !empty($request_params['color_code']) ? $request_params['color_code'] : $color->color_code;
        $color->slug = $this->prepareSlug($color->en_title);

        if ($color->save()) {

            return redirect()->route('getColors')->with('success_message', 'Color data is updated successfully');
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

        $check_employee_status = $this->getColorModel()->getItemsColor($uid);
//        dd($check_employee_status);
        if ($check_employee_status !== NULL) {
            return redirect()->back()->with('error_message', 'You can not remove this color right now because the items assigned to this color.');
        }

        $update = $this->getColorModel()->where('uuid', $uid)->update(['archive' => $archive]);
        if ($update) {
            return redirect()->back()->with('success_message', 'Color updated saved successfully');
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
        $update = $this->getColorModel()->where('uuid', $uid)->update(['status' => $archive]);
        if ($update) {
            return redirect()->back()->with('success_message', 'Color updated saved successfully');
        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }


}
