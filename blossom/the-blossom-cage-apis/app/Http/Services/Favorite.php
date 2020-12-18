<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Favorite
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\ResponseUserFavorites;

class Favorite extends Config {

    /**
     * Injecting related response class
     * @return ResponseUserFavorites
     */
    protected function prepareResponse($items, $lang) {
        return new ResponseUserFavorites($items, $lang);
    }

    /**
     * Store resource to database
     *
     * @return \Illuminate\Http\JSON\Response
     */
    public function store() {

        $request_params = Input::all();

        $validation = Validator::make($request_params, $this->make_favorite, $this->selectRulesLang($rules = 'make_favorite', $request_params['lang']));
        if ($validation->fails()) {
            return $this->jsonErrorResponse($validation->errors()->first());
        }

        $item = $this->getItemModel()->getItemByColumnValue('uuid', $request_params['item_id']);

        if (empty($item)) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
        }

        $check_favorite_item = $this->getUserFavoriteItemModel()->getFItemByUser($item->id, $request_params['user']->id);

        if ($check_favorite_item) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['already_n_wishlist']);
        }

        return $this->processStore($request_params, $item);
    }

    /**
     * processStore method
     * process further store process
     * @param type $request_params
     * @param type $item
     * @return type
     */
    protected function processStore($request_params, $item) {

        $data['item_id'] = $item->id;
        $data['user_id'] = $request_params['user']->id;

        $create_user = $this->getUserFavoriteItemModel()->create($data);

        if ($create_user) {
            return $this->jsonSuccessResponseWithoutData($this->getMessageData('success', $request_params['lang'])['item_favorited']);
        }

        return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['general_error']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\\Json\Response
     */
    public function index() {

        $request_params = Input::all();
        $f_items = $this->getUserFavoriteItemModel()->getUserFavoriteItemByColumnValue('user_id', $request_params['user']->id);
        if ($f_items->isNotEmpty()) {
            return $this->prepareResponse($f_items, $request_params['lang'])->prepareUserFavoritesResponse();
        }
        return $this->jsonSuccessResponseWithoutData($this->getMessageData('error', $request_params['lang'])['no_records_found']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $request_params = Input::all();
        $item = $this->getItemModel()->getItemByColumnValue('uuid', $id);
        if (empty($item)) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
        }
        $check_favorite_item = $this->getUserFavoriteItemModel()->getByColumnValue('item_id', $item->id, $request_params['user']->id);
        if (empty($check_favorite_item)) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
        }
        $delete_favorite = $this->getUserFavoriteItemModel()->where('item_id', $item->id)->where('user_id', $request_params['user']->id)->delete();
        if ($delete_favorite) {
            $data['count'] = $this->getUserFavoriteItemModel()->where('user_id', $request_params['user']->id)->count();
            return $this->jsonSuccessResponse($this->getMessageData('success', $request_params['lang'])['item_removed'], $data);
        }
        return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['general_error']);
    }

}
