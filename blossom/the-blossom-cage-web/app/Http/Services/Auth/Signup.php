<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services\Auth;

/**
 * Description of Signup
 *
 * @author qadeer
 */
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Auth\Signin;
use App\Http\Services\Config;
use Session;

class Signup extends Config {

    protected $headers;
    protected $lang;

    function __construct() {
        $this->headers = [
            'apikey' => config('config.apikey'),
            'lang' => Session::get('locale')
        ];
        $this->lang = Session::get('locale');
    }

    public function getSinginService() {
        return new Signin();
    }

    /**
     * signupUser method sign up a user
     * @return type
     */
    public function signupUser() {

        $request_params = Input::except('_token');
        $request_data = [
            'form_params' => $request_params,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
            ]
        ];

        $signup_response = $this->guzzleRequest('users/signup', 'POST', $request_data);

        if ($signup_response['success'] == true) {
            return $this->processSinginProcess($request_params);
        } else {
            return $this->jsonErrorResponse($signup_response['message']);
        }
    }

    /**
     * do login after successful signup
     * @param type $request_params
     * @return type
     */
    public function processSinginProcess($request_params) {

        $credentials = ['email' => $request_params['email'], 'password' => $request_params['password'], 'role_id' => 2];
        if (!Auth::attempt($credentials)) {
            return $this->jsonErrorResponse($this->getMessageData($type = 'error', $this->lang)['invalid_login']);
        }
        return $this->jsonSuccessResponseWithoutData($this->getMessageData('success', $this->lang)['login_success']);
    }

}
