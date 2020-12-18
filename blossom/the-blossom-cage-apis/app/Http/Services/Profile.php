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
use Illuminate\Support\Facades\Input;
use App\Http\Responses\ResponseProfile;
use App\Http\Services\Config;
use Illuminate\Support\Facades\Validator;
use Hash;

class Profile extends Config {

    /**
     * Injecting related response class
     * @return ResponseItem
     */
    public function jsonResponse($user, $lang) {
        return new ResponseProfile($user, $lang);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $request_params = Input::all();

        $response = $this->jsonResponse($request_params['user'], $request_params['lang'])->prepareResponse();

        return $this->jsonSuccessResponse($this->getMessageData('success', $request_params['lang'])['general_success'], $response);
    }

    /**
     * update method update resource in database
     * @return function
     */
    public function update() {

        $request_params = Input::all();
        if (!empty($request_params['phone_no'])) {
            $phone_validation = $this->getPhoneValidator()->checkphoneNumberValidation($request_params['phone_no']);
            if ($phone_validation === false) {
                return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['phone_invalid']);
            }
            $detais = $this->getPhoneValidator()->getPhoneNumberDetails($request_params['phone_no']);
            if (!empty($detais)) {
                $request_params['phone_no'] = '+' . $detais['countryCode'] . $detais['nationNumber'];
            } else {
                return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['service_unavailable'], 503);
            }
        }
        if (isset($request_params['image']) && !empty($request_params['image'])) {
            $file_upload = $this->uploadSingleImage($request_params['image'], $this->s3_image_paths['profile_images'], 'Profile_');
            if ($file_upload['success'] == false) {
                return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['service_unavailable'], 503);
            }
            $request_params['image'] = $file_upload['file_name'];
        }
        return $this->processUpdate($request_params['user'], $request_params);
    }

    /**
     * processUpdate method
     * process the update process further
     * @param type $user
     * @param type $request_params
     */
    public function processUpdate($user, $request_params) {

        $user->first_name = !empty($request_params['first_name']) ? $request_params['first_name'] : $user->first_name;
        $user->last_name = !empty($request_params['last_name']) ? $request_params['last_name'] : $user->last_name;
        $user->phone_no = !empty($request_params['phone_no']) ? $request_params['phone_no'] : $user->phone_no;
        $user->image = !empty($request_params['image']) ? $request_params['image'] : $user->image;
        $user->email = !empty($request_params['email']) ? $request_params['email'] : $user->email;

        if ($user->save()) {
            return $this->updateProfile($user, $request_params);
        }
    }

    /**
     * updateProfile method
     * process the update process further
     * @param type $user
     * @param type $request_params
     */
    public function updateProfile($user, $request_params) {


        if (!empty($request_params['address'])) {

            $profile = $this->getUserProfileModel()->firstOrNew(['user_id' => $user->id]);

            $profile->full_address = !empty($request_params['address']['full_address']) ? $request_params['address']['full_address'] : $profile->full_address;
            $profile->zip_code = !empty($request_params['address']['zip_code']) ? $request_params['address']['zip_code'] : $profile->zip_code;
            $profile->city = !empty($request_params['address']['city']) ? $request_params['address']['city'] : $profile->city;
            $profile->city_id = !empty($request_params['address']['city_id']) ? $request_params['address']['city_id'] : '';
            $profile->state = !empty($request_params['address']['state']) ? $request_params['address']['state'] : '';
            $profile->country = !empty($request_params['address']['country']) ? $request_params['address']['country'] : $profile->country;
            $profile->country_id = !empty($request_params['address']['country_id']) ? $request_params['address']['country_id'] : '';
            $save_profile = $profile->save();
            if (!$save_profile) {
                return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['general_error'], 504);
            }
        }

        $response = $this->jsonResponse($user, $request_params['lang'])->prepareResponse();

        return $this->jsonSuccessResponse($this->getMessageData('success', $request_params['lang'])['profile_update'], $response);
    }

    /**
     * passwordUpdate method
     * update user password
     * @return function
     */
    public function passwordUpdate() {

        $request_params = Input::all();
        $validation = Validator::make($request_params, $this->update_password, $this->selectRulesLang($rules = 'update_password', $request_params['lang']));
        if ($validation->fails()) {
            return $this->jsonErrorResponse($validation->errors()->first());
        }
        if (!Hash::check($request_params['old_password'], $request_params['user']->password)) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['incorrect_old_password']);
        }
        if ($request_params['old_password'] === $request_params['new_password']) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['same_password']);
        }
        return $this->processUpdatePassword($request_params);
    }

    /**
     * processUpdatePassword method
     * process further change message update
     * @param type $request_params
     * @return type
     */
    public function processUpdatePassword($request_params) {

        $request_params['user']->password = Hash::make($request_params['new_password']);

        if ($request_params['user']->save()) {

            return $this->jsonSuccessResponseWithoutData($this->getMessageData('success', $request_params['lang'])['password_updated']);
        }
        return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['service_unavailable'], 503);
    }

    /**
     * update user settings are database
     * @return type
     */
    public function settings() {

        $request_params = Input::all();
        $settings = $this->getSettingModel()->getByColValue('user_id', $request_params['user']->id);
        if (!empty($settings)) {
            $update = $this->getSettingModel()->where('user_id', $request_params['user']->id)->update(['push_notification' => $request_params['push_notification']]);
            if ($update) {
                return $this->jsonSuccessResponseWithoutData($this->getMessageData('success', $request_params['lang'])['setting_update']);
            } else {
                return $this->jsonErrorResponse($this->getMessageData('error_message', $request_params['lang'])['general_error']);
            }
        } else {
            $settings_data['user_id'] = $request_params['user']->id;
            $settings_data['push_notification'] = $request_params['push_notification'];
            $settings_data['email_notification'] = 1;
            $settings_data['text_notification'] = 1;
            $create_settings = $this->getSettingModel()->create($settings_data);
            if ($create_settings) {
                return $this->jsonSuccessResponseWithoutData($this->getMessageData('success', $request_params['lang'])['setting_update']);
            } else {
                return $this->jsonErrorResponse($this->getMessageData('error_message', $request_params['lang'])['general_error']);
            }
        }
    }


    public function getCountryAndCityInformation() {
        $request_params['lang']='en';
        $response = $this->getCountryModel()->with('cities')->where('archive','0')->where('status','0')->get();
        return $this->jsonSuccessResponse($this->getMessageData('success', $request_params['lang'])['profile_get_country_city'], $response);

    }

}
