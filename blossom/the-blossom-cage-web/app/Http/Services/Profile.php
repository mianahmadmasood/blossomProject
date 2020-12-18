<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Profile
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class Profile extends Config {

    /**
     * Render view for change password
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword() {
        return view('pages.changePassword');
    }

    /**
     * Render view for change password
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword() {

        $request_params = Input::except('_token');
        $request_data = [
            'form_params' => $request_params,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => \Auth::user()->user_token
            ]
        ];
        $response = $this->guzzleRequest('users/password/change', 'PUT', $request_data);
        if ($response['success'] == false) {

            return redirect()->back()->with('error_message', $response['message']);
        }
        return redirect()->back()->with('success_message', $response['message']);
    }

    /**
     * Render view for change password
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('pages.profile');
    }

    /**
     * Render view for change password
     *
     * @return \Illuminate\Http\Response
     */
    public function update() {

        $request_params = Input::except('_token');
        $request_params = $this->prepareProfileParams($request_params);
        if (isset($request_params['image'])) {
            return $this->processMultiPartRequest($request_params);
        }
        $request_data = [
            'form_params' => $request_params,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => \Auth::user()->user_token
            ]
        ];
        $response = $this->guzzleRequest('users/profile/update', 'POST', $request_data);
        if ($response['success'] == false) {
            return redirect()->back()->with('error_message', $response['message']);
        }

        return redirect()->back()->with('success_message', $response['message']);
    }

    protected function prepareProfileParams($request_params)
    {


          if (!empty($request_params['address']['country'])) {
            $countryArray = explode('-', $request_params['address']['country']);
            if (session()->get('locale') == 'ar') {
                $request_params['address']['country'] = $countryArray[2];
            } else {
                $request_params['address']['country'] = $countryArray[1];
            }
              $request_params['address']['country_id'] = $countryArray[0];
        }
        if (!empty($request_params['address']['city'])) {
            $cityArray = explode('-', $request_params['address']['city']);
            if (session()->get('locale') == 'ar') {
                $request_params['address']['city'] = $cityArray[2];
            } else {
                $request_params['address']['city'] = $cityArray[1];
            }
            $request_params['address']['city_id'] = $cityArray[0];
        }
        return $request_params;
    }

    /**
     *
     * @param type $request_params
     * @return redirect
     */
    public function processMultiPartRequest($request_params) {

        $request_parameters = $this->preparesMultipartFormParams($request_params);

        $request_data = [
            'multipart' => $request_parameters,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => \Auth::user()->user_token
            ]
        ];
        $response = $this->guzzleRequest('users/profile/update', 'POST', $request_data);
        if ($response['success'] == false) {
            return redirect()->back()->with('error_message', $response['message']);
        }

        return redirect()->back()->with('success_message', $response['message']);
    }

    /**
     * preparesMultipartFormParams method
     * @param type $request_params
     * @return type
     */
    public function preparesMultipartFormParams($request_params) {

        $image = $request_params['image'];
        unset($request_params['image']);
        $positions = array_flip(array_keys($request_params));

        foreach ($request_params as $key => $value) {
            $data[$positions[$key]]['name'] = $key;
            $data[$positions[$key]]['contents'] = $value;
        }
        $params = $this->prepareImageAndHeaderData($data, $image);

        return $params;
    }

    /**
     * prepareImageAndHeaderData method
     * @param type $request_params
     * @return type
     */
    public function prepareImageAndHeaderData($data, $image) {

        $element['name'] = 'image';
        $element['contents'] = fopen($image->getPathname(), 'r');
        $element['filename'] = 'screenshot.png';

        array_push($data, $element);
        return $data;
    }

    /**
     * address method
     * render view to update address
     * @return type
     */
    public function address() {

        $request_data = [
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => \Auth::user()->user_token
            ]
        ];

        $response = $this->guzzleRequest('users/profile/', 'GET', $request_data);
        $address_country_city = $this->getDataCOuntryCity();
        $address_data = $address_country_city['data'];
        if ($response['success'] == true && !empty($response['data']['profile'])) {
            $profile = $response['data']['profile'];
            return View('pages.profileAddress', compact('profile','address_data'));
        }
        return View('pages.profileAddress',compact('address_data'));
    }

    public function getDataCOuntryCity() {

        $request_data = ['headers' => [
            'apikey' => config('config.apikey'),
            'lang' => Session::get('locale')
        ]
        ];

        return $this->guzzleRequest('users/getCountryAndCityInformation', 'GET', $request_data);

    }

    /**
     * address method
     * render view to update address
     * @return type
     */
    public function forgotPassword() {

        $request_params = Input::except('_token');
        $request_data = [
            'form_params' => $request_params,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
            ]
        ];
        $response = $this->guzzleRequest('password/forgot', 'POST', $request_data);
        if ($response['success'] == true) {
            return $this->jsonSuccessResponseWithoutData($response['message']);
        } elseif ($response['success'] == false) {
            return $this->jsonErrorResponse($response['message']);
        }
    }

    /**
     *
     * @return type
     */
    public function resetPassword() {
        return view('pages.updatePassword');
    }

    /**
     *
     * @return type
     */
    public function updatResetPassword() {

        $request_params = Input::except('_token');
        $request_data = [
            'form_params' => $request_params,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
            ]
        ];
        $response = $this->guzzleRequest('password/reset', 'POST', $request_data);
        if ($response['success'] == true) {
            return redirect()->back()->with('success_message', $response['message']);
        } elseif ($response['success'] == false) {
            return redirect()->back()->with('error_message', $response['message']);
        }
    }

}
