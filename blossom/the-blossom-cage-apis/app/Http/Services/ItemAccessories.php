<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of ItemImage
 *
 * @author qadeer
 */
use Illuminate\Support\Facades\Validator;
use App\Http\Services\Config;

class ItemAccessories extends Config {

    /**
     * add Accessorie
     * @return type
     */
    public function addAccessorie($request) {

        $upload = $this->uploadSingleAccessorie($request->file('accessorie'), $this->s3_accessorie_paths['item_accessories'], 'item_');
        if ($upload['success']) {
            $file_name = explode('.', $upload['file_name']);
            $response['file_name'] = $upload['file_name'];
            $response['div_id'] = $file_name[0];
            return $this->jsonSuccessResponse('Accessorie has been uploaded successfully.', $response);
        } else {
            return $this->jsonErrorResponse('Sorry! Something went wrong while uploading. Please try again.');
        }
    }

    /**
     * status method 
     * change accessorie status
     * @param type $uid
     * @param type $status
     * @return redirect
     */
    public function status($uid, $status) {

        $accessorie = $this->getItemAccessorieModel()->where('uuid', $uid)->first();
        if (empty($accessorie)) {
            return redirect()->back()->with('error_message', 'resources not found');
        }
        if ($status == 'active') {
            $accessorie->archive = 0;
        } elseif ($status == 'block') {
            $accessorie->archive = 1;
        } elseif ($status == 'default') {
            $this->getItemAccessorieModel()->where('item_id', $accessorie->item->id)->update(['is_default' => 0]);
            $accessorie->is_default = 1;
        }
        if ($accessorie->save()) {
            return redirect()->back()->with('success_message', 'Accessorie status has been changed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uid
     * @return \Illuminate\Http\Response
     */
    public function edit($uid) {

        $accessorie = $this->getItemAccessorieModel()->where('uuid', $uid)->first();

        if ($accessorie) {
            return View('pages.items.accessorie', compact('accessorie'));
        }

        return redirect()->back()->with('error_message', 'No record found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request) {

        $request_params = $request->except('_token');

        $validate = Validator::make($request_params, $this->update_item_accessorie_rules);
        if ($validate->fails()) {
            return redirect()->back()->withInput($request_params)->with('error_message', $validate->errors()->first());
        }

        $accessorie = $this->getItemAccessorieModel()->where('uuid', $request_params['uuid'])->first();
        if (!$accessorie) {
            return redirect()->back()->with('error_message', 'No record found');
        }

        $upload = $this->uploadSingleAccessorie($request_params['accessorie'], $this->s3_accessorie_paths['item_accessories'], 'item_');
        if ($upload['success']) {
            $accessorie->accessorie = $upload['file_name'];
            if ($accessorie->save()) {
                return redirect()->route('showItem', ['uid' => $request_params['item_uuid']])->with('success_message', 'Product accessorie has been uploaded successfully.');
            }
        }

        return redirect()->back()->with('error_message', 'Sorry! Something went wrong');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uid) {

        return view('pages.items.addAccessorie', compact('uid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request) {

        $request_params = $request->except('_token');
        $item = $this->getItemModel()->getItemByColumnValue('uuid', $request_params['item_uuid']);
        if (empty($item)) {
            return redirect()->back()->with('error_message', 'Sorry! No record found');
        }

        $itemAccessoires = $this->getItemAccessorieModel()->where('item_id', $item->id)->where('accessories_id', $request_params['accessories_id'])->first();
        if(empty($itemAccessoires)) {
            $accessories['item_id'] = !empty($item->id) ? $item->id : "";
            $accessories['accessories_id'] = !empty($request_params['accessories_id']) ? $request_params['accessories_id'] : "";
            $accessories['accessories_status'] = !empty($request_params['accessories_status']) ? 1 : 0;
            $accessories['accessories_quantity'] = 1;
            $create_accessorie = $this->getItemAccessorieModel()->create($accessories);
        }else{
            $accessories['accessories_status'] = !empty($request_params['accessories_status']) ? 1 : 0;
            $accessories['archive'] = 0;
            $update_accessorie = $this->getItemAccessorieModel()->where('id', $itemAccessoires->id)->update($accessories);
        }
             return redirect()->route('showItem', ['uid' => $request_params['item_uuid']])->with('success_message', 'Product accessories has been uploaded successfully.');


//        return redirect()->back()->with('error_message', 'Sorry! Something went wrong');
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
        $update = $this->getItemAccessorieModel()->where('uuid', $uid)->update(['archive' => $archive]);
        if ($update) {
            return redirect()->back()->with('success_message', 'accessories has been deleted successfully');
        } else {

            return redirect()->back()->with('error_message', 'Internal server error occured');
        }
    }


}
