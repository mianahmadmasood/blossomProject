<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

trait RuleService {

    /**
     * 
     * @param type $rules
     * @param type $language
     * @return type
     */
    public function selectRulesLang($rules, $language = 'EN') {
        if (isset($rules) && !empty($language)) {
            $messages_type = $rules . '_' . strtolower($language);
            $messages = self::${$messages_type};
            return $messages;
        }
    }

    /**
     * Login rules
     */
    public $login_rules = [
        'email' => 'required|email',
        'password' => 'required',
        'device_type' => 'required',
        'device_token' => 'required',
    ];
    public static $login_rules_en = [
        'email.required' => 'email field is required',
        'email.email' => 'email should be a valid email address',
        'password.required' => 'password field is required',
        'device_type.required' => 'device type field isrequired',
        'device_token.required' => 'device token field isrequired',
    ];
    public static $login_rules_ar = [
        'email.required' => 'حقل البريد الإلكتروني مطلوب',
        'email.email' => 'يجب أن يكون البريد الإلكتروني عنوان بريد إلكتروني صالح',
        'password.required' => 'حقل كلمة المرور مطلوب',
        'device_type.required' => 'حقل نوع الجهاز مطلوب',
        'device_token.required' => 'تم طلب حقل رمز الجهاز',
    ];

}
