/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(window).on("load", function () {
    $.ajax({
        cache: false,
        type: "GET",
        url: baseUrl + locale + "/cart/get",
        success: function (result) {
            if (result.success === true) {
                $(".navbar-cart-product-wrapper").html('');
                $(".navbar-cart-product-wrapper").html(result.data.html);
            }
            if (result.data.total_items === 0) {
                $(".ccounter").addClass('dn');
                $(".ccounter").html('');
            } else {
                $(".ccounter").html(result.data.total_items);
            }
            if (currency === 'USD') {
                $("#total").html("$" + result.data.total);
            } else {
                $("#total").html("SAR " + result.data.total);
            }

        },
        error: function () {
        }
    });
});