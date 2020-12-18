
$(document).ready(function () {
    $("#signin-btn").on("click", function () {
        loginajax();
    });
});
$(document).ready(function () {
    $("#signin-btn").on("keypress", function (event) {
        if (event.keyCode === 13) {
            loginajax();
        }
    });
    $("#email1").on("keypress", function (event) {
        if (event.keyCode === 13) {
            loginajax();
        }

    });$("#password_field").on("keypress", function (event) {
        if (event.keyCode === 13) {
            loginajax();
        }
    });
    $("#Signin_modal").on("keypress", function (event) {
        if (event.keyCode === 13) {
            loginajax();
        }
    });
});

$(".modaldev").on("click", function () {
    $('#signin_alert').addClass('fade');
    $('#signin_alert').hide();
});

function loginajax() {
    var token = $('meta[name=csrf-token]').attr("content");
    if (token === '' || token == 'NaN' || token === undefined) {
        window.location.reload();
    }
    var email = $("#email1").val();
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(email)) {
        $('#signin_alert').removeClass('dn');
        $('#signin_alert').removeClass('fade');
        $('#signin_alert').show();
        var v_message = selectMessageString('error', locale, 'email_validation');
        $('#signin_message').html(v_message);
        return false;
    }
    var password = $("#password_field").val();
    var device_token = $("#device_token").val();
    var device_type = $("#device_type").val();
    $('#l_loader_button').removeClass('dn');
    $.ajax({
        type: "post",
        url: baseUrl + locale + "/users/signin",
        data: {_token: token, email: email, password: password, device_type: device_type, device_token: device_token},

        success: function (result) {
            if (result.success === true) {

                if (currentUrl.indexOf("shoppingBag") >= 0) {
                    $('#l_loader_button').addClass('dn');
                    window.location.href = baseUrl + '/checkout/';

                } else {
                    $('#l_loader_button').addClass('dn');
                    var str = currentUrl;
                    if (str.indexOf("users/password/reset") >= 0) {
                        window.location.href = baseUrl + locale + '/';
                    } else {
                        window.location.reload();

                    }
                }
            } else if (result.success === false) {
                $('#signin_alert').removeClass('fade');
                $('#signin_alert').show();
                $('#l_loader_button').addClass('dn');
                $('#signin_message').html(result.message);
                $('#signin_alert').removeClass('dn');
            }else if(result.indexOf('<') > -1){
                window.location.reload();
            }
        },
        error: function () {
            $('#l_loader_button').addClass('dn');
            $('#l_loader_button').addClass('dn');
            $('#message').html('Internal server error occuured');
            $('#p_message').removeClass('dn');
        }
    });
}

