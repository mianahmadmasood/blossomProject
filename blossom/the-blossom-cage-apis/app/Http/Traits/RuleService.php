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
     * Place order related rules
     * @var type
     */
    public $place_order_rules = [
        'first_name' => 'sometimes|max:25',
        'last_name' => 'sometimes:max:25',
        'phone_no' => 'sometimes',
        // 'email' => 'sometimes|email|max:49',
        'items.0' => 'required',
        'total_amount' => 'required',
        'tax_amount' => 'required',
        'shipping_first_name' => 'required|max:25',
        'shipping_last_name' => 'required:max:25',
        'shipping_phone_no' => 'required',
        'shipping_amount' => 'required',
        'shipping_full_address' => 'required',
        'shipping_zip_code' => 'required',
        'shipping_city' => 'required',
        'shipping_country' => 'required',
    ];
    public static $place_order_rules_en = [
        'first_name.max' => 'Recipient first name should be 25 charcters long',
        'last_name.max' => 'Recipient last name should be 25 charcters long',
        'email.max' => 'Recipient email should be 49 characters long',
        'items.0.required' => 'You have to add at least one item in your shopping bag for order',
        'total_amount.required' => 'The total amount field is required.',
        'tax_amount.required' => 'The tax amount field is required.',
        'shipping_amount.required' => 'The shipping amount field is required.',
        'shipping_full_address.required' => 'System is unable to verify your shipping address. Please select the shipping address again.',
        'shipping_zip_code.required' => 'System is unable to verify your shipping address. Please select the shipping address again.',
        'shipping_city.required' => 'System is unable to verify your shipping address. Please select the shipping address again.',
        'shipping_country.required' => 'System is unable to verify your shipping address. Please select the shipping address again.',
        'shipping_first_name.required' => 'Recipient first name field is required.',
        'shipping_last_name.required' => 'Recipient last name field is required.',
        'shipping_phone_no.required' => 'Recipient phone number field is required.',
        'email.required' => 'Recipient email field is required.',
        'email.email' => 'Recipient email should be valid email address.',
        'user.required' => 'You have to authenticate yourself before gaining access to the resource.',
        'phone_no.max' => 'You have entered invalid phone number. Please enter valid phone number.',
    ];
    public static $place_order_rules_ar = [
        'first_name.max' => 'يجب أن يكون طول اسم المستلم 25 حرفًا',
        'last_name.max' => 'يجب أن يكون اسم المستلم الأخير 25 حرفًا',
        'email.max' => 'يجب أن يكون طول بريد المستلم 49 حرفًا',
        'items.0.required' => 'يجب عليك إضافة عنصر واحد على الأقل في حقيبة التسوق الخاصة بك للطلب',
        'transaction_id.required' => 'معرف المعاملة مفقود من طريقة الدفع',
        'total_amount.required' => 'حقل المبلغ الإجمالي مطلوب',
        'tax_amount.required' => 'حقل مبلغ الضريبة مطلوب',
        'shipping_amount.required' => 'حقل مبلغ الشحن مطلوب',
        'shipping_lat.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_lng.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_full_address.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_zip_code.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_city.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_state.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_country.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_first_name.required' => 'حقل الاسم الأول للمستلم مطلوب',
        'shipping_last_name.required' => 'مطلوب مستلم اسم الحقل الأخير',
        'shipping_phone_no.required' => 'حقل رقم هاتف المستلم مطلوب',
        'email.required' => 'حقل البريد الإلكتروني المستلم مطلوب',
        'email.email' => 'يجب أن يكون البريد الإلكتروني للمستلم عنوان بريد إلكتروني صالحًا',
        'user.required' => 'يجب عليك مصادقة نفسك قبل الوصول إلى المورد',
        'phone_no.max' => 'لقد أدخلت رقم هاتف غير صالح. الرجاء إدخال رقم هاتف صحيح',
    ];

    /**
     * Place order related rules
     * @var type
     */
    public $place_order_rules_for_guest_user = [
        'items.0' => 'required',
        'transaction_id' => 'required',
        'total_amount' => 'required',
        'tax_amount' => 'required',
        'shipping_amount' => 'required',
        'shipping_lat' => 'required',
        'shipping_lng' => 'required',
        'shipping_full_address' => 'required',
        'shipping_zip_code' => 'required',
        'shipping_city' => 'required',
        'shipping_state' => 'required',
        'shipping_country' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'phone_no' => 'required|unique:users',
        'email' => 'required|email|unique:users|max:49',
    ];


    public $make_rules_for_guest_user = [
        'first_name' => 'required',
        'last_name' => 'required',
        'phone_no' => 'required',
        'email' => 'required|email||max:49',
    ];

    public static $make_rules_for_guest_user_en = [
        'first_name.required' => 'Recipient first name field is required.',
        'last_name.required' => 'Recipient last name field is required.',
        'phone_no.required' => 'Recipient phone number field is required.',
        // 'phone_no.unique' => 'Please try with different phone number.',
        // 'email.unique' => 'Please try with different email.',
        'email.required' => 'Recipient email field is required.',
        'email.email' => 'Recipient email should be valid email address.',
        'email.max' => 'Recipient email should be 49 characters long',
    ];
    public static $make_rules_for_guest_user_ar = [
        'first_name.required' => 'حقل الاسم الأول للمستلم مطلوب',
        'last_name.required' => 'مطلوب مستلم اسم الحقل الأخير',
        'phone_no.required' => 'حقل رقم هاتف المستلم مطلوب',
        'email.required' => 'حقل البريد الإلكتروني المستلم مطلوب',
        'email.email' => 'يجب أن يكون البريد الإلكتروني للمستلم عنوان بريد إلكتروني صالحًا',
        // 'phone_no.unique' => 'يرجى المحاولة مع رقم هاتف مختلف',
        'email.unique' => 'يرجى المحاولة مع بريد إلكتروني مختلف',
        'email.max' => 'يجب أن يكون طول بريد المستلم 49 حرفًا',
    ];


    public static $place_order_rules_for_guest_user_en = [
        'items.0.required' => 'You have to add at least one item in your shopping bag for order',
        'transaction_id.required' => 'The transaction id is missing from payment method.',
        'total_amount.required' => 'The total amount field is required.',
        'tax_amount.required' => 'The tax amount field is required.',
        'shipping_amount.required' => 'The shipping amount field is required.',
        'shipping_lat.required' => 'System is unable to verify your shipping address. Please select the shipping address again.',
        'shipping_lng.required' => 'System is unable to verify your shipping address. Please select the shipping address again.',
        'shipping_full_address.required' => 'System is unable to verify your shipping address. Please select the shipping address again.',
        'shipping_zip_code.required' => 'System is unable to verify your shipping address. Please select the shipping address again.',
        'shipping_city.required' => 'System is unable to verify your shipping address. Please select the shipping address again.',
        'shipping_state.required' => 'System is unable to verify your shipping address. Please select the shipping address again.',
        'shipping_country.required' => 'System is unable to verify your shipping address. Please select the shipping address again.',
        'first_name.required' => 'Recipient first name field is required.',
        'last_name.required' => 'Recipient last name field is required.',
        'phone_no.required' => 'Recipient phone number field is required.',
        'phone_no.unique' => 'Please try with different phone number.',
        'email.unique' => 'Please try with different email.',
        'email.required' => 'Recipient email field is required.',
        'email.email' => 'Recipient email should be valid email address.',
        'email.max' => 'Recipient email should be 49 characters long',
    ];
    public static $place_order_rules_for_guest_user_ar = [
        'items.0.required' => 'يجب عليك إضافة عنصر واحد على الأقل في حقيبة التسوق الخاصة بك للطلب',
        'transaction_id.required' => 'معرف المعاملة مفقود من طريقة الدفع',
        'total_amount.required' => 'حقل المبلغ الإجمالي مطلوب',
        'tax_amount.required' => 'حقل مبلغ الضريبة مطلوب',
        'shipping_amount.required' => 'حقل مبلغ الشحن مطلوب',
        'shipping_lat.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_lng.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_full_address.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_zip_code.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_city.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_state.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'shipping_country.required' => 'النظام غير قادر على التحقق من عنوان الشحن الخاص بك. يرجى تحديد عنوان الشحن مرة أخرى',
        'first_name.required' => 'حقل الاسم الأول للمستلم مطلوب',
        'last_name.required' => 'مطلوب مستلم اسم الحقل الأخير',
        'phone_no.required' => 'حقل رقم هاتف المستلم مطلوب',
        'email.required' => 'حقل البريد الإلكتروني المستلم مطلوب',
        'email.email' => 'يجب أن يكون البريد الإلكتروني للمستلم عنوان بريد إلكتروني صالحًا',
        'phone_no.unique' => 'يرجى المحاولة مع رقم هاتف مختلف',
        'email.unique' => 'يرجى المحاولة مع بريد إلكتروني مختلف',
        'email.max' => 'يجب أن يكون طول بريد المستلم 49 حرفًا',
    ];

    /**
     * signup rules
     */
    public $signup_rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|max:49',
        'password' => 'required|min:8',
        'confirm_password' => 'required|same:password',
        'device_type' => 'required|in:ios,android,web',
        'device_token' => 'required',
    ];
    public static $signup_rules_en = [
        'first_name.required' => 'first name field is required',
        'last_name.required' => 'last name field is required',
        'email.required' => 'email field is required',
        'email.email' => 'email should be a valid email address',
        'email.max' => 'email should be 49 characters long',
        'password.required' => 'password field is required',
        'password.min' => 'The password must be at least 8 characters',
        'confirm_password' => 'confirm password field is required',
        'confirm_password.same' => 'confirm password should be same as password',
        'device_type.required' => 'device type field isrequired',
        'device_token.required' => 'device token field isrequired',
        'email.unique' => 'this email has already been taken',
        'device_type.in' => 'invalid device type selected',
    ];
    public static $signup_rules_ar = [
        'first_name.required' => 'حقل الاسم الأول مطلوب',
        'last_name.required' => 'حقل الاسم الأخير مطلوب',
        'email.required' => 'حقل البريد الإلكتروني مطلوب',
        'email.email' => 'يجب أن يكون البريد الإلكتروني عنوان بريد إلكتروني صالح',
        'email.max' => 'يجب أن يكون طول البريد الإلكتروني 49 حرفًا',
        'password.required' => 'حقل كلمة المرور مطلوب',
        'confirm_password' => 'تأكيد حقل كلمة المرور مطلوب',
        'confirm_password.same' => 'تأكيد كلمة المرور يجب أن تكون هي نفسها كلمة المرور',
        'device_type.required' => 'حقل نوع الجهاز مطلوب',
        'device_token.required' => 'تم طلب حقل رمز الجهاز',
        'email.unique' => 'وقد تم بالفعل اتخاذ هذا البريد الإلكتروني',
        'device_type.in' => 'تم تحديد نوع الجهاز غير صالح',
        'password.min' => 'يجب أن تكون كلمة المرور 8 أحرف على الأقل',
    ];

    /**
     * Login rules
     */
    public $login_rules = [
        'email' => 'required|email',
        'password' => 'required',
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

    /**
     * Update Password rules
     */
    public $update_password = [
        'old_password' => 'required',
        'new_password' => 'required|min:8',
    ];
    public static $update_password_en = [
        'old_password.required' => 'Please enter your old password',
        'new_password.required' => 'Please enter your new password',
        'new_password.min' => 'New password should have atleast 8 character',
    ];
    public static $update_password_ar = [
        'old_password.required' => 'الرجاء إدخال كلمة المرور القديمة',
        'new_password.required' => 'الرجاء إدخال كلمة المرور الجديدة',
        'new_password.min' => 'يجب أن تحتوي كلمة المرور الجديدة على 8 أحرف على الأقل',
    ];

    /**
     * Give Feedback rules
     */
    public $feedback = [
        'feedback' => 'required|min:25',
        'type' => 'required|in:feedback,ticket'
    ];
    public static $feedback_en = [
        'feedback.required' => 'please provide your statement for feedback',
        'feedback.min' => 'Message should be atleast 25 characters long.',
        'type.required' => 'please select type of your query',
        'type.in' => 'you can submit only a ticket or a feedback',
    ];
    public static $feedback_ar = [
        'feedback.required' => 'يرجى تقديم بيان لردود الفعل',
        'feedback.min' => 'يجب أن يكون طول الرسالة 25 حرفًا على الأقل.',
        'type.required' => 'يرجى اختيار نوع استفسارك',
        'type.in' => 'يمكنك تقديم تذكرة فقط أو ردود الفعل',
    ];

    /**
     * Give Feedback rules
     */
    public $fogotpassword = [
        'email' => 'required|email|max:49'
    ];
    public static $fogotpassword_en = [
        'email.required' => 'email field is required',
        'email.email' => 'email should be a valid email address',
        'email.max' => 'email should be 49 characters long',
    ];
    public static $fogotpassword_ar = [
        'email.required' => 'حقل البريد الإلكتروني مطلوب',
        'email.email' => 'يجب أن يكون البريد الإلكتروني عنوان بريد إلكتروني صالح',
        'email.max' => 'يجب أن يكون طول البريد الإلكتروني 49 حرفًا',
    ];

    /**
     * Make Favorite rules
     */
    public $make_favorite = [
        'item_id' => 'required'
    ];
    public static $make_favorite_en = [
        'item_id.required' => 'please select product for your wishlist',
    ];
    public static $make_favorite_ar = [
        'item_id.required' => 'يرجى اختيار عنصر لقائمة الأمنيات الخاصة بك',
    ];

    /**
     * Update Password rules
     */
    public $reset_password = [
        'reset_code' => 'required',
        'new_password' => 'required|min:8',
        'confirm_password' => 'required|same:new_password',
    ];
    public static $reset_password_en = [
        'reset_code.required' => 'Please enter your reset code',
        'new_password.required' => 'Please enter your new password',
        'new_password.min' => 'New password should have atleast 8 character',
        'confirm_password.required' => 'Please enter your new password',
        'confirm_password.same' => 'Cofirm password password should be same as new password',
    ];
    public static $reset_password_ar = [
        'reset_code.required' => 'الرجاء إدخال رمز إعادة التعيين',
        'new_password.required' => 'الرجاء إدخال كلمة المرور الجديدة',
        'new_password.min' => 'يجب أن تحتوي كلمة المرور الجديدة على 8 أحرف على الأقل',
        'confirm_password.required' => 'الرجاء إدخال كلمة المرور الجديدة مرة أخرى',
        'confirm_password.same' => 'تأكيد كلمة المرور يجب أن تكون هي نفسها كلمة المرور الجديدة',
    ];

}
