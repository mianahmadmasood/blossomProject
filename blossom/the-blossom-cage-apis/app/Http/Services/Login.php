<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Login
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Http\Responses\ResponseUser;
use Hash;
use DB;

class Login extends Config {

    /**
     * Injecting related response class
     * @return ResponseItem
     */
    public function jsonResponse($user, $lang) {
        return new ResponseUser($user, $lang);
    }

    /**
     * dologin method is using for doin login
     * @return type
     */
    public function dologin() {

        $request_params = Input::all();

        $validation = Validator::make($request_params, $this->login_rules, $this->selectRulesLang($rules = 'login_rules', $request_params['lang']));
        if ($validation->fails()) {

            return $this->jsonErrorResponse($validation->errors()->first());
        }

        $credentials = ['email' => $request_params['email'], 'password' => $request_params['password'], 'role_id' => 2];
        if (!Auth::attempt($credentials)) {

            return $this->jsonErrorResponse($this->getMessageData($type = 'error', $request_params['lang'])['invalid_login']);
        }
        return $this->processLoginProcess($request_params);
    }

    /**
     * processLoginProcess method
     * @param type $request_params
     * @return type
     */
    protected function processLoginProcess($request_params) {

        $user_details = $this->getUserModel()->getUserByColumnValue('email', Auth::user()->email);
        if ($user_details->archive == 1) {
            return $this->jsonErrorResponse($this->getMessageData($type = 'error', $request_params['lang'])['accoount_blocked']);
        }

        DB::beginTransaction();
        return $this->processUpdateDevice($request_params, $user_details);
    }

    /**
     * processUpdateDevice method
     * @param type $request_params
     * @return type
     */
    public function processUpdateDevice($request_params, $user) {

        if (!empty($user->device)) {
            $user->device->device_type = !empty($request_params['device_type']) ? $request_params['device_type'] : 'web';
            $user->device->device_token = !empty($request_params['device_token']) ? $request_params['device_token'] : NULL;
            $update_deive = $user->device->save();
        } else {
            $device['user_id'] = $user->id;
            $device['device_type'] = !empty($request_params['device_type']) ? $request_params['device_type'] : 'web';
            $device['device_token'] = !empty($request_params['device_token']) ? $request_params['device_token'] : NULL;
            $update_deive = $this->getUserDeviceModel()->create($device);
        }
        if ($update_deive) {
            DB::commit();
            $response = $this->jsonResponse($user, $request_params['lang'])->perpareResponse();
            return $this->jsonSuccessResponse($this->getMessageData('success', $request_params['lang'])['login_success'], $response);
        }

        DB::rollBack();
        return $this->jsonErrorResponse($this->getMessageData($type = 'error', $request_params['lang'])['general_error']);
    }

}
