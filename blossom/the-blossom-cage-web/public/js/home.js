
// jQuery(document).ready(function ($) {
//
//
//
//     if (window.history && window.history.pushState) {
//
//         if (!window.location.hash) {
//             var lang = $('#selectpicker12').find(":selected").val();
//             var new_lang12= localStorage.getItem("new_lang");
//
//
// //         // var lang = locale;
//             var url = window.location.href;
//             if (lang != '' && lang != 'NaN' && lang != undefined   &&  new_lang12 != '' && new_lang12 != 'NaN' && new_lang12 != undefined && lang != new_lang12 ) {
//
//                 if (new_lang12 == 'en') {
//                     var newUrl = url.replace('/ar', '/' + new_lang12);
//                 } else {
//                     var newUrl = url.replace('/en', '/' + new_lang12);
//                 }
//                 window.location.href = newUrl;
//
//             }
// //
//
//         }
//     }
// });


// $(window).on("load", function () {
//    console.log(window.location.href);
//    if (window.location.href === baseUrl + locale + '/products')
//    {
//        $.ajax({
//            type: "GET",
//            url: baseUrl + locale + "/products/featured/list",
//            success: function (result) {
//
//                if (result.success === true) {
//                    $('#listview').html(result.data);
//                } else {
//
//                }
//            },
//            error: function () {
//                $('#body').removeClass('kt-page--loading');
//
//            }
//        });
//    }
// });


$(document).ready(function () {

    $("#locale").change(function () {
        var lang = $('#locale').find(":selected").val();
        localStorage.setItem("new_lang", lang);
        var url = window.location.href;
        if (lang == 'en') {
            var newUrl = url.replace('/ar', '/' + lang);
        } else {
            var newUrl = url.replace('/en', '/' + lang);
        }
        $.ajax({
            type: "GET",
            url: baseUrl + "locale",
            data: {lang: lang, url: url},
            success: function (result) {
                if (result.success === true) {
                    console.log(result.data.url);
//                    return;
                    window.location.href = newUrl;

                    // window.location.href = result.data.url;
                }
            },
            error: function () {

            }
        });

        window.location.href = newUrl;

    });
    $("#currency").change(function () {

        var currency = $('#currency').find(":selected").val();

        var url = window.location.href;

        $.ajax({
            type: "GET",
            url: baseUrl + "currency",
            data: {currency: currency, url: url},
            success: function (result) {
                if (result.success === true) {
                    window.location.href = result.data.url;
                }
            },
            error: function () {

            }
        });
    });


    // $(window).on("load", function () {
    //
    //     var lang = $('#locale').find(":selected").val();
    //     var url = window.location.href;
    //     $.ajax({
    //         cache: false,
    //         type: "GET",
    //         url: baseUrl + "localeCurrentValue",
    //         data: {lang: lang, url: url},
    //         success: function (result) {
    //             if (result.success === true) {
    //                 current_locale = result.data.new_locale;
    //
    //                 console.log('current_locale', current_locale, 'locale_app', locale_app, 'locale', locale);
    //
    //
    //                 if (lang == 'en') {
    //                     var str = url;
    //                     var current_url_locale = str.includes("/en");
    //
    //                     if (current_url_locale == true) {
    //                         var newlocale = 'en';
    //                     }
    //                 } else {
    //
    //                     var str = url;
    //                     var current_url_locale = str.includes("/ar");
    //
    //                     if (current_url_locale == true) {
    //                         var newlocale = 'ar';
    //                     }
    //                 }
    //
    //                 console.log('current_locale', current_locale, 'locale_app', locale_app, 'locale', locale);
    //
    //                 // if (newlocale != lang) {
    //                 //     console.log('current_locale',current_locale,'locale_app',locale_app,'locale',locale);
    //                 //
    //                 //     if (lang == 'en') {
    //                 //         var newUrl = url.replace('/ar', '/' + lang);
    //                 //     } else {
    //                 //         var newUrl = url.replace('/en', '/' + lang);
    //                 //     }
    //                 //     window.location.href = newUrl;
    //                 // }else
    //                 if (newlocale != current_locale && current_locale != '' && current_locale != 'NaN' && current_locale != undefined) {
    //
    //
    //                     console.log('current_locale', current_locale, 'locale_app', locale_app, 'locale', locale);
    //
    //                     if (current_locale == 'en') {
    //                         var newUrl = url.replace('/ar', '/' + current_locale);
    //                     } else {
    //                         var newUrl = url.replace('/en', '/' + current_locale);
    //
    //                     }
    //                     window.location.href = newUrl;
    //                 }
    //             }
    //         },
    //         error: function () {
    //
    //         }
    //     });
    //
    //
    //     // window.location.href = newUrl;
    // });
    $(function () {
        $(window).resize(function () {
            if ($(window).width() > 767) {
                $('.FilterBox2').hide();
                // $('.menuIconButton').removeClass('is-active');
            }
        });
    });


});
