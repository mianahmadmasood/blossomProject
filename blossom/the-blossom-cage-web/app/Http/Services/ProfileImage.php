<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of ProfileImage
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use Session;
use Auth;

class ProfileImage extends Config {

    /**
     * 
     * @param type $request
     */
    public function uploadProfileImage($request) {

        $request_data = [
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => Auth::user()->user_token
            ],
            'multipart' => [
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'image',
                    'contents' => fopen($request->file('image')->getPathname(), 'r')
                ]
            ]
        ];
        $response = $this->guzzleRequest('users/profile/update', 'POST', $request_data);
        if ($response['success'] == true) {
            return $this->jsonSuccessResponse($response['message'], $response['data']);
        }
        return $this->jsonErrorResponse($response['message']);
    }

}
