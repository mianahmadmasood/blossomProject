/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function () {
        readURL(this);
    });

    $("#editProfile").on("click", function (e) {
        e.preventDefault();
        $('#editProfileForm').show();
        $('.profileInfo').hide();
    });
    $("#editProfileMenu").on("click", function (e) {
        e.preventDefault();
        $('#editProfileForm').show();
        $('.profileInfo').hide();
    });
    $("#editProfileLink").on("click", function (e) {
        e.preventDefault();
        $('#editProfileForm').hide();
        $('.profileInfo').show();
    });

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
});

$(document).on("click", "#profileAddress", function () {

    var zipcode = $('#address_zip_code').val();
    if( zipcode.length < 5) {
        var message = selectMessageString('error', locale, 'shipping_zipcode_limit');
        $('#alert').hide();
        $('#message').show();
        $('#message').html(message);
        return false;
    }

});
