/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).on("keyup keypress", "#checkout", function (e) {
    var phone = $('#phone_no').val();
    var user_login_flag = $('#user_login_flag').val();
    var regex = /^[a-zA-Z ]*$/;
    var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();

        $('#f_name').removeClass('field-error');
        $('#l_name').removeClass('field-error');
        $('#email-1').removeClass('field-error');
        $('#phone_no').removeClass('field-error');
        $('#shipping_first_name').removeClass('field-error');
        $('#billing_country').removeClass('field-error');
        $('#shipping_last_name').removeClass('field-error');
        $('#shipping_phone_no').removeClass('field-error');
        $('#shpping_full_address').removeClass('field-error');
        $('#shipping_city').removeClass('field-error');
        $('#shipping_state').removeClass('field-error');
        $('#shipping_zipcode').removeClass('field-error');
        $('#shipping_zipcode').removeClass('field-error');
        $('#shipping_country').removeClass('field-error');
        $('#billing_first_name').removeClass('field-error');
        $('#billing_last_name').removeClass('field-error');
        $('#billing_phone_no').removeClass('field-error');
        $('#billing_full_address').removeClass('field-error');
        $('#billing_city').removeClass('field-error');
        $('#billing_state').removeClass('field-error');
        $('#billing_zipcode').removeClass('field-error');
        $('#billing_country').removeClass('field-error');
        $('#addshipping_city button').removeClass('field-error');
        $('#addbilling_city button').removeClass('field-error');


        if (user_login_flag == 0) {
            if ($('#f_name').val() === '') {
                var message = selectMessageString('error', locale, 'first_name_required');
                $('#f_name').addClass('field-error');
                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }
            if ($('#l_name').val() === '') {
                var message = selectMessageString('error', locale, 'last_name_required');
                $('#l_name').addClass('field-error');
                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }
            if ($('#email-1').val() === '' || !regex_email.test($('#email-1').val())) {
                var message = selectMessageString('error', locale, 'email_required');
                $('#email-1').addClass('field-error');
                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }

            if (phone === '' || phone.length < 13) {
                var message = selectMessageString('error', locale, 'phoneno_required');
                $('#phone_no').addClass('field-error');
                $('#alert').hide();
                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }
        }

        if ($('#shipping_first_name').val() === '') {
            var message = selectMessageString('error', locale, 'shipping_first_name_required');
            $('#shipping_first_name').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
        if ($('#shipping_last_name').val() === '') {
            var message = selectMessageString('error', locale, 'shipping_last_name_required');
            $('#shipping_last_name').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }

        var shipping_phone_no = $('#shipping_phone_no').val();

        if (shipping_phone_no === '' || shipping_phone_no.length < 13) {
            var message = selectMessageString('error', locale, 'shipping_phoneno_required');
            $('#shipping_phone_no').addClass('field-error');
            $('#alert').hide();
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }

        if ($('#shpping_full_address').val() === '') {
            var message = selectMessageString('error', locale, 'shpping_full_address');
            $('#shpping_full_address').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }

        if ($('#shipping_city').val() === '') {
            var message = selectMessageString('error', locale, 'shipping_city');
            $('#addshipping_city button').addClass('field-error');

            // $('#shipping_city').addClass('field-error');

            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
        if ($('#shipping_state').val() === '') {
            var message = selectMessageString('error', locale, 'shipping_state');
            $('#shipping_state').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
        if ($("#shipping_zipcode").val() === '') {
            var message = selectMessageString('error', locale, 'shipping_zipcode');
            $('#shipping_zipcode').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
        var zipcode = $('#shipping_zipcode').val();
        if (zipcode.length < 5) {
            var message = selectMessageString('error', locale, 'shipping_zipcode_limit');
            $('#shipping_zipcode').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
        if ($('#shipping_country').find(":selected").text() === '') {
            var message = selectMessageString('error', locale, 'shipping_country');
            $('#shipping_country').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }

        var is_same_billing = $('#is_same_billing').val();

        if (is_same_billing == '0') {

            if ($('#billing_first_name').val() === '') {
                var message = selectMessageString('error', locale, 'billing_first_name_required');
                $('#billing_first_name').addClass('field-error');
                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }
            if ($('#billing_last_name').val() === '') {
                var message = selectMessageString('error', locale, 'billing_last_name_required');
                $('#billing_last_name').addClass('field-error');
                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }

            var billing_phone_no = $('#billing_phone_no').val();

            if (billing_phone_no === '' || billing_phone_no.length < 13) {
                var message = selectMessageString('error', locale, 'billing_phoneno_required');
                $('#billing_phone_no').addClass('field-error');
                $('#alert').hide();
                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }

            if ($('#billing_full_address').val() === '') {
                var message = selectMessageString('error', locale, 'billing_full_address');
                $('#billing_full_address').addClass('field-error');
                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }

            if ($('#billing_city').val() === '') {
                var message = selectMessageString('error', locale, 'billing_city');

                $('#addbilling_city button').addClass('field-error');

                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }
            if ($('#billing_state').val() === '') {
                var message = selectMessageString('error', locale, 'billing_state');
                $('#billing_state').addClass('field-error');
                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }
            if ($("#billing_zipcode").val() === '') {
                var message = selectMessageString('error', locale, 'billing_zipcode');
                $('#billing_zipcode').addClass('field-error');
                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }
            var zipcode = $('#billing_zipcode').val();
            if (zipcode.length < 5) {
                var message = selectMessageString('error', locale, 'billing_zipcode_limit');
                $('#billing_zipcode').addClass('field-error');
                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }
            if ($('#billing_country').find(":selected").text() === '') {
                var message = selectMessageString('error', locale, 'billing_country');
                $('#billing_country').addClass('field-error');
                $('#message').show();
                $('#message').html(message);
                $(window).scrollTop(0);
                return false;
            }

        }

        $('#checkout').submit();
    }

});

$(document).on("focusout", "#f_name", function () {

    var f_name = $('#f_name').val();
    var shipping_first_name = $('#shipping_first_name').val();
    var billing_first_name = $('#billing_first_name').val();

    if (shipping_first_name === '0' || shipping_first_name === '' || shipping_first_name === NaN || shipping_first_name === undefined) {
        $('#shipping_first_name').val(f_name);
    }
    if (billing_first_name === '0' || billing_first_name === '' || billing_first_name === NaN || billing_first_name === undefined) {
        $('#billing_first_name').val(f_name);
    }

});
$(document).on("focusout", "#l_name", function () {

    var l_name = $('#l_name').val();
    var shipping_last_name = $('#shipping_last_name').val();
    var billing_last_name = $('#billing_last_name').val();

    if (billing_last_name === '0' || billing_last_name === '' || billing_last_name === NaN || billing_last_name === undefined) {
        $('#billing_last_name').val(l_name);
    }
    if (shipping_last_name === '0' || shipping_last_name === '' || shipping_last_name === NaN || shipping_last_name === undefined) {
        $('#shipping_last_name').val(l_name);
    }

});


$(document).on("change", "#shipping_country", function () {

    var shipping_country = $('#shipping_country').val();
    var billing_country = $('#billing_country').val();

    if (billing_country === '0' || billing_country === '' || billing_country === NaN || billing_country === undefined) {
        $('#billing_country').val(shipping_country);
    }


});
$(document).on("change", "#shipping_city", function () {

    var shipping_city =  $('#shipping_city').val();
    var billing_city = $('#billing_city').val();

    if (billing_city === '0' || billing_city === '' || billing_city === NaN || billing_city === undefined) {
        $('#billing_city').find('option[value="'+ shipping_city +'"]').attr("selected",true);
        $dropdown = $('select').prettyDropdown();
        $dropdown.refresh();
    }


});


$(document).on("focusout", "#shpping_full_address", function () {

    var shpping_full_address = $('#shpping_full_address').val();
    var billing_full_address = $('#billing_full_address').val();

    if (billing_full_address === '0' || billing_full_address === '' || billing_full_address === NaN || billing_full_address === undefined) {
        $('#billing_full_address').val(shpping_full_address);
    }


});
$(document).on("focusout", "#shipping_zipcode", function () {

    var shipping_zipcode = $('#shipping_zipcode').val();
    var billing_zipcode = $('#billing_zipcode').val();

    if (billing_zipcode === '0' || billing_zipcode === '' || billing_zipcode === NaN || billing_zipcode === undefined) {
        $('#billing_zipcode').val(shipping_zipcode);
    }


});

$(document).on("focusout", "#shipping_state", function () {
    var shipping_state = $('#shipping_state').val();
    var billing_state = $('#billing_state').val();

    if (billing_state === '0' || billing_state === '' || billing_state === NaN || billing_state === undefined) {
        $('#billing_state').val(shipping_state);
    }


});

$(document).on("click", "#checkboxBilling", function () {
    var checkboxBilling = $('#checkboxBilling').val();

    if (checkboxBilling == 0) {
        $(".billingDev").slideUp("slow");
        $('#checkboxBilling').val(1);
        $('#is_same_billing').val(1);
        $('#checkboxBilling').prop('checked', true);
    } else {
        $(".billingDev").slideDown("slow");
        $('#checkboxBilling').val(0);
        $('#is_same_billing').val(0);
        $('#checkboxBilling').prop('checked', false);
    }

});



// $(document).on("focusout", "#phone_no", function () {
//
//
//     var phone_no = $('#phone_no').val();
//
//
//     var countryData = window.intlTelInputGlobals.getCountryData(),
//         input = document.querySelector("#phone"),
//         addressDropdown = document.querySelector("#address-country");
//
// // init plugin
//     var iti = window.intlTelInput(input, {
//         utilsScript: "../../build/js/utils.js?1562189064761" // just for formatting/placeholders etc
//     });
//
//
//     var input = document.querySelector("#shipping_phone_no");
//     window.intlTelInput(input).setNumber(phone_no);
//
//     // var countryData = window.intlTelInputGlobals.getCountryData(),
//     //     input = document.querySelector("#phone_no");
//     //
//     // for (var i = 0; i < countryData.length; i++) {
//     //     var country = countryData[i];
//     //     country.name = country.name.replace(/.+\((.+)\)/,"$1");
//     // }
//     //
//     //
//     // window.intlTelInput(input, {
//     //     // utilsScript: "../../build/js/utils.js?1562189064761" // just for formatting/placeholders etc
//     //     utilsScript: "../build/js/utils.js",
//     // });
//
//     console.log(country);
//     return false ;
//
//
//     console.log(phone_no_country);
//     return false ;
//
//     var input = document.querySelector("#phone_no");
//     // var number = window.intlTelInput(input).getNumber();
//     var number = input.getSelectedCountryData();
//
//
//     // var iti = $('#phone_no').intlTelInput();
//     // var number = iti.getNumber();
//
//     // var inputs =   input.getNumber();
//
//     // alert(number);
//     console.log(number);
//     return false ;
//     var input = document.querySelector("#shipping_phone_no");
//     window.intlTelInput(input).setNumber('+447733123456');
//
//     // window.intlTelInput(input, {
//     //     formatOnDisplay: false,
//     //     separateDialCode: true,
//     //     utilsScript: "build/js/utils.js", });
//
//     // setTimeout(() => { window.intlTelInput(input).setNumber('+447733123456'); }, 2000);
//     // $("#shipping_phone_no").intlTelInput("selectCountry", "pk");
//
//     // $("#shipping_phone_no").intlTelInput("setNumber","+447733312345");
//
//
//
//     // var input = document.querySelector("#shipping_phone_no")
//     // // initialise plugin
//     //  var iti = $(this).intlTelInput(input, {
//     //      utilsScript: "http://localhost/cleanuphomes-web/public/js/utils.js"
//     //  });
//
// return false ;
//
//    var countryData = iti.getSelectedCountryData();
//
//     console.log(countryData);
//     // var iti = $('#phone_no').intlTelInput();
//
//     // var number = iti.getNumber();
//
//     // console.log('countryData',number);
//   //  return false ;
//
//     // var iti =  $("#phone_no").intlTelInputGlobals.getCountryData();
//     // var iti =  $("#shipping_phone_no").intlTelInput("selectCountry", "pk");
//
//     $("#shipping_phone_no").val("+447733312345");
//     $("#shipping_phone_no").intlTelInput("setNumber","+447733312345");
//
//
//     // var countryData = window.intlTelInput('getCountryData'),
//     //     input = document.querySelector("#phone_no");
//     //
//     // for (var i = 0; i < countryData.length; i++) {
//     //     var country = countryData[i];
//     //     country.name = country.name.replace(/.+\((.+)\)/,"$1");
//     // }
//
//     // console.log('countryData',input);
//     return false ;
//
//
//     // var phone_no =  $("#phone_no").intlTelInput();
//     // var iti =  $("#phone_no").intlTelInput("getSelectedCountryData").dialCode;
//
//     //  var iti = $('#shipping_phone_no').intlTelInput({
//     //     // container: 'body',
//     //     defaultCountry: "auto",
//     //
//     //     utilsScript: "https://rawgit.com/Bluefieldscom/intl-tel-input/master/lib/libphonenumber/build/utils.js"
//     // });
//     //
//     // var iti =  $("#shipping_phone_no").intlTelInput("setNumber","+1 7024181234");
//     console.log('countryData',iti);
//     return false ;
//
//     $("#shipping_phone_no").intlTelInput({});
//
//     $('#shipping_phone_no').intlTelInput('refresh');
//
//     $("#shipping_phone_no").intlTelInput("selectCountry", "pk");
//
//     var iti =  $("#shipping_phone_no").intlTelInput({}).setNumber('+447733123456');
//
//
//     $("#phone_no").intlTelInput("getSelectedCountryData").name;
//
//
//
//
//     // var input = document.querySelector("#phone");
//     // window.intlTelInput(input, {
//     //     formatOnDisplay: false,
//     //     separateDialCode: true,
//     //     utilsScript: "build/js/utils.js", });
//     // setTimeout(() => { window.intlTelInput(input).setNumber('+447733123456'); }, 2000);
//     //
//
//     // var intlNumber = $("#phone_no").intlTelInput("getNumber"); // get full number eg +17024181234
//
//     // var countryData = $("#phone_no").intlTelInput("getSelectedCountryData"); // get country data as obj
//
//
//
//     // var countryCode = countryData.dialCode; // using updated doc, code has been replaced with dialCode
//     // countryCode = "+" + countryCode; // convert 1 to +1
//
//     // var newNo = intlNumber.replace(countryCode, "(" + coountryCode+ ")" );
//
//     console.log('countryData',iti);
//     return false ;
//
//     console.log('input1',iti);
//     return false ;
//
//
//
//     console.log('input1',iti);
//     return false ;
//
//
//     console.log('iti',iti);
//
//     return false ;
//     $("#shipping_phone_no").intlTelInput("selectCountry", "pk");
//
//     // $("#shipping_phone_no").intlTelInput({utilsScript: "../js/utils.js"});
//
//     // $("#shipping_phone_no").intlTelInput("setNumber", phone_no);
//
//     $('#shipping_phone_no').val(phone_no);
//
//     // $("#shipping_phone_no").intlTelInput({
//     //     defaultCountry: "auto",
//     //     utilsScript: "../js/utils.js"
//     // });
//     //
//     // $("#shipping_phone_no").intlTelInput({
//     //     setNumber: phone_no,
//     //     utilsScript: "../js/utils.js"
//     // });
//
//     alert(phone_no);
//     return false ;
//
//     //     var shipping_phone_no = $('#shipping_phone_no').val();
//     // var billing_phone_no = $('#billing_phone_no').val();
//     //
//     // if (shipping_phone_no === '0' || shipping_phone_no === '' || shipping_phone_no === NaN || shipping_phone_no === undefined) {
//     //     $('#shipping_phone_no').val(phone_no);
//     // }
//     // if (billing_phone_no === '0' || billing_phone_no === '' || billing_phone_no === NaN || billing_phone_no === undefined) {
//     //     $('#billing_phone_no').val(phone_no);
//     //
//     // }
//
// });



$(document).on("click", "#show_payment_form", function () {

    var phone = $('#phone_no').val();
    var user_login_flag = $('#user_login_flag').val();
    var regex_email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    $('#f_name').removeClass('field-error');
    $('#l_name').removeClass('field-error');
    $('#email-1').removeClass('field-error');
    $('#phone_no').removeClass('field-error');
    $('#shipping_first_name').removeClass('field-error');
    $('#billing_country').removeClass('field-error');
    $('#shipping_last_name').removeClass('field-error');
    $('#shipping_phone_no').removeClass('field-error');
    $('#shpping_full_address').removeClass('field-error');
    $('#shipping_city').removeClass('field-error');
    $('#shipping_state').removeClass('field-error');
    $('#shipping_zipcode').removeClass('field-error');
    $('#shipping_zipcode').removeClass('field-error');
    $('#shipping_country').removeClass('field-error');
    $('#billing_first_name').removeClass('field-error');
    $('#billing_last_name').removeClass('field-error');
    $('#billing_phone_no').removeClass('field-error');
    $('#billing_full_address').removeClass('field-error');
    $('#billing_city').removeClass('field-error');
    $('#billing_state').removeClass('field-error');
    $('#billing_zipcode').removeClass('field-error');
    $('#billing_country').removeClass('field-error');
    $('#addshipping_city button').removeClass('field-error');
    $('#addbilling_city button').removeClass('field-error');


    if (user_login_flag == 0) {
        if ($('#f_name').val() === '') {
            var message = selectMessageString('error', locale, 'first_name_required');
            $('#f_name').addClass('field-error');
            // $('#f_name').addClass('redborder');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
        if ($('#l_name').val() === '') {
            var message = selectMessageString('error', locale, 'last_name_required');
            $('#l_name').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
        if ($('#email-1').val() === '' || !regex_email.test($('#email-1').val())) {
            var message = selectMessageString('error', locale, 'email_required');
            $('#email-1').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }

        if (phone === '' || phone.length < 13) {
            var message = selectMessageString('error', locale, 'phoneno_required');
            $('#phone_no').addClass('field-error');
            $('#alert').hide();
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
    }

    if ($('#shipping_first_name').val() === '') {
        var message = selectMessageString('error', locale, 'shipping_first_name_required');
        $('#shipping_first_name').addClass('field-error');
        $('#message').show();
        $('#message').html(message);
        $(window).scrollTop(0);
        return false;
    }
    if ($('#shipping_last_name').val() === '') {
        var message = selectMessageString('error', locale, 'shipping_last_name_required');
        $('#shipping_last_name').addClass('field-error');
        $('#message').show();
        $('#message').html(message);
        $(window).scrollTop(0);
        return false;
    }

    var shipping_phone_no = $('#shipping_phone_no').val();

    if (shipping_phone_no === '' || shipping_phone_no.length < 13) {
        var message = selectMessageString('error', locale, 'shipping_phoneno_required');
        $('#shipping_phone_no').addClass('field-error');
        $('#alert').hide();
        $('#message').show();
        $('#message').html(message);
        $(window).scrollTop(0);
        return false;
    }

    if ($('#shpping_full_address').val() === '') {
        var message = selectMessageString('error', locale, 'shpping_full_address');
        $('#shpping_full_address').addClass('field-error');
        $('#message').show();
        $('#message').html(message);
        $(window).scrollTop(0);
        return false;
    }

    if ($('#shipping_city').val() === '') {

        var message = selectMessageString('error', locale, 'shipping_city');
        // $('#addshipping_city button').addClass('field-error');
        $('#prettydropdown-shipping_city>ul').addClass('field-error');
        $('#message').show();
        $('#message').html(message);
        $(window).scrollTop(0);
        return false;
    }
    if ($('#shipping_state').val() === '') {
        var message = selectMessageString('error', locale, 'shipping_state');
        $('#shipping_state').addClass('field-error');
        $('#message').show();
        $('#message').html(message);
        $(window).scrollTop(0);
        return false;
    }
    if ($("#shipping_zipcode").val() === '') {
        var message = selectMessageString('error', locale, 'shipping_zipcode');
        $('#shipping_zipcode').addClass('field-error');
        $('#message').show();
        $('#message').html(message);
        $(window).scrollTop(0);
        return false;
    }
    var zipcode = $('#shipping_zipcode').val();
    if (zipcode.length < 5) {
        var message = selectMessageString('error', locale, 'shipping_zipcode_limit');
        $('#shipping_zipcode').addClass('field-error');
        $('#message').show();
        $('#message').html(message);
        $(window).scrollTop(0);
        return false;
    }
    if ($('#shipping_country').find(":selected").text() === '') {
        var message = selectMessageString('error', locale, 'shipping_country');
        $('#shipping_country').addClass('field-error');
        $('#message').show();
        $('#message').html(message);
        $(window).scrollTop(0);
        return false;
    }

    var is_same_billing = $('#is_same_billing').val();

    if (is_same_billing == '0') {

        if ($('#billing_first_name').val() === '') {
            var message = selectMessageString('error', locale, 'billing_first_name_required');
            $('#billing_first_name').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
        if ($('#billing_last_name').val() === '') {
            var message = selectMessageString('error', locale, 'billing_last_name_required');
            $('#billing_last_name').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }

        var billing_phone_no = $('#billing_phone_no').val();

        if (billing_phone_no === '' || billing_phone_no.length < 13) {
            var message = selectMessageString('error', locale, 'billing_phoneno_required');
            $('#billing_phone_no').addClass('field-error');
            $('#alert').hide();
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }

        if ($('#billing_full_address').val() === '') {
            var message = selectMessageString('error', locale, 'billing_full_address');
            $('#billing_full_address').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }

        if ($('#billing_city').val() === '') {
            var message = selectMessageString('error', locale, 'billing_city');

            // $('#addbilling_city button').addClass('field-error');

            $('#prettydropdown-billing_city>ul').addClass('field-error');

            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
        if ($('#billing_state').val() === '') {
            var message = selectMessageString('error', locale, 'billing_state');
            $('#billing_state').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
        if ($("#billing_zipcode").val() === '') {
            var message = selectMessageString('error', locale, 'billing_zipcode');
            $('#billing_zipcode').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
        var zipcode = $('#billing_zipcode').val();
        if (zipcode.length < 5) {
            var message = selectMessageString('error', locale, 'billing_zipcode_limit');
            $('#billing_zipcode').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }
        if ($('#billing_country').find(":selected").text() === '') {
            var message = selectMessageString('error', locale, 'billing_country');
            $('#billing_country').addClass('field-error');
            $('#message').show();
            $('#message').html(message);
            $(window).scrollTop(0);
            return false;
        }

    }

    $("#show_payment_form").attr("disabled", true);
    $('#checkout').submit();
});

$(document).on("click", "#edit_shhipping_details", function () {
    $(this).addClass('dn');
    $('#show_payment_form').show();
    $('#checkout_details').addClass('dn');
    $('#submit').hide();
    $('#h_shipping').show();
    $('#f_shipping').show();
    $('#h_payment').addClass('dn');
    $('#f_payment').addClass('dn');
});


$(document).on("click", "#checkboxG98", function () {
    $('#checkboxG99').prop('checked', false); // Unchecks it
    $('#checkboxG98').prop('checked', true); // checks it
    if (locale == 'ar') {
        $('#show_payment_form').html('مكان الامر');
    } else {
        $('#show_payment_form').html('Place Order');
    }


});

$(document).on("click", "#checkboxG99", function () {
    $('#checkboxG98').prop('checked', false); // Unchecks it
    $('#checkboxG99').prop('checked', true); // Unchecks it
    if (locale == 'ar') {
        $('#show_payment_form').html(' متابعة الدفع');
    } else {
        $('#show_payment_form').html('Continue to Payment');
    }

});

