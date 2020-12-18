<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Signup
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\ResponseUser;
use Hash;
use DB;

class Signup extends Config {

    /**
     * Injecting related response class
     * @return ResponseItem
     */
    public function jsonResponse($user, $lang) {
        return new ResponseUser($user, $lang);
    }

    /**
     * userSignup method
     * this method is response fro user signup
     * @return JSON
     */
    public function userSignup() {

        $request_params = Input::all();
        $validation = Validator::make($request_params, $this->signup_rules, $this->selectRulesLang($rules = 'signup_rules', $request_params['lang']));
        if ($validation->fails()) {

            return $this->jsonErrorResponse($validation->errors()->first());
        }
        $guest_presence = $this->getUserModel()->getUserByColumnValue('email', $request_params['email']);
        if (!empty($guest_presence) && $guest_presence->password == NULL) {
            return $this->processGuestUser($guest_presence, $request_params);
        } elseif (!empty($guest_presence) && $guest_presence->password !== NULL) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['email_already_taken']);
        } else {
            return $this->processNormalUser($request_params);
        }
    }

    /**
     *
     * @param type $guest_user
     * @param type $request_params
     * @return type
     */
    protected function processGuestUser($guest_user, $request_params) {
        DB::beginTransaction();
        $guest_user->password = Hash::make($request_params['password']);
        $guest_user->first_name = $request_params['first_name'];
        $guest_user->last_name = $request_params['last_name'];
        if ($guest_user->save()) {
            $check_device = $this->getUserDeviceModel()->getByColumnValue('device_token', $request_params['device_token']);
            if ($check_device) {
                $check_device->delete();
            }
            $device = [];
            $device['user_id'] = $guest_user->id;
            $device['device_type'] = $request_params['device_type'];
            $device['device_token'] = $request_params['device_token'];
            $create_device = $this->getUserDeviceModel()->create($device);
            if ($create_device) {
                DB::commit();
                $complete_user = $this->getUserModel()->getUserByColumnValue('uuid', $guest_user->uuid);
                $response = $this->jsonResponse($complete_user, $request_params['lang'])->perpareResponse();
                return $this->jsonSuccessResponse($this->getMessageData('success', $request_params['lang'])['signup_done'], $response);
            }
        }
    }

    /**
     * sends welcome email to the guest user
     * @param type $user
     */
    protected function sendWelcomeEmail($user, $request_params) {


        $data['email'] = $user->email;
//        $data['email'] = 'ahmad.masood@ilsainteractive.com';
        $data['first_name'] = $user->first_name;
        $data['last_name'] = $user->last_name;
        if ($request_params['lang'] == 'ar') {
            $data['subject'] = 'مرحبا بكم في ' . ' Blossomcage';
            $template = 'welcomeAR';
        } else {
            $data['subject'] = 'Welcome to Blossomcage';
            $template = 'welcome';
        }
        $sendEmail = $this->sendEmail($template, $data);
        if (!$sendEmail) {
            return false;
        }
        return true;
    }

    /**
     * process Normal User
     * @param type $request_params
     * @return type
     */
    protected function processNormalUser($request_params) {

        $request_params['role_id'] = 2;
        $request_params['password'] = Hash::make($request_params['password']);
        $request_params['user_token'] = Hash::make($request_params['password'] . time());
        $request_params['email'] = strtolower($request_params['email']);

        DB::beginTransaction();
        $create_user = $this->getUserModel()->create($request_params);
        if ($create_user) {
            return $this->processUserDevice($create_user, $request_params);
        }
    }

    /**
     * prepareUserDevice method
     * creates a user device
     * @param type $created_user
     * @param type $request_params
     */
    public function processUserDevice($created_user, $request_params) {

        $this->checkUserExistingDevice($request_params);
        $device = $this->prepareUserDevice($created_user, $request_params);
        $settings = $this->prepareNotificationSettings($created_user, $request_params);
        $create_device = $this->getUserDeviceModel()->create($device);
        $create_settings = $this->getSettingModel()->create($settings);

        $sendWelcomeEmail = $this->sendWelcomeEmail($created_user, $request_params);
        if ($sendWelcomeEmail === false) {
            DB::rollback();
            return $this->jsonErrorResponse($this->getMessageData($type = 'error', $request_params['lang'])['invalid_email']);
        }

        if ($create_device && $create_settings) {
            DB::commit();
            $complete_user = $this->getUserModel()->getUserByColumnValue('uuid', $created_user->uuid);
            $response = $this->jsonResponse($complete_user, $request_params['lang'])->perpareResponse();
            return $this->jsonSuccessResponse($this->getMessageData('success', $request_params['lang'])['signup_done'], $response);
        }
        return $this->jsonErrorResponse($this->getMessageData($type = 'error', $request_params['lang'])['general_error']);
    }

    /**
     * checkUserExistingDevice
     * set old device to null
     */
    protected function checkUserExistingDevice($request_params) {

        $check_device = $this->getUserDeviceModel()->getByColumnValue('device_token', $request_params['device_token']);
        if ($check_device) {
            $check_device->device_token = null;
            $check_device->save();
        }
    }

    /**
     * prepareNotificationSettings
     * @param type $created_user
     * @return int
     */
    protected function prepareNotificationSettings($created_user) {

        $settings['user_id'] = $created_user->id;
        $settings['push_notification'] = 1;
        $settings['email_notification'] = 1;
        $settings['text_notification'] = 1;
        return $settings;
    }

    /**
     * prepare User Device
     * @param type $created_user
     * @param type $request_params
     * @return type
     */
    protected function prepareUserDevice($created_user, $request_params) {
        $device = [];
        $device['user_id'] = $created_user->id;
        $device['device_type'] = $request_params['device_type'];
        $device['device_token'] = $request_params['device_token'];
        return $device;
    }

}
