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
use Illuminate\Support\Facades\Validator;
use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;

class Categories extends Config {

    /**
     * storeCategory method
     * stores the category record to the database
     * @param type $request
     * @return type
     */
    public function storeCategory($request) {

        $request_params = $request->all();

        $request_params['slug'] = $this->prepareSlug($request_params['en_title']);

        return $this->storeCategoryProcess($request_params);
    }

    /**
     * storeCategoryProcess method
     * process the storeCategory functionality for further
     * @param type $request_params
     * @return type
     */
    public function storeCategoryProcess($request_params) {

        $store = $this->getCategoryModel()->create($request_params);

        if ($store) {

            if (isset($request_params['parent_id']) && !empty($request_params['parent_id'])) {

                return redirect()->route('getSubCategories')->with('success_message', 'Sub Category data is saved successfully');
            } else {
                return redirect()->route('getCategories')->with('success_message', 'Category data is saved successfully');
            }
        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }

    /**
     * createSubCategory method 
     * return view to add a sub category 
     * @return view
     */
    public function createSubCategory() {

        $categories = $this->getCategoryModel()->getParentCategoriesWP();

        return view('pages.sub-categories.add', compact('categories'));
    }

    /**
     * getCategoriesList method 
     * get all the categories 
     * @return view
     */
    public function getCategoriesList() {

        $request_params = \Illuminate\Support\Facades\Input::all();
        $searchText = !empty($request_params['search']) ? base64_decode($request_params['search']) : '';

//        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $categories = $this->getCategoryModel()->getParentCategories($searchText);

        return view('pages.categories.all', compact('categories', 'searchText'));
    }

    /**
     * getCategoriesList method 
     * get all the sub-categories 
     * @return view
     */
    public function getSubCategoriesList() {

        $request_params = \Illuminate\Support\Facades\Input::all();
        $searchText = !empty($request_params['search']) ? base64_decode($request_params['search']) : '';

//        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $categories = $this->getCategoryModel()->getSubCategories($searchText);

        return view('pages.sub-categories.all', compact('categories', 'searchText'));
    }

    /**
     * editCategory method 
     * takes id or category resource 
     * @param type $uid
     * @return type
     */
    public function editCategory($uid) {

        $category = $this->getCategoryModel()->where('uuid', $uid)->first();

        return view('pages.categories.edit', compact('category'));
    }

    /**
     * updateCategory method
     * update the category in the database
     * @param type $request
     * @return type
     */
    public function updateCategory($request) {

        $request_params = $request->except('_token');

        $category = $this->getCategoryModel()->where('id', $request_params['id'])->first();

        if (empty($category)) {

            return redirect()->back()->with('error_message', 'No record found.');
        }

        return $this->updateSubCategoryProcess($request_params, $category);
    }

    /**
     * updateSubCategoryProcess method 
     * updates sub category in the database
     * @param type $request_params
     * @return type
     */
    public function updateSubCategoryProcess($request_params, $category) {

        return $this->updateCategoryProcessFinal($request_params, $category);
    }

    /**
     * updateCategoryProcessFinal method 
     * updates a category in the database
     * @param type $request_params
     * @param type $category
     * @return type
     */
    public function updateCategoryProcessFinal($request_params, $category) {

        if(!empty($request_params['image'])){
            $category->image = $request_params['image'];
        }
        if(!empty($request_params['icon_image'])){
            $category->icon_image = $request_params['icon_image'];
        }
        $category->en_title = !empty($request_params['en_title']) ? $request_params['en_title'] : $category->en_title;
        $category->ar_title = !empty($request_params['ar_title']) ? $request_params['ar_title'] : $category->ar_title;
//        $category->parent_id = !empty($request_params['parent_id']) ? $request_params['parent_id'] : $category->parent_id;
        $category->slug = $this->prepareSlug($category->en_title);

        if ($category->save()) {
            if ($category->parent_id) {
                return redirect()->route('getSubCategories')->with('success_message', 'Sub Category data updated saved successfully');
            }
            return redirect()->route('getCategories')->with('success_message', 'Category data is updated successfully');
        } else {
            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }

    /**
     * editSubCategory method 
     * get resource from database 
     * get it ready to update
     * @param type $uid
     * @return view
     */
    public function editSubCategory($uid) {

        $category = $this->getCategoryModel()->where('uuid', $uid)->with('parent_category')->first();
        $categories = $this->getCategoryModel()->getParentCategoriesItemcount();

        return view('pages.sub-categories.edit', compact('category', 'categories'));
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
        $check_categoires_status = $this->getCategoryModel()->getCategoriesItem($uid);
        if ($check_categoires_status['items'] !== NULL) {
            return redirect()->back()->with('error_message', 'You can not remove this category right now because the items assigned to this category.');
        }

        $update = $this->getCategoryModel()->where('uuid', $uid)->update(['archive' => $archive]);
        if ($update) {
            return redirect()->back()->with('success_message', 'Category updated saved successfully');
        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }
    public function stateSubCategories($uid, $state) {

        if ($state == 'in-active') {
            $archive = 1;
        } else {
            $archive = 0;
        }
        $check_categoires_status = $this->getCategoryModel()->getSubCategoriesItem($uid);
        if ($check_categoires_status['itemsForSubCatgories'] !== NULL) {
            return redirect()->back()->with('error_message', 'You can not remove this category right now because the items assigned to this category.');
        }

        $update = $this->getCategoryModel()->where('uuid', $uid)->update(['archive' => $archive]);
        if ($update) {
            return redirect()->back()->with('success_message', 'Category updated saved successfully');
        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }

    /**
     * ajaxCall method 
     * fetch data on ajax call for sub-categories
     * @param type $id
     * @return type
     */
    public function ajaxCall($id) {

        $str = '<option value=""> Select a Sub category.</option>';
        $categories = $this->getCategoryModel()
                        ->whereHas('parent_category', function ($sql) {
                            $sql->where('archive', 0);
                        })
                        ->where('parent_id', $id)
                        ->where('archive', 0)->get();
        foreach ($categories as $cat) {
            $str = $str . "<option value='$cat->id' data-type='subCat'>$cat->en_title - $cat->ar_title</option>";
        }
        return $this->jsonSuccessResponse('Categories found', $str);
    }

    /**
     * Deleted categories
     * @return type
     */
    public function getDeletedCategories() {

        $request_params = Input::all();
        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $categories = $this->getCategoryModel()->getParentCategoriesArhived($searchText);
        return view('pages.categories.deleted', compact('categories', 'searchText'));
    }
    /**
     * Deleted categories
     * @return type
     */
    public function getDeletedSubCategories() {

        $request_params = Input::all();
        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $categories = $this->getCategoryModel()->getSubCategoriesArhived($searchText);
        return view('pages.sub-categories.deleted', compact('categories', 'searchText'));
    }

    /**
     * storeCategoryProcess method
     * process the storeCategory functionality for further
     * @param type $request_params
     * @return type
     */


    public function addImage($request) {
        $upload = $this->uploadSingleImage($request->file('image'), $this->s3_image_paths['category_images'], 'Category_');
        if ($upload['success']) {
            $file_name = explode('.', $upload['file_name']);
            $response['file_name'] = $upload['file_name'];
            $response['div_id'] = $file_name[0];
            return $this->jsonSuccessResponse('Image has been uploaded successfully.', $response);
        } else {
            return $this->jsonErrorResponse('Sorry! Something went wrong while uploading. Please try again.');
        }
    }
    /**
     * storeCategoryProcess method
     * process the storeCategory functionality for further
     * @param type $request_params
     * @return type
     */


    public function addImageIcon($request) {
        $upload = $this->uploadSingleImage($request->file('image'), $this->s3_image_paths['category_images'], 'Category_');
        if ($upload['success']) {
            $file_name = explode('.', $upload['file_name']);
            $response['file_name'] = $upload['file_name'];
            $response['div_id'] = $file_name[0];
            return $this->jsonSuccessResponse('Image has been uploaded successfully.', $response);
        } else {
            return $this->jsonErrorResponse('Sorry! Something went wrong while uploading. Please try again.');
        }
    }

    /**
     * storeCategoryProcess method
     * process the storeCategory functionality for further
     * @param type $request_params
     * @return type
     */


    public function addSubCatImage($request) {
        $upload = $this->uploadSingleImage($request->file('image'), $this->s3_image_paths['category_images'], 'Category_');
        if ($upload['success']) {
            $file_name = explode('.', $upload['file_name']);
            $response['file_name'] = $upload['file_name'];
            $response['div_id'] = $file_name[0];
            return $this->jsonSuccessResponse('Image has been uploaded successfully.', $response);
        } else {
            return $this->jsonErrorResponse('Sorry! Something went wrong while uploading. Please try again.');
        }
    }


}
