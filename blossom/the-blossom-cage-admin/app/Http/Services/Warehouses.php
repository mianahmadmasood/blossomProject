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

class Warehouses extends Config {

    /**
     * storeCategory method
     * stores the category record to the database
     * @param type $request
     * @return type
     */
    public function storeWarehouse($request) {

        $request_params = $request->all();

        $request_params['slug'] = $this->prepareSlug($request_params['en_title']);

        return $this->storeWarehouseProcess($request_params);
    }

    /**
     * storeCategoryProcess method
     * process the storeCategory functionality for further
     * @param type $request_params
     * @return type
     */


    public function addImage($request) {
        $upload = $this->uploadSingleImage($request->file('image'), $this->s3_image_paths['warehouse_images'], 'warehouse_');
        if ($upload['success']) {
            $file_name = explode('.', $upload['file_name']);
            $response['file_name'] = $upload['file_name'];
            $response['div_id'] = $file_name[0];
            return $this->jsonSuccessResponse('Image has been uploaded successfully.', $response);
        } else {
            return $this->jsonErrorResponse('Sorry! Something went wrong while uploading. Please try again.');
        }
    }

    public function storeWarehouseProcess($request_params) {

        $store = $this->getWarehouseModel()->create($request_params);

        if ($store) {

            return redirect()->route('getWarehouses')->with('success_message', 'warehouse data is saved successfully');

        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }


    /**
     * getWarehousesList method
     * get all the warehouse
     * @return view
     */
    public function getWarehousesList() {

        $request_params = \Illuminate\Support\Facades\Input::all();
        $searchText = !empty($request_params['search']) ? base64_decode($request_params['search']) : '';

//        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $warehouses = $this->getWarehouseModel()->getWarehouses($searchText);

        return view('pages.warehouse.all', compact('warehouses', 'searchText'));
    }



    /**
     * editWarehouse method
     * takes id or warehouse resource
     * @param type $uid
     * @return type
     */
    public function editWarehouse($uid) {

        $warehouse = $this->getWarehouseModel()->where('uuid', $uid)->first();

        return view('pages.warehouse.edit', compact('warehouse'));
    }

    /**
     * updateWarehouse method
     * update the Warehouse in the database
     * @param type $request
     * @return type
     */
    public function updateWarehouse($request) {

        $request_params = $request->except('_token');

        $warehouse = $this->getWarehouseModel()->where('id', $request_params['id'])->first();

        if (empty($warehouse)) {

            return redirect()->back()->with('error_message', 'No record found.');
        }

        return $this->updateWarehouseProcess($request_params, $warehouse);
    }

    /**
     * updateWarehouseProcess method
     * updates sub warehouse in the database
     * @param type $request_params
     * @return type
     */
    public function updateWarehouseProcess($request_params, $warehouse) {

        return $this->updateWarehouseProcessFinal($request_params, $warehouse);
    }

    /**
     * updateWarehouseProcessFinal method
     * updates a warehouses in the database
     * @param type $request_params
     * @param type warehouses
     * @return type
     */
    public function updateWarehouseProcessFinal($request_params, $warehouse) {

        if(!empty($request_params['image'])){
            $warehouse->image =  $request_params['image'] ;
        }

        $warehouse->en_title = !empty($request_params['en_title']) ? $request_params['en_title'] : $warehouse->en_title;
        $warehouse->ar_title = !empty($request_params['ar_title']) ? $request_params['ar_title'] : $warehouse->ar_title;
        $warehouse->country = !empty($request_params['country']) ? $request_params['country'] : $warehouse->country;
        $warehouse->city = !empty($request_params['city']) ? $request_params['city'] : $warehouse->city;
        $warehouse->phone =  $request_params['phone'];
        $warehouse->address =  $request_params['address'];
        $warehouse->zip_code =  $request_params['zip_code'];
        $warehouse->state =  $request_params['state'];
        $warehouse->lng =  $request_params['lng'];
        $warehouse->lat =  $request_params['lat'];
        $warehouse->slug = $this->prepareSlug($warehouse->en_title);

        if ($warehouse->save()) {
            return redirect()->route('getWarehouses')->with('success_message', 'Warehouse data is updated successfully');
        } else {
            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }



    /**
     * state method 
     * change the status of the warehouse
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
        $update = $this->getWarehouseModel()->where('uuid', $uid)->update(['archive' => $archive]);
        if ($update) {
            return redirect()->back()->with('success_message', 'Warehouse updated saved successfully');
        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }

    /**
     * Deleted warehouses
     * @return type
     */
    public function getDeletedWarehouses() {

        $request_params = Input::all();
        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $warehouses = $this->getWarehouseModel()->getWarehousesArhived($searchText);
        return view('pages.warehouse.deleted', compact('warehouses', 'searchText'));
    }


}
