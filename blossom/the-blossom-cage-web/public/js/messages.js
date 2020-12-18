/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



var success_en = {
    select_filer: 'Please select categories or prices from the filters section',
};
var success_ar = {

    select_filer: 'يرجى تحديد الفئات أو الأسعار من قسم المرشحات',

};
var error_en = {
    select_filer: 'Please select categories or prices from the filters section.',
    quanity_one: 'Quantity of this product should be atleast one.',
    quanity_max: 'Quantity of this product should be less than maximum quantity.',
    first_name_required: 'please enter your valid guest first name.',
    last_name_required: 'please enter your valid guest last name. ',
    email_required: 'please provide a valid guest email.',
    phoneno_required: 'please enter a valid guest phone number.',
    shipping_first_name_required: 'please enter your valid shipping first name.',
    shipping_last_name_required: 'please enter your valid shipping last name. ',
    shipping_phoneno_required: 'please enter a valid shipping phone number.',
    shipping_country: 'Please select the shipping country.',
    shpping_full_address: 'Please enter shipping full street address.',
    shipping_city: 'Please enter the shipping city name.',
    shipping_state: 'Please enter the shipping state name.',
    shipping_zipcode: 'Shipping zipcode is required for accurate delivery.',
    shipping_zipcode_limit: 'Shipping zipcode character length should be equal and  greater than five.',
    billing_first_name_required: 'please enter your valid billing first name.',
    billing_last_name_required: 'please enter your valid billing last name. ',
    billing_phoneno_required: 'please enter a valid billing phone number.',
    billing_country: 'Please select the billing country.',
    billing_full_address: 'Please enter billing full street address.',
    billing_city: 'Please enter the billing city name.',
    billing_state: 'Please enter the billing state name.',
    billing_zipcode: 'Billing zipcode is required for accurate delivery.',
    billing_zipcode_limit: 'Billing zipcode character length should be equal and  greater than five.',
    old_password: 'Please enter your old password.',
    new_password: 'Please enter your new password.',
    confirm_password: 'Please enter confirm password.',
    confirm_same: 'New password and confirm password does not match.',
    email_validation: 'Please provide a valid email address.',

};

var error_ar = {
    select_filer: 'يرجى تحديد الفئات أو الأسعار من قسم المرشحات',
    quanity_one: 'يجب أن تكون كمية هذا العنصر واحدة على الأقل',
    quanity_max: 'يجب أن تكون كمية هذا المنتج أقل من الكمية القصوى.',
    first_name_required: 'الرجاء إدخال اسم الضيف الأول صالح.',
    last_name_required: ' الرجاء إدخال اسم العائلة الضيف صالح.',
    email_required: 'يرجى تقديم بريد إلكتروني صالح للضيوف.',
    phoneno_required: 'يرجى إدخال رقم هاتف ضيف صالح.',
    shipping_country: 'الرجاء إدخال بلد الشحن',
    shpping_full_address: 'الرجاء إدخال عنوان الشحن الكامل',
    shipping_city: 'الرجاء إدخال مدينة الشحن',
    shipping_state: 'الرجاء إدخال حالة الشحن',
    shipping_first_name_required: 'الرجاء إدخال الاسم الأول للشحن صالح.',
    shipping_last_name_required: '  الرجاء إدخال اسم العائلة الشحن صالح.',
    shipping_phoneno_required: '   الرجاء إدخال رقم هاتف شحن صالح.',
    shipping_country: 'يرجى اختيار بلد الشحن.',
    shpping_full_address: 'الرجاء إدخال عنوان شارع الشحن بالكامل.',
    shipping_city: 'الرجاء إدخال اسم مدينة الشحن.',
    shipping_state: '  الرجاء إدخال اسم حالة الشحن.',
    shipping_zipcode: 'مطلوب الرمز البريدي الشحن للتسليم دقيقة',
    shipping_zipcode_limit: 'يجب أن يكون طول حرف الرمز البريدي للشحن أكبر من خمسة',
    billing_first_name_required: 'يرجى إدخال اسم الفواتير صالح.',
    billing_last_name_required: 'الرجاء إدخال اسم آخر صالح للفوترة.',
    billing_phoneno_required: 'الرجاء إدخال رقم هاتف الفواتير صالح.',
    billing_country: 'يرجى اختيار بلد الفوترة.',
    billing_full_address: ' الرجاء إدخال الفواتير عنوان الشارع بالكامل.',
    billing_city: 'الرجاء إدخال اسم مدينة الفوترة.',
    billing_state: 'الرجاء إدخال اسم حالة الفوترة.',
    billing_zipcode: 'مطلوب الفواتير الرمز البريدي للتسليم دقيقة.',
    billing_zipcode_limit: 'يجب أن يكون طول حرف الرمز البريدي للفوترة مساوًا وأكبر من خمسة.',
    old_password: 'الرجاء إدخال كلمة المرور القديمة',
    new_password: 'من فضلك أدخل كلمة المرور الجديدة',
    confirm_password: 'الرجاء إدخال تأكيد كلمة المرور.',
    confirm_same: 'كلمة المرور الجديدة وتأكيد كلمة المرور غير متطابقة.',
    email_validation: 'يرجى تقديم عنوان بريد إلكتروني صالح'

};

function selectMessageString(type, lang, index) {

    if (type === 'error' && lang === 'ar') {
        var message = error_ar[index];
        return message;
    }

    if (type === 'error' && lang === 'en') {
        var message = error_en[index];
        return message;
    }

    if (type === 'success' && lang === 'ar') {
        var message = success_en[index];
        return message;
    }

    if (type === 'success' && lang === 'en') {
        var message = success_ar[index];
        return message;
    }

}
