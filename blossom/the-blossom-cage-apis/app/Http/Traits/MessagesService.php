<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

trait MessagesService {

    public function getMessageData($type, $lang = 'EN') {
        if ($lang == 'ar' && $type == 'error') {
            return $this->error_ar;
        }if ($lang == 'ar' && $type == 'success') {
            return $this->success_ar;
        }
        if ($lang == 'en' && $type == 'error') {
            return $this->error_en;
        }if ($lang == 'en' && $type == 'success') {
            return $this->success_en;
        }
    }

    public $success_en = [
        'general_success' => 'Process successfully processed.',
        'payment_success' => 'Your payment process has been done successfully.',
        'signup_done' => 'You have signed up successfully.',
        'login_success' => 'You have logged-in successfully',
        'order_placed' => 'Your order has been placed successfully.',
        'profile_update' => 'Your profile has been updated successfully.',
        'profile_get_country_city' => 'Your profile data has been get successfully.',
        'password_updated' => 'Your password has been changed successfully.',
        'password_reset' => 'Your password has been reset successfully.',
        'feedback_success' => 'Feedback has been submitted successfully. Admin will contact you soon.',
        'ticket_success' => 'Your ticket has been submitted successfully. Admin will contact you soon.',
        'item_favorited' => 'Product has been added to your wishlist successfully.',
        'item_removed' => 'Product removed from your wishlist successfully.',
        'email_sent' => 'Reset password code has been send to your email successfully.',
        'currency_change' => 'Your currency has been changed successfully.',
        'setting_update' => 'Your profile settings are updated successfully.',
    ];
    public $success_ar = [
        'general_success' => 'العملية تمت بنجاح',
        'payment_success' => 'تم إجراء عملية الدفع بنجاح',
        'signup_done' => 'لقد اشتركت بنجاح',
        'login_success' => 'ياهلا وسهلا، سجلت دخولك',
        'order_placed' => 'تم تقديم طلبك بنجاح',
        'profile_update' => 'تم تحديث ملفك الشخصي بنجاح',
        'password_updated' => 'تم تغيير كلمة مرورك بنجاح',
        'profile_get_country_city' => 'تم الحصول على بيانات ملفك الشخصي بنجاح.',
        'feedback_success' => 'تم تقديم الملاحظات بنجاح. سوف المشرف الاتصال بك قريبا',
        'ticket_success' => 'تم إرسال التذكرة بنجاح. سوف المشرف الاتصال بك قريبا',
        'item_favorited' => 'تم إرسال العنصر إلى قائمة الأمنيات بنجاح',
        'item_removed' => 'تمت إزالة المنتج من قائمة الأمنيات بنجاح',
        'email_sent' => 'تم إعادة تعيين رمز كلمة المرور إلى بريدك الإلكتروني بنجاح',
        'currency_change' => 'تم تغيير عملتك بنجاح',
        'setting_update' => 'يتم تحديث إعدادات ملف التعريف الخاص بك بنجاح',
        'password_reset' => 'تم إعادة تعيين كلمة المرور الخاصة بك بنجاح',
    ];

    /**
     * All the error messages with English translation goes here.
     *
     */
    public $error_en = [
        'general_error' => 'Sorry, something went wrong. We are working on getting this fixed as soon as we can.',
        'invalid_email' => 'Please provide your valid email address.',
        'invalid_login' => 'Please provide valid email and password.',
        'service_unavailable' => '503 Service Unavailable Error.',
        'incorrect_old_password' => 'Your old password does not match our records.',
        'same_password' => 'New password must be different from old password.',
        'no_records_found' => 'Sorry, No Records Found..',
        'already_n_wishlist' => 'This product is already exist in your wishlist.',
        'accoount_blocked' => 'Your account is suspended. Please contact admin.',
        'verification_code_expired' => 'Reset code has been expired.',
        'email_already_taken' => 'This email has already been taken.',
        'in_correct_fcode' => 'The code you entered was not recognized. Please enter correct code and try again.',
        'authenticate' => 'You have to authenticate yourself before gaining access to the resource.',
        'no_order_found' => 'No orders found.',
        'phone_invalid' => 'your guest phone number is not valid. please enter the valid phone number',
        'shipping_phone_invalid' => 'your shipping phone number is not valid. please enter the valid phone number',
        'billing_phone_invalid' => 'your billing phone number is not valid. please enter the valid phone number',
        'products_outof_stock' => 'Sorry, Some products are out of stock.',
        'product_out_stock' => 'Your selected product is out of stock.',
        'product_out_stock_color' => 'The product in this color is out of stock.please buy with other color.',
        'product_deactivated' => 'Your selected product is not available anymore.',
        'product_deactivated_color' => 'Your selected product color is not available anymore.',
        // new massage response
        'product_color_qty' => 'Please set the quantity again.',
        'payment_under_review' => "This transaction is under review and will be reversed based on your card issuing bank's policy, if its not approved within 24 hours.",
        'payment_greater_then_sar' => "Transaction Error: Thought Paytab (online payment), The transaction amount cannot be greater than SAR 18,702.75. For this large amount you can do checkout with Cash on delivery (COD) method.",
        'payment_greater_then_usd' => "Transaction Error: Thought Paytab (online payment), The transaction amount cannot be greater than USD 4,987.31. For this large amount you can do checkout with Cash on delivery (COD) method.",
        'selected_category_is_no_found' => 'Selected category is not available anymore.',
        'selected_subcategory_is_no_found' => 'Selected subcategory is not available anymore.',
        'this_password_recently' => 'You used this password recently. Please choose a different one.',
    ];

    /**
     * All the error messages with Arabic translation goes here.
     *
     */
    public $error_ar = [
        'general_error' => 'اسفين، قاعدين نشتغل على حل الموضوع',
        'invalid_login' => 'يرجى تقديم رقم بريد إلكتروني صالح وكلمة مرور',
        'invalid_email' => 'يرجى تقديم عنوان بريدك الإلكتروني الصحيح',
        'service_unavailable' => '503 Service Unavailable Error ',
        'incorrect_old_password' => 'كلمة المرور القديمة لا تتطابق مع سجلاتنا',
        'same_password' => 'يجب أن تكون كلمة المرور الجديدة مختلفة عن كلمة المرور القديمة',
        'no_records_found' => 'آسف لا توجد سجلات ',
        'already_n_wishlist' => 'هذا المنتج موجود بالفعل في قائمة أمنياتك',
        'accoount_blocked' => 'تم تعليق حسابك. يرجى الاتصال المشرف.',
        'verification_code_expired' => 'انتهت صلاحية إعادة تعيين الرمز',
        'email_already_taken' => 'وقد تم بالفعل اتخاذ هذا البريد الإلكتروني',
        'in_correct_fcode' => 'لم يتم التعرف على الكود الذي أدخلته. الرجاء إدخال الرمز الصحيح والمحاولة مرة أخرى',
        'authenticate' => 'يجب عليك مصادقة نفسك قبل الوصول إلى المورد',
        'no_order_found' => 'لم يتم العثور على أية طلبات',
        'phone_invalid' => 'هاتف ضيفك غير صالح. يرجى إدخال رقم الهاتف صالح',
        'shipping_phone_invalid' => 'رقم هاتف الشحن الخاص بك غير صالح. يرجى إدخال رقم الهاتف صالح',
        'billing_phone_invalid' => 'رقم هاتف الفواتير الخاص بك غير صالح. يرجى إدخال رقم الهاتف صالح',
        'products_outof_stock' => 'آسف ، بعض المنتجات من المخزون',
        'product_out_stock' => 'المنتج المحدد الخاص بك هو من المخزون',
        'product_out_stock_color' => 'المنتج في هذا اللون هو من المخزون. يرجى شراء مع لون آخر.',
        'product_deactivated' => 'المنتج الذي اخترته غير متوفر بعد الآن',
        'product_deactivated_color' => 'لون المنتج الذي اخترته غير متوفر بعد الآن',
        'product_color_qty' => 'يرجى ضبط الكمية مرة أخرى.',
        'payment_under_review' => "هذه الصفقة قيد المراجعة وسيتم عكسها بناءً على سياسة البنك الذي أصدر بطاقتك ، إذا لم تتم الموافقة عليها في غضون 24 ساعة",
        'payment_greater_then_sar' => "خطأ المعاملة: الفكر بيتابس (الدفع عبر الإنترنت) ، لا يمكن أن يكون مبلغ المعاملة أكبر من 18702.75 ريال سعودي. بالنسبة لهذا المبلغ الكبير ، يمكنك إجراء الدفع باستخدام طريقة الدفع عند الاستلام (COD).",
        'payment_greater_then_usd' => "خطأ المعاملة: الفكر بيتابس (الدفع عبر الإنترنت) ، لا يمكن أن يكون مبلغ المعاملة أكبر من 4،987.31 دولار أمريكي. بالنسبة لهذا المبلغ الكبير ، يمكنك إجراء الدفع باستخدام طريقة الدفع عند الاستلام (COD).",
        'selected_category_is_no_found' => 'الفئة المختارة غير متوفرة بعد الآن.',
        'selected_subcategory_is_no_found' => 'الفئة الفرعية المحددة غير متوفرة بعد الآن.',
        'this_password_recently' => 'لقد استخدمت كلمة المرور هذه مؤخرًا. يرجى اختيار واحد مختلف.',
    ];

}
