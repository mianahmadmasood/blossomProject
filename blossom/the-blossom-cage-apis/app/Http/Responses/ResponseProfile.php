<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

/**
 * Description of ResponseProfile
 *
 * @author qadeer
 */
use App\Http\Responses\BaseResponse;
use Illuminate\Database\Eloquent\Model;

class ResponseProfile extends BaseResponse {

    protected $user;
    protected $lang;

    function __construct(Model $user, string $lang) {

        $this->user = $user;
        $this->lang = $lang;
    }

    /**
     * preapreResponse method
     * preparing response for the user and profile
     * @return array
     */
    public function prepareResponse() {

        $resposnse = [];
        $resposnse['uuid'] = $this->user->uuid;
        $resposnse['first_name'] = $this->user->first_name;
        $resposnse['last_name'] = $this->user->last_name;
        $resposnse['email'] = $this->user->email;
        $resposnse['user_token'] = $this->user->user_token;
        $resposnse['gender'] = $this->user->gender;
        $resposnse['phone_no'] = !empty($this->user->phone_no) ? $this->user->phone_no : null;
        $resposnse['image'] = $this->user->image;
        if (!empty($this->user->profile)) {
            $resposnse['profile'] = $this->profileResponse($this->user->profile);
        }
        return $resposnse;
    }

    /**
     * profileResponse method
     * preparing response for the user and profile
     * @param type $profile
     * @return array
     */
    public function profileResponse($profile) {

        $response_profile = [];
        $response_profile['full_address'] = $profile->full_address;
        $response_profile['zip_code'] = $profile->zip_code;
        $response_profile['city'] = $profile->city;
        $response_profile['city_id'] = $profile->city_id;
        $response_profile['state'] = $profile->state;
        $response_profile['country'] = $profile->country;
        $response_profile['country_id'] = $profile->country_id;

        return $response_profile;
    }

}
