<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of GuestSignup
 *
 * @author qadeer
 */

use App\Http\Services\Config;
use Hash;
use App\UserDevice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class GuestSignup extends Config
{

    /**
     * signUpGuestUser method
     * make user for guest sigup
     * @param type $request_params
     * @return type
     */
    public function makesignUpGuestUser()
    {

        $request_params = Input::all();
        $validation = Validator::make($request_params, $this->make_rules_for_guest_user, $this->selectRulesLang($rules = 'place_order_rules', $request_params['lang']));
        if ($validation->fails()) {
            return $this->jsonErrorResponse($validation->errors()->first());
        }

        $find_user = $this->getUserModel()->getUserByColumnValue('email', $request_params['email']);
            
            if (!empty($find_user)) {
                $userdata['first_name'] = $find_user->first_name;
                $userdata['last_name'] = $find_user->last_name;
                $userdata['phone_no'] = $find_user->phone_no;
                $userdata['email'] = $find_user->email;
                $userdata['user_token'] = $find_user->user_token;
                return $this->jsonSuccessResponse($this->getMessageData('success', $request_params['lang'])['signup_done'], $userdata);
            

            } else {

            
                $user_data = [];
                $user_data['first_name'] = $request_params['first_name'];
                $user_data['last_name'] = $request_params['last_name'];
                $user_data['phone_no'] = $request_params['phone_no'];
                $user_data['email'] = strtolower($request_params['email']);
                $user_data['role_id'] = 2;
                $user_data['password'] = null;
                $user_data['user_token'] = Hash::make(time());
                $create_user = $this->getUserModel()->create($user_data);

            if ($create_user) {
                $create_user_profile = $this->processGuestUserProfile($create_user, $request_params);
                $create_user_device = $this->makeGuestUserDevice($create_user, $request_params);
                $send_welcome_email = $this->sendWelcomeEmail($create_user, $request_params);
                if ($create_user_profile && $create_user_device && $send_welcome_email) {
                    $response= $this->getUserModel()->getUserByColumnValue('id', $create_user->id);
                    $userdata['first_name'] = $response->first_name;
                    $userdata['last_name'] = $response->last_name;
                    $userdata['phone_no'] = $response->phone_no;
                    $userdata['email'] = $response->email;
                    $userdata['user_token'] = $response->user_token;
                    return $this->jsonSuccessResponse($this->getMessageData('success', $request_params['lang'])['signup_done'], $userdata);
                }
            }
        }
        return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['authenticate']);
  
    }
    public function signUpGuestUser($request_params)
    {

        $user_data = [];
        $user_data['first_name'] = $request_params['first_name'];
        $user_data['last_name'] = $request_params['last_name'];
        $user_data['phone_no'] = $request_params['phone_no'];
        $user_data['email'] = strtolower($request_params['email']);
        $user_data['role_id'] = 2;
        $user_data['password'] = null;
        $user_data['user_token'] = Hash::make(time());
        $create_user = $this->getUserModel()->create($user_data);

        if ($create_user) {
            $create_user_profile = $this->processGuestUserProfile($create_user, $request_params);
            $create_user_device = $this->makeGuestUserDevice($create_user, $request_params);
            $send_welcome_email = $this->sendWelcomeEmail($create_user, $request_params);
            if ($create_user_profile && $create_user_device && $send_welcome_email) {
                return $this->getUserModel()->getUserByColumnValue('id', $create_user->id);
            }
        }
        return false;
    }


    /**
     * sends welcome email to the guest user
     * @param type $user
     */
    protected function sendWelcomeEmail($user, $request_params)
    {


        $data['email'] = $user->email;
        $data['first_name'] = $user->first_name;
        $data['last_name'] = $user->last_name;
        if ($request_params['lang'] == 'ar') {
            $data['subject'] = 'مرحبا بكم في ' . ' Blossomcage';
            $template = 'welcome';
        } else {
            $data['subject'] = 'Welcome to Blossomcage';
            $template = 'welcomeAR';
        }
        $sendEmail = $this->sendEmail($template, $data);
        if (!$sendEmail) {
            return false;
        }
        return true;
    }

    /**
     * processGuestUserProfile method
     * prepares data for guest user profile
     * @param type $user
     * @param type $request_params
     */
    public function processGuestUserProfile($user, $request_params)
    {

        $user_profile = [];
        $user_profile['user_id'] = $user->id;
        $user_profile['full_address'] = !empty($request_params['shipping_full_address']) ? $request_params['shipping_full_address'] : 'Saudi Arabia';
        $user_profile['zip_code'] =  !empty($request_params['shipping_zip_code']) ? $request_params['shipping_zip_code'] : 65400;
        $user_profile['city'] = !empty($request_params['shipping_city']) ? $request_params['shipping_city'] : 'Tabuk';
        $user_profile['city_id'] = !empty($request_params['shipping_city_id']) ? $request_params['shipping_city_id'] : 1;
        $user_profile['state'] = !empty($request_params['shipping_state']) ? $request_params['shipping_state'] : 'Saudi Arabia';
        $user_profile['country'] = !empty($request_params['shipping_country']) ? $request_params['shipping_country'] : 'Saudi Arabia';
        $user_profile['country_id'] = !empty($request_params['shipping_country_id']) ? $request_params['shipping_country_id'] : 1;

        return $this->getUserProfileModel()->create($user_profile);
    }

    /**
     *
     * @param type $guest_user
     * @param type $request_params
     * @return type\
     */
    public function makeGuestUserDevice($guest_user, $request_params)
    {

        if (!empty($request_params['device_type']) && !empty($request_params['device_token'])) {
            $device = [];
            $device['user_id'] = $guest_user->id;
            $device['device_type'] = $request_params['device_type'];
            $device['device_token'] = $request_params['device_token'];
            $settings['user_id'] = $guest_user->id;
            $settings['push_notification'] = 1;
            $settings['email_notification'] = 1;
            $settings['text_notification'] = 1;
            $this->getUserDeviceModel()->create($device);
            $this->getSettingModel()->create($settings);
        }
        return true;
    }

//    public function updateUserDeviceToken( $request_params)
//    {
//
//         if (!empty($request_params['device_type']) && !empty($request_params['device_token'])) {
//            $device = $this->getUserDeviceModel()->getByColumnValue('user_id', $request_params['user']->id);
//            $device->device_type = $request_params['device_type'];
//            $device->device_token = $request_params['device_token'];
//            return $device->save();
//
//        }
//        return true;
//    }


    public function updateUserDevice($request_params) {
        if (!empty($request_params['user']) && !empty($request_params['device_token']) && !empty($request_params['device_type'])) {
            $this->updateUserLang($request_params['user'], $request_params);
            $device = $this->getUserDeviceModel()->getByColumnValue('user_id', $request_params['user']->id);
            
            if(!empty($device)){
                $device->device_type = $request_params['device_type'];
                $device->device_token = $request_params['device_token'];
                return $device->save();
            }else{

                $device = new UserDevice();
                $device->user_id = $request_params['user']->id;
                $device->device_type = $request_params['device_type'];
                $device->device_token = $request_params['device_token'];
                return $device->save();
            }
            
            
        } elseif (!empty($request_params['guestemail']) && !empty($request_params['device_token']) && !empty($request_params['device_type'])) {
            $user = $this->getUserModel()->getUserByColumnValue('email', $request_params['guestemail']);
            $this->updateGuestUsesDevice($user, $request_params);
            if (!empty($user)) {
                return $this->updateUserLang($user, $request_params);
            }
        } else {
            return true;
        }
    }

    /**
     *
     * @param type $user
     */
    protected function updateUserLang($user, $request_params) {

        $user->lang = $request_params['lang'];
        return $user->save();
    }

    /**
     *
     * @param type $user
     * @param type $request_params
     * @return type
     */
    protected function updateGuestUsesDevice($user, $request_params) {
        if (!empty($user)) {
            if (!empty($user->device)) {
                $device = $user->device;
                $device->device_type = $request_params['device_type'];
                $device->device_token = $request_params['device_token'];
                return $device->save();
            } else {
                $device_data['user_id'] = $user->id;
                $device_data['device_type'] = $request_params['device_type'];
                $device_data['device_token'] = $request_params['device_token'];
                return $this->getUserDeviceModel()->create($device_data);
            }
        }
        return true;
    }

}
