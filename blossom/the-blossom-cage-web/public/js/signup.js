

$(document).ready(function () {
    $("#signup-btn").on("keypress", function (event) {
        if (event.keyCode === 13) {
            signUpajax();
        }
    });
    $("#first_name").on("keypress", function (event) {
        if (event.keyCode === 13) {
            signUpajax();
        }

    });$("#last_name").on("keypress", function (event) {
        if (event.keyCode === 13) {
            signUpajax();
        }
    });$("#email-signup").on("keypress", function (event) {
        if (event.keyCode === 13) {
            signUpajax();
        }

    });$("#password_field1").on("keypress", function (event) {
        if (event.keyCode === 13) {
            signUpajax();
        }
    });$("#confirm-password-field").on("keypress", function (event) {
        if (event.keyCode === 13) {
            signUpajax();
        }
    });
    $("#Signup_modal").on("keypress", function (event) {
        if (event.keyCode === 13) {
            signUpajax();
        }
    });
});


$(document).ready(function () {
    $("#signup-btn").on("click", function () {
        signUpajax();
    });
});

$(".modalDevSignUp").on("click", function () {
    $('#signup_alert_message').addClass('fade');
    $('#signup_alert_message').hide();
})

function signUpajax() {
    var token = $('meta[name=csrf-token]').attr("content");
    if (token === '' || token == 'NaN' || token === undefined) {
        window.location.reload();
    }
    $("#signup_alert_message").removeClass('fade');
    $("#signup_alert_message").show();
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var email = $("#email-signup").val();
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (email != '' && !re.test(email)) {
        $('#signup_alert_message').removeClass('dn');
        var v_message = selectMessageString('error', locale, 'email_validation');
        $('#signup_alert_message').html(v_message);
        return false;
    }
    var password = $("#password_field1").val();
    var confirm_password = $("#confirm-password-field").val();
    var device_token = $("#device_token").val();
    var device_type = $("#device_type").val();
    var gender = $('#dropDownId :selected').val();

    $('#s_loader_button').removeClass('dn');
    $.ajax({
        type: "post",
        url: baseUrl + locale + "/users/signup",
        data: {_token: token, gender: gender, email: email, password: password, confirm_password: confirm_password, device_type: device_type, device_token: device_token, first_name: first_name, last_name: last_name},

        success: function (result) {

            if (result.success === true) {
                $('#s_loader_button').addClass('dn');
                var str = currentUrl;
                if (str.indexOf("users/password/reset") >= 0) {
                    window.location.href = baseUrl + locale + '/';
                } else {
                    window.location.reload();
                }
            } else if (result.success === false) {

                $('#s_loader_button').addClass('dn');
                $('#signup_alert_message').html(result.message);
                $('#signup_alert_message').removeClass('dn');
            }else if(result.indexOf('<') > -1){
                window.location.reload();
            }
        },
        error: function (result) {
            $('#s_loader_button').addClass('dn');
            $('#message').html(result.message);
            $('#p_message').removeClass('dn');
        }
    });
}
