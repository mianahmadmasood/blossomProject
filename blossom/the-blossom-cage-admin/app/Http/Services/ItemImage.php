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

class ItemImage extends Config {

    /**
     * add Image
     * @return type
     */
    public function addImage($request) {

        $upload = $this->uploadSingleImage($request->file('image'), $this->s3_image_paths['item_images'], 'item_');
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
     * status method 
     * change image status
     * @param type $uid
     * @param type $status
     * @return redirect
     */
    public function status($uid, $status) {

        $image = $this->getItemImageModel()->where('uuid', $uid)->first();
        if (empty($image)) {
            return redirect()->back()->with('error_message', 'resources not found');
        }
        if ($status == 'active') {
            $image->archive = 0;
        } elseif ($status == 'block') {
            $image->archive = 1;
        } elseif ($status == 'default') {
            $this->getItemImageModel()->where('item_id', $image->item->id)->update(['is_default' => 0]);
            $image->is_default = 1;
        }
        if ($image->save()) {
            return redirect()->back()->with('success_message', 'Image status has been changed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uid
     * @return \Illuminate\Http\Response
     */
    public function edit($uid) {

        $image = $this->getItemImageModel()->where('uuid', $uid)->first();

        if ($image) {
            return View('pages.items.image', compact('image'));
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

        $validate = Validator::make($request_params, $this->update_item_image_rules);
        if ($validate->fails()) {
            return redirect()->back()->withInput($request_params)->with('error_message', $validate->errors()->first());
        }

        $image = $this->getItemImageModel()->where('uuid', $request_params['uuid'])->first();
        if (!$image) {
            return redirect()->back()->with('error_message', 'No record found');
        }

        $upload = $this->uploadSingleImage($request_params['image'], $this->s3_image_paths['item_images'], 'item_');
        if ($upload['success']) {
            $image->image = $upload['file_name'];
            if ($image->save()) {
                return redirect()->route('showItem', ['uid' => $request_params['item_uuid']])->with('success_message', 'Product image has been uploaded successfully.');
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

        return view('pages.items.addImage', compact('uid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request) {

        $request_params = $request->except('_token');

        $validate = Validator::make($request_params, $this->update_item_image_rules);
        if ($validate->fails()) {
            return redirect()->back()->withInput($request_params)->with('error_message', $validate->errors()->first());
        }
        $item = $this->getItemModel()->getItemByColumnValue('uuid', $request_params['item_uuid']);
        if (empty($item)) {
            return redirect()->back()->with('error_message', 'Sorry! No record found');
        }

        $create_image = $this->getItemImageModel()->create(['image' => $request_params['image'], 'item_id' => $item['id']]);
        if ($create_image) {
            return redirect()->route('showItem', ['uid' => $request_params['item_uuid']])->with('success_message', 'Product image has been uploaded successfully.');
        }

        return redirect()->back()->with('error_message', 'Sorry! Something went wrong');
    }

}
