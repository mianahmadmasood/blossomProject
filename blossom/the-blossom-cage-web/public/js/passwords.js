/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$(document).ready(function () {

    $("#sub_f_pass").on("keypress", function (event) {
        if (event.keyCode === 13) {
            forgetPasswordajax();
        }
    });$("#email").on("keypress", function (event) {
        if (event.keyCode === 13) {
            forgetPasswordajax();
        }
    });
    $("#forgot_modal").on("keypress", function (event) {
        if (event.keyCode === 13) {
            forgetPasswordajax();
        }
    });

    $("#changePassword").on("click", function (e) {
        e.preventDefault();
        var old_password = $('#old_password').val();
        var new_password = $('#new_password').val();
        var confirm_password = $('#con_password').val();

        if (old_password === '') {
            var message = selectMessageString('error', locale, 'old_password');
            $('#message_password').html(message);
            $('#message_password').show();
            return;
        }
        if (confirm_password === '') {
            var message = selectMessageString('error', locale, 'confirm_password');
            $('#message_password').html(message);
            $('#message_password').show();
            return;
        }
        if (new_password === '') {
            var message = selectMessageString('error', locale, 'new_password');
            $('#message_password').html(message);
            $('#message_password').show();
            return;
        }

        if (new_password !== confirm_password) {
            var message = selectMessageString('error', locale, 'confirm_same');
            $('#message_password').html(message);
            $('#message_password').show();
            return;
        }
        $('#chanepasswordform').submit();


    });

    $("#sub_f_pass").on("click", function (e) {
        e.preventDefault();
        forgetPasswordajax();

    });
});
 function forgetPasswordajax() {
     var token = $('meta[name=csrf-token]').attr("content");
     if (token === '' || token == 'NaN' || token === undefined) {
         window.location.reload();
     }
     var email = $("#email").val();
     $('#f_loader_button').removeClass('dn');
     $.ajax({
         type: "post",
         url: baseUrl + locale + "/users/password/forgot",
         data: {_token: token, email: email},

         success: function (result) {

             if (result.success === true) {
                 $('#f_loader_button').addClass('dn');
                 window.location.href = baseUrl + locale + '/users/password/reset';

             } else if (result.success === false) {
                 $('#f_loader_button').addClass('dn');
                 $('#signup_message').html(result.message);
                 $('#signup_alert').removeClass('dn');
             }else if(result.indexOf('<') > -1){
                 window.location.reload();
             }
         },
         error: function (result) {
             $('#f_loader_button').addClass('dn');
             $('#message').html(result.message);
             $('#p_message').removeClass('dn');
         }
     });
 }
