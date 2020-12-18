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
use Session;
use Auth;

class Favorite extends Config {

    protected $headers;

    function __construct() {
        $this->headers = [
            'apikey' => config('config.apikey'),
            'lang' => Session::get('locale')
        ];
    }

    /**
     * Store resource to database
     *
     * @return \Illuminate\Http\JSON\Response
     */
    public function store() {

        $request_params = Input::except('_token');

        $request_data = [
            'form_params' => $request_params,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => Auth::user()->user_token
            ]
        ];

        $response = $this->guzzleRequest('favorites/store', 'POST', $request_data);

        if ($response['success'] == true) {
            return $this->processStore($request_params, $response);
        }
        return $this->jsonErrorResponse($response['message']);
    }

    /**
     * processStore method 
     * process further store process
     * @param type $request_params
     * @param type $response
     * @return type
     */
    protected function processStore($request_params, $response) {

        if (Session::has('favItems')) {
            $fav_items = Session::get('favItems');
            array_push($fav_items, $request_params['item_id']);
            Session::put('favItems', $fav_items);
        } else {
            $fav_items[] = $request_params['item_id'];
            Session::put('favItems', $fav_items);
        }
        return $this->jsonSuccessResponseWithoutData($response['message'], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\\Json\Response
     */
    public function index() {

        $request_data = ['headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => Auth::user()->user_token
            ]
        ];
        $response = $this->guzzleRequest('favorites/index', 'GET', $request_data);
        if ($response['success'] == true) {
            return View('pages.wishlist', compact('response'));
        }
        return redirect()->back()->with('error_message', $response['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy() {

        $request_params = Input::except('_token');
        $request_data = ['headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => Auth::user()->user_token
            ]
        ];

        $response = $this->guzzleRequest('favorites/delete/' . $request_params['id'], 'DELETE', $request_data);
        if ($response['success'] == true) {
            return $this->jsonSuccessResponse($response['message'], $response['data'], 200);
        }
        return $this->jsonErrorResponse($response['message'], 400);
    }

}
