/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {


    $("#submitFeed").on('click', function (e) {


        e.preventDefault();
        var name_contact = $("#name_contact").val();
        var email_contact = $("#email_contact").val();
        var message_contact = $("#message_contact").val();
        if (name_contact === '') {
            if (locale === 'ar') {
                var message = 'يرجى تقديم اسمك حتى نتمكن من الاتصال بك في وقت لاحق';
            } else {
                var message = 'Please provide your name so that we can contact you later.';
            }
            $('#succcess_message_c').hide();
//            $('#myForm')[0].reset();
            $('#error_message_c').show();
            $('#messag_p_e').html(message);
            return;
        }
        if (email_contact === '' || !validateEmail(email_contact)) {
            if (locale === 'ar') {
                var message = 'يرجى تقديم بريد إلكتروني صالح حتى نتمكن من الاتصال بك في وقت لاحق';
            } else {
                var message = 'Please provide a valid email so that we can contact you later.';
            }
            $('#succcess_message_c').hide();
//            $('#myForm')[0].reset();
            $('#error_message_c').show();
            $('#messag_p_e').html(message);

            return;
        }


        var token = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: "post",
            url: baseUrl + locale + "/users/contact/store",
            data: {_token: token, email: email_contact, feedback: message_contact, name: name_contact},

            success: function (result) {

                if (result.success === true) {
                    $('#error_message_c').hide();
                    $('#myForm')[0].reset();
                    $('#succcess_message_c').show();
                    $('#messag_p_s').html(result.message);


                } else if (result.success === false) {
//                    $('#myForm')[0].reset();
                    $('#error_message_c').show();
                    $('#succcess_message_c').hide();
                    $('#messag_p_e').html(result.message);

                }
            },
            error: function (result) {
//                $('#myForm')[0].reset();
                $('#error_message_c').show();
                $('#messag_p_e').html(result.message);

            }
        });

    });
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
});


