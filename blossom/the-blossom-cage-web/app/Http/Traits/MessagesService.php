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
        'item_added_to_bag' => 'Product is added to your shopping bag successfully.',
        'item_removed_to_bag' => 'Product is removed from your shopping bag successfully.',
        'bag_updated' => 'Your shopping cart has been updated successfully.',
        'login_success' => 'You have logged-in successfully',
        'logout' => 'You have logged-out successfully',
    ];
    public $success_ar = [
        'general_success' => 'العملية تمت بنجاح',
        'item_added_to_bag' => 'تتم إضافة العنصر إلى حقيبة التسوق الخاصة بك بنجاح',
        'item_removed_to_bag' => 'تمت إزالة العنصر من حقيبة التسوق الخاصة بك بنجاح',
        'bag_updated' => 'تم تحديث حقيبة التسوق الخاصة بك بنجاح',
        'login_success' => 'ياهلا وسهلا، سجلت دخولك',
        'logout' => 'لقد قمت بتسجيل الخروج بنجاح',
    ];

    /**
     * All the error messages with English translation goes here.
     *
     */
    public $error_en = [
        'general_error' => 'Sorry, something went wrong. We are working on getting this fixed as soon as we can',
        'general_error_on_checkout_page' => 'We are sorry. Your internet is not stable. Please checkout again.',
        'item_already_in_bag' => 'Product is already in your shopping bag.',
        'last_item_in_bag' => 'You cannot remove the last product from shopping bag at the time of checkout.',
        'add_item' => 'You have to add at least one product in your cart to checkout.',
        'invalid_login' => 'Please provide valid email and password.',
        'order_belongs' => 'It seems that this order does not belongs to you.',
        'order_failure' => 'Your payment has been rejected. Please place the order and try again.',
        'transaction_under_review' => "This transaction is under review and will be reversed based on your card issuing bank's policy, if its not approved within 24 hours",
        'category_blocked' => 'Products under this category is not available anymore',
        'brand_blocked' => 'Products under this brand is not available anymore',
    ];

    /**
     * All the error messages with Arabic translation goes here.
     *
     */
    public $error_ar = [
        'general_error' => 'اسفين، قاعدين نشتغل على حل الموضوع',
        'general_error_on_checkout_page' => 'نحن آسفون. الإنترنت الخاص بك غير مستقر. يرجى الخروج مرة أخرى.',
        'item_already_in_bag' => 'العنصر موجود بالفعل في حقيبة التسوق الخاصة بك',
        'last_item_in_bag' => 'لا يمكنك إزالة العنصر الأخير من حقيبة التسوق في وقت الخروج',
        'add_item' => 'يجب عليك إضافة عنصر واحد على الأقل في حقيبتك للخروج',
        'invalid_login' => 'يرجى تقديم بريد إلكتروني صالح وكلمة مرور صالحة',
        'order_belongs' => 'يبدو أن هذا الطلب لا ينتمي إليك',
        'order_rejected' => 'رفض طلب الدفع',
        'transaction_under_review' => "هذه الصفقة قيد المراجعة وسيتم عكسها بناءً على سياسة البنك الذي أصدر بطاقتك ، إذا لم تتم الموافقة عليها في غضون 24 ساعة",
        'category_blocked' => 'المنتجات تحت هذه الفئة غير متوفرة بعد الآن',
        'brand_blocked' => 'المنتجات تحت هذه العلامة التجارية غير متوفرة بعد الآن',
    ];

}
