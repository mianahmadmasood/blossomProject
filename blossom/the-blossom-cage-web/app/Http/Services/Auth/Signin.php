<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author qadeer
 */

namespace App\Http\Services\Auth;

use App\Http\Services\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Session;

class Signin extends Config {

    protected $lang;

    function __construct() {
        return $this->lang = Session::get('locale');
    }

    /**
     * signin method is used to get user signin
     * @return type
     */
    public function signin() {

        $request_params = Input::except('_token');

        $validation = Validator::make($request_params, $this->login_rules, $this->selectRulesLang($rules = 'login_rules', $this->lang));
        if ($validation->fails()) {
            return $this->jsonErrorResponse($validation->errors()->first());
        }

        $credentials = ['email' => $request_params['email'], 'password' => $request_params['password'], 'role_id' => 2];
        if (!Auth::attempt($credentials)) {
            return $this->jsonErrorResponse($this->getMessageData($type = 'error', $this->lang)['invalid_login']);
        }

        return $this->processSigninProcess($request_params);
    }

    /**
     * 
     * @param type $request_params
     * @return type
     */
    public function processSigninProcess($request_params) {

        $user_device = $this->getUserDeviceModel()->getByColumnValue('user_id', Auth::user()->id);
        if ($user_device) {
            $user_device->device_token = $request_params['device_token'];
            $user_device->device_type = $request_params['device_type'];
            $update_device = $user_device->save();
        } else {
            $update_device = $this->getUserDeviceModel()->create(
                    [
                        'user_id' => Auth::user()->id,
                        'device_type' => $request_params['device_type'],
                        'device_token' => $request_params['device_token']
                    ]
            );
        }
        if ($update_device) {
            return $this->processFavoriteItem();
        }
        return $this->jsonSuccessResponseWithoutData($this->getMessageData('success', $this->lang)['general_error']);
    }

    /**
     * processFavoriteItem method
     * @return type
     */
    protected function processFavoriteItem() {

        $request_data = ['headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => Auth::user()->user_token
            ]
        ];

        $response = $this->guzzleRequest('favorites/index', 'GET', $request_data);

        if ($response['success'] && !empty($response['data'])) {

            foreach ($response['data'] as $item) {

                $items[] = $item['item_id'];
            }
            \Session::put('favItems', $items);
        }
        return $this->jsonSuccessResponseWithoutData($this->getMessageData('success', $this->lang)['login_success']);
    }

}
