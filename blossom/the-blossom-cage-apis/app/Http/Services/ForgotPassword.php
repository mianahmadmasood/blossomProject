<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of ForgotPassword
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class ForgotPassword extends Config {

    /**
     * 
     * @return type
     */
    public function sendCode() {

        $request_params = Input::all();

        $validation = Validator::make($request_params, $this->fogotpassword, $this->selectRulesLang($rules = 'fogotpassword', $request_params['lang']));
        if ($validation->fails()) {
            return $this->jsonErrorResponse($validation->errors()->first());
        }
        $user = $this->getUserModel()->getUserByColumnValue('email', $request_params['email']);
        if (empty($user)) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
        }
        return $this->processCode($request_params, $user);
    }

    /**
     * processCode method
     * @param type $user
     */
    protected function processCode($request_params, $user) {

        $code = $this->randomStrings(5);
        $user->reset_password_code = $code;
        $user->reset_password_token = \Hash::make(time());
        $user->reset_password_time = date('Y-m-d H:i:s');

        if ($user->save()) {
            $data = $this->prepareDataForEmail($user);
        }
        $send_email = $this->sendEmail($data['template'], $data);
        return $this->jsonSuccessResponseWithoutData($this->getMessageData('success', $request_params['lang'])['email_sent']);
    }

    /**
     * 
     * @param type $user
     * @return string
     */
    protected function prepareDataForEmail($user) {
        $user_lang = !empty($user->lang) ? $user->lang : 'en';
        if ($user_lang == 'ar') {
            $data['username'] = $user->first_name . ' ' . $user->last_name;
            $data['code'] = $user->reset_password_code;
            $data['email'] = $user->email;
            $data['subject'] = 'كلمة مرور الضباب';
            $data['template'] = 'forgotPasswordAR';
        } else {
            $data['username'] = $user->first_name . ' ' . $user->last_name;
            $data['code'] = $user->reset_password_code;
            $data['email'] = $user->email;
            $data['subject'] = 'Forgot Password';
            $data['template'] = 'forgotPassword';
        }
        return $data;
    }

    /**
     * 
     * @return type
     */
    public function resetPassword() {

        $request_params = Input::all();
        $validation = Validator::make($request_params, $this->reset_password, $this->selectRulesLang($rules = 'reset_password', $request_params['lang']));
        if ($validation->fails()) {
            return $this->jsonErrorResponse($validation->errors()->first());
        }
       
        $user = $this->getUserModel()->getUserByColumnValue('reset_password_code', $request_params['reset_code']);
        if (empty($user)) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['in_correct_fcode']);
        }
        $created_time = strtotime($user->reset_password_time);
        $current_time = strtotime(date('Y-m-d H:i:s'));
        $time = $current_time - $created_time;
        if ($time > 7200) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['verification_code_expired']);
        }
        return $this->processResetPassword($request_params, $user);
    }

    /**
     * 
     * @param type $request_params
     * @param type $user
     * @return type
     */
    protected function processResetPassword($request_params, $user) {

        if (Hash::check($request_params['new_password'], $user->password)) { 
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['this_password_recently']);
    
        }
         
        $user->password = Hash::make($request_params['new_password']);
        // $user->reset_password_code = null;
        // $user->reset_password_token = null;
        // $user->reset_password_time = null;
        if ($user->save()) {
            return $this->jsonSuccessResponseWithoutData($this->getMessageData('success', $request_params['lang'])['password_reset']);
        }
        return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['general_error']);
    
    }

}
