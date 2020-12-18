$(document).ready(function () {

    // $(document).on("click", ".accessoriesSelected,.css-label,.radGroup1", function () {
    //       if ($(this).closest('a').hasClass("selecteds")) {
    //         $(this).closest('a').removeClass('selecteds');
    //     }else {
    //           $(this).closest('a').addClass('selecteds');
    //     }
    // });

    $(document).on("click", ".accessoriesSelected", function () {
        if ($(this).hasClass("selecteds")) {
            $(this).removeClass('selecteds');
            $(this).find('i').remove();
            $(this).append(' <i class=" selected ACcheck ok">\n' +
                '<img src=" ' + baseUrl + 'public/assets/images/cUncheck-green.png"></i>\n');
        }else {
            $(this).addClass('selecteds');
            $(this).append(' <i class=" selected ACcheck ok">\n' +
                '<img src=" ' + baseUrl + 'public/assets/images/cCheck-green.png"></i>\n');
        }
    });

    $("#addToBag,.addToBagValue").on("click", function () {
        // $('#message_already_in_cart').remove();
        var colorvalue= $('i.activeNew').data('value');
        if (colorvalue === '' || colorvalue === 'NaN' || colorvalue == undefined) {
            $('#itemcolorAdderrormassage').show();
            return false ;
            var color_quantity = null;
                var color_id = null;
                var color_name = null;
                var color_item_id = null;
                var color_item_variant_id = null;
                var color_code = null;
                var color_image = null;
        }else{
            $('#itemcolorAdderrormassage').hide();
                var color_quantity = $("#color_quantity_" + colorvalue).val();
                var color_id = $("#color_id_" + colorvalue).val();
                var  color_name = $("#color_name_" + colorvalue).val();
                var color_item_id = $("#color_item_id_" + colorvalue).val();
                var color_item_variant_id = $("#color_item_variant_id_" + colorvalue).val();
                var color_code = $("#color_code_" + colorvalue).val();
                var color_image = $("#color_image_" + colorvalue).val();
        }
        var itemAccessoiresValue = $(".selecteds").map(function(){
            return $(this).attr('data-value');
        }).get();
        var title = $("#title").val();
        var price = $("#price").attr("data-value");
        var undiscounted_price = $("#undiscounted_price").val();
        var undiscounted_converted_price = $("#undiscounted_converted_price").val();
        var datacategory = $(this).attr('data-category');
        var slug = $("#slug").val();
        var image = $("#image").val();
        var total = $("#total").attr('data-value');
        var uid = $("#uuid").val();
        var ar_title = $("#ar_title").val();
        var en_title = $("#en_title").val();
        var weight = $("#weight").val();
        var weight_unit = $("#weight_unit").val();

        var lenght = $("#lenght").val();
        var height = $("#height").val();
        var width = $("#width").val();
        var orientation_unit = $("#orientation_unit").val();

        var cart_quantity = $("#cart_quantity").val();
        var quantity = 1;
        var token = $('meta[name=csrf-token]').attr("content");
        $('#loader-btn').removeClass('dn');
        $.ajax({
            type: "post",
            url: baseUrl + locale + "/cart/store",
            data: {_token: token,
                title: title,
                price: price,
                slug: slug,
                image: image,
                quantity: quantity,
                total: total,
                uuid: uid,
                en_title: en_title,
                ar_title: ar_title,
                weight: weight,
                weight_unit: weight_unit,

                lenght: lenght,
                height: height,
                width: width,
                orientation_unit: orientation_unit,

                cart_quantity: cart_quantity,
                undiscounted_price:undiscounted_price,
                undiscounted_converted_price: undiscounted_converted_price,
                color_id: color_id,
                color_name: color_name,
                color_item_id: color_item_id,
                color_item_variant_id: color_item_variant_id,
                color_quantity: color_quantity,
                color_code: color_code,
                color_image: color_image,
                itemAccessoires: itemAccessoiresValue
            },
            success: function (result) {
                if (result.success === true && result.status_code === 200) {
                    // if (locale === 'ar') {
                    //     $('#addToBag').html('<i id="check" class="fa fa-check"></i> أضيف إلى السلة');
                    // } else {
                    //     $('#addToBag').html('<i id="check" class="fa fa-check"></i> ADDED TO CART');
                    // }
                    $('#loader-btn').addClass('dn');
                    $(".navbar-cart-product-wrapper").html('');
                    $(".navbar-cart-product-wrapper").html(result.data.html);
                    if (currency === 'USD') {
                        $("#total").html("$" + result.data.total);
                    } else {
                        $("#total").html("SAR " + result.data.total);
                    }
                    $(".ccounter").removeClass('dn');
                    $(".ccounter").html(result.data.total_items);

                    $(".navbar-cart-product-wrapper").html('');
                    $(".navbar-cart-product-wrapper").html(result.data.html);

                    showMessageCart(result.message, datacategory);
                } else if (result.success === true && result.status_code === 202) {
                    if (currency === 'USD') {
                        $("#total").html("$" + result.data.total);
                    } else {
                        $("#total").html("SAR " + result.data.total);
                    }
                    if (locale === 'ar') {
                        $('#addToBag').html('<i id="check" class="fa fa-check"></i> أضيف إلى السلة');
                    } else {
                        $('#addToBag').html('<i id="check" class="fa fa-check"></i> ADDED TO CART');
                    }
                    $(".ccounter").removeClass('dn');
                    $(".ccounter").html(result.data.total_items);
                    $('.navbar-cart-product-wrapper').empty();
                    $(".navbar-cart-product-wrapper").html('');
                    $(".navbar-cart-product-wrapper").html(result.data.html);
                    $('.ordererrormassage').html('');
                    $('.ordererrormassage').html('<p id="message_already_in_cart" style="color: red; font-size: 12px; margin-top: 3px;border-bottom: none; padding-to: 20px;"><b>' + result.message + '</b></p>');
                } else if (result.indexOf('<') > -1) {
                    window.location.reload();
                } else {
                    showMessageError(result.message);
                }

            },
            error: function (result) {
                showMessageError(result.message);

            }
        });
    });

    $("#addToBagUpdate").on("click", function () {
        var colorvalue= $('i.activeNew').data('value');
        if (colorvalue === '' || colorvalue === 'NaN' || colorvalue == undefined) {
            $('#itemcolorAdderrormassage').show();
            return false ;
            var color_quantity = null;
                var color_id = null;
                var color_name = null;
                var color_item_id = null;
                var color_item_variant_id = null;
                var color_code = null;
                var color_image = null;
        }else{
            $('#itemcolorAdderrormassage').hide();
                var color_quantity = $("#color_quantity_" + colorvalue).val();
                var color_id = $("#color_id_" + colorvalue).val();
                var  color_name = $("#color_name_" + colorvalue).val();
                var color_item_id = $("#color_item_id_" + colorvalue).val();
                var color_item_variant_id = $("#color_item_variant_id_" + colorvalue).val();
                var color_code = $("#color_code_" + colorvalue).val();
                var color_image = $("#color_image_" + colorvalue).val();
        }
        var title = $("#title").val();
        var price = $("#price").attr("data-value");
        var undiscounted_price = $("#undiscounted_price").val();
        var undiscounted_converted_price = $("#undiscounted_converted_price").val();
        var datacategory = $(this).attr('data-category');
        var slug = $("#slug").val();
        var image = $("#image").val();
        var total = $("#total").attr('data-value');
        var uid = $("#uuid").val();
        var ar_title = $("#ar_title").val();
        var en_title = $("#en_title").val();
        var weight = $("#weight").val();
        var weight_unit = $("#weight_unit").val();
        var cart_quantity = $("#cart_quantity").val();
        var quantity = 1;
        var token = $('meta[name=csrf-token]').attr("content");
        $('#loader-btn').removeClass('dn');
        $.ajax({
            type: "post",
            url: baseUrl + locale + "/cart/storeupdateitem",
            data: {_token: token,
                title: title,
                price: price,
                slug: slug,
                image: image,
                quantity: quantity,
                total: total,
                uuid: uid,
                en_title: en_title,
                ar_title: ar_title,
                weight: weight,
                weight_unit: weight_unit,
                cart_quantity: cart_quantity,
                undiscounted_price:undiscounted_price,
                undiscounted_converted_price: undiscounted_converted_price,
                color_id: color_id,
                color_name: color_name,
                color_item_id: color_item_id,
                color_item_variant_id: color_item_variant_id,
                color_quantity: color_quantity,
                color_code: color_code,
                color_image: color_image
            },
            success: function (result) {
                if (result.success === true && result.status_code === 200) {
                    if (locale === 'ar') {
                        $('#addToBag').html('<i id="check" class="fa fa-check"></i> أضيف إلى السلة');
                    } else {
                        $('#addToBag').html('<i id="check" class="fa fa-check"></i> ADDED TO CART');
                    }
                    $(".navbar-cart-product-wrapper").html('');
                    $(".navbar-cart-product-wrapper").html(result.data.html);
                    if (currency === 'USD') {
                        $("#total").html("$" + result.data.total);
                    } else {
                        $("#total").html("SAR " + result.data.total);
                    }
                    $(".ccounter").removeClass('dn');
                    $(".ccounter").html(result.data.total_items);
                    showMessageCart(result.message, datacategory);
                } else if (result.success === true && result.status_code === 202) {
                    if (currency === 'USD') {
                        $("#total").html("$" + result.data.total);
                    } else {
                        $("#total").html("SAR " + result.data.total);
                    }
                    if (locale === 'ar') {
                        $('#addToBag').html('<i id="check" class="fa fa-check"></i> أضيف إلى السلة');
                    } else {
                        $('#addToBag').html('<i id="check" class="fa fa-check"></i> ADDED TO CART');
                    }
                    $(".ccounter").removeClass('dn');
                    $(".ccounter").html(result.data.total_items);
                    $(".navbar-cart-product-wrapper").html('');
                    $(".navbar-cart-product-wrapper").html(result.data.html);
                    $('.ordererrormassage').html('');
                    $('.ordererrormassage').html('<p id="message_already_in_cart" style="color: red; font-size: 12px; margin-top: 3px;border-bottom: none; padding-to: 20px;"><b>' + result.message + '</b></p>');
                } else if (result.indexOf('<') > -1) {
                    window.location.reload();
                } else {
                    showMessageError(result.message);
                }

            },
            error: function (result) {
                showMessageError(result.message);

            }
        });
    });

    $(document).on("click", "#removeFromBag", function () {

        var uid = $(this).attr('data-value');
        var token = $('meta[name=csrf-token]').attr("content");
        if ($('#addToBag').length) {
            var uuid = $("#addToBag").attr('data-uid');
            if (uuid === uid) {
                var img = baseUrl + 'public/images/ajax-loader.gif';
                if (locale === 'ar') {
                    var html = '<i id="loader-btn" class="dn">' + '<img src="' + img + '" alt=""/> </i> أضف إلى السلة';
                } else {
                    var html = '<i id="loader-btn" class="dn">' + '<img src="' + img + '" alt=""/> </i> ADD TO CART';
                }
                $('#message_already_in_cart').hide();
                $('#addToBag').html(html);
            }
        }
        var event = $(this);
        $.ajax({
            type: "DELETE",
            url: baseUrl + locale + "/cart/delete",
            data: {_token: token, uuid: uid, flag: 'dropdown'},
            success: function (result) {

                if (result.success === true) {
                    event.closest(".navbar-cart-product").fadeOut('slow');
                    if (locale === 'ar') {
                        var html_ar = '<i id="loader-btn" class="dn">' + '<img src="' + img + '" alt=""/> </i> أضف إلى السلة';
                        $('#wishlist_addToCart'+uid).html(html);
                    } else {
                        var html_en = '<i id="loader-btn" class="dn">' + '<img src="' + img + '" alt=""/> </i> ADD TO CART';
                        $('#wishlist_addToCart'+uid).html(html_en);
                    }
                    if (locale === 'ar') {
                        var html_ar = '<i id="loader-btn" class="dn">' + '<img src="' + img + '" alt=""/> </i> أضف إلى السلة';
                        $('#addToBag').html(html);
                    } else {
                        var html_en = '<i id="loader-btn" class="dn">' + '<img src="' + img + '" alt=""/> </i> ADD TO CART';
                        $('#addToBag').html(html_en);
                    }

                    if (result.data.total_items === 0) {
                        if (locale === 'ar') {
                            $('.navbar-cart-product-wrapper').html('<strong class="d-block text-sm">عربة التسوق فارغة</strong>');
                        } else {
                            $('.navbar-cart-product-wrapper').html('<strong class="d-block text-sm">Your cart is empty </strong>');
                        }
                        $('.checkoutPage').hide();
                    }

                    if (currency === 'USD') {
                        $("#total").html("$" + result.data.total);
                    } else {
                        $("#total").html("SAR " + result.data.total);
                    }
                    if (result.data.total_items === 0) {
                        $(".ccounter").addClass('dn');
                        $(".ccounter").html('');
                    } else {
                        $(".ccounter").html(result.data.total_items);
                    }

                } else if (result.success === false) {
                    showMessageError(result.message);
                }
            },
            error: function (result) {
                showMessageError(result.message);
            }
        });
    });

    $(document).on("click", "#removeFromBag_card_alert", function (event) {
        var uid = $(this).attr('data-value');
        showMessageCartItemDelete(uid);
    });
    $(document).on("click", "#removeFromBag_card", function () {

        var falg = '';
        var uid = $(this).attr('data-value');
        var event = $(this);
        var url = window.location.href;
        var token = $('meta[name=csrf-token]').attr("content");
        if (url === baseUrl + 'cart') {
            falg = 'cart_pages'
        }
        if (url === baseUrl + 'checkout') {
            falg = 'checkout_page'
        }
        $.ajax({
            type: "DELETE",
            url: baseUrl + locale + "/cart/delete",
            data: {_token: token, uuid: uid, flag: falg},
            success: function (result) {
                if (result.success === true) {
                    $('.closeest_dev_'+uid).fadeOut('slow');
                    // event.closest("#parent_div").fadeOut('slow');
                    if (result.data.total_items === 0) {
                        var link = baseUrl + locale + "/products";
                        console.log(link);
                        if (locale === 'ar') {
                            $('#main_container').html('<p>سلة التسوق الخاصة بك فارغة, <a href="' + link + '">مواصلة التسوق</a></p>');
                        } else {
                            $('#main_container').html('<div class="col-md-12" style="    text-align: center; min-height: 200px;"> <p> Your shopping cart is empty, <a href="' + link + '">Continue Shopping</a></p></div>');
                        }
                        $('#checkoutPage').hide();
                    }
                    if (currency === 'USD') {
                        $('#total_price_' + uid).html("USD " + parseFloat(result.data.total_price).toFixed(2));
                        $('#sub_total').html("USD " + result.data.total);
                        $('#shipping_cost').html("USD " + result.data.shipping_cost);
                        $('#tax_amount').html("USD " + result.data.tax_amount);
                        var g_total = parseFloat(result.data.total) + parseFloat(result.data.shipping_cost) + parseFloat(result.data.tax_amount);
                        $('#grand_total').html("USD " + parseFloat(g_total).toFixed(2));
                    } else {
                        $('#total_price_' + uid).html("SAR " + parseFloat(result.data.total_price).toFixed(2));
                        $('#sub_total').html("SAR " + result.data.total);
                        $('#shipping_cost').html("SAR " + result.data.shipping_cost);
                        $('#tax_amount').html("SAR " + result.data.total);
                        var g_total = parseFloat(result.data.total) + parseFloat(result.data.shipping_cost) + parseFloat(result.data.tax_amount);
                        $('#grand_total').html("SAR " + parseFloat(g_total).toFixed(2));
                    }
                    $(".navbar-cart-product-wrapper").html('');
                    $(".navbar-cart-product-wrapper").html(result.data.html);
                    if (result.data.total_items === 0) {
                        $(".ccounter").addClass('dn');
                    }
                    $(".ccounter").html(result.data.total_items);
                } else if (result.success === false) {
                    showMessageError(result.message);
                }
            },
            error: function () {
                showMessageError(result.message);
            }
        });
    });

    $(document).on("click", ".removeFromBag_accessoires_card_for_alter", function (event) {
        var accessoriesId = $(this).attr('data-value');
        var uid = $(this).attr('data-value-uuid');
        showMessageCartItemAccessoiresDelete(accessoriesId,uid);
    });


    $(document).on("click", "#removeFromBag_accessoires_card", function () {


        var falg = '';
        var accessoriesId = $(this).attr('data-value');
        var uid = $(this).attr('data-value-uuid');
        var event = $(this);
        var url = window.location.href;
        var token = $('meta[name=csrf-token]').attr("content");
        if (url === baseUrl + 'cart') {
            falg = 'cart_pages'
        }
        if (url === baseUrl + 'checkout') {
            falg = 'checkout_page'
        }
        $.ajax({
            type: "DELETE",
            url: baseUrl + locale + "/cart/deleteAccessories",
            data: {_token: token, accessoriesId: accessoriesId,color_id:uid, flag: falg},
            success: function (result) {
                if (result.success === true) {

                    $('#accessoriesRows'+accessoriesId+'-'+uid).fadeOut('slow');
                    $('#accessoriesRows'+accessoriesId+'-'+uid).remove();
                    if (result.data.total_items === 0) {
                        var link = baseUrl + locale + "/products";
                        console.log(link);
                        if (locale === 'ar') {
                            $('#main_container').html('<p>سلة التسوق الخاصة بك فارغة, <a href="' + link + '">مواصلة التسوق</a></p>');
                        } else {
                            $('#main_container').html('<div class="col-md-12" style="    text-align: center; min-height: 200px;"> <p> Your shopping cart is empty, <a href="' + link + '">Continue Shopping</a></p></div>');
                        }
                        $('#checkoutPage').hide();
                    }
                    if (currency === 'USD') {
                        // $('#total_price_' + uid).html("USD " + parseFloat(result.data.total_price).toFixed(2));
                        $('#sub_total').html("USD " + result.data.total);
                        $('#shipping_cost').html("USD " + result.data.shipping_cost);
                        $('#tax_amount').html("USD " + result.data.tax_amount);
                        var g_total = parseFloat(result.data.total) + parseFloat(result.data.shipping_cost) + parseFloat(result.data.tax_amount);
                        $('#grand_total').html("USD " + parseFloat(g_total).toFixed(2));
                    } else {
                        // $('#total_price_' + uid).html("SAR " + parseFloat(result.data.total_price).toFixed(2));
                        $('#sub_total').html("SAR " + result.data.total);
                        $('#shipping_cost').html("SAR " + result.data.shipping_cost);
                        $('#tax_amount').html("SAR " + result.data.tax_amount);
                        var g_total = parseFloat(result.data.total) + parseFloat(result.data.shipping_cost) + parseFloat(result.data.tax_amount);
                        $('#grand_total').html("SAR " + parseFloat(g_total).toFixed(2));
                    }
                    $(".navbar-cart-product-wrapper").html('');
                    $(".navbar-cart-product-wrapper").html(result.data.html);
                    if (result.data.total_items === 0) {
                        $(".ccounter").addClass('dn');
                    }
                    $(".ccounter").html(result.data.total_items);
                } else if (result.success === false) {
                    showMessageError(result.message);
                }
            },
            error: function () {
                showMessageError(result.message);
            }
        });
    });

    $(document).on("change keyup", ".input-items", function (e) {
        var uid = $(this).attr('data-value');
        var maxvalue = parseInt($(this).attr('data-max'));
        var maxvaluecolor = parseInt($(this).attr('data-maxcolor'));
        var value = parseInt($(this).val());
        if (value == '' || value == 0 || isNaN(value) || value == "NaN") {
            $('.maxValueAlter' + uid).hide();
        } else {

            if (value != '' && value <= maxvaluecolor) {
                $('.maxValueAlter' + uid).hide();
                cartajaxcall(uid, value);
            } else {
                $('.maxValueAlter' + uid).show();
                if (locale == 'ar') {
                    $('.maxValueAlter' + uid).html('<span style=" color:red; float: left; width: 100%; text-align: right; margin: 0px 0 0 0;">القيم القصوى:' + maxvaluecolor + '</span>');

                } else {
                    $('.maxValueAlter' + uid).html('<span style=" color:red; float: left; width: 100%; text-align: left; margin: 0px 0 0 0;">Max:' + maxvaluecolor + '</span>');

                }
            }
        }


    });

    $(document).on("focusout", ".input-items", function (e) {

        var uid = $(this).attr('data-value');
        var value = parseInt($(this).val());
        var maxvalue = parseInt($(this).attr('data-max'));
        var maxvaluecolor = parseInt($(this).attr('data-maxcolor'));

        if (value === '' || isNaN(value) || value == "NaN" || value == undefined) {

            showMessage(selectMessageString('error', locale, 'quanity_one'));
            $(this).val(1);
            value = 1;
            $('.maxValueAlter' + uid).hide();

        } else if (value != '' && value > maxvaluecolor) {
            showMessage(selectMessageString('error', locale, 'quanity_max'));
            $(this).val(maxvaluecolor);
            value = maxvaluecolor;
            $('.maxValueAlter' + uid).hide();
        }

        cartajaxcall(uid, value);

    });

    $(document).on("click", '.itemcolorActive', function (e) {
        e.preventDefault();
        $('.itemcolorActive').removeClass('active');
        $('.itemcolorActive').removeClass('activeNew');
        $(this).addClass('activeNew');
        $(this).addClass('active');
        var colorNumber = $(this).data('value');
        var itemColorQty = $(this).data('qty');

        $('#firstbuttonValue').remove();
        // return false;
        if(itemColorQty === 0){
            $('#addtocartbuttonValue').hide();
            $('#outStockbuttonValue').show();
        }else{
            $('#addtocartbuttonValue').show();
            $('#outStockbuttonValue').hide();
        }

        var colorNameActive=$("#color_name_"+colorNumber).val();
        $("#colorName").html(colorNameActive);
    });
    $(document).on("click", '.itemeditcolor', function (e) {
        e.preventDefault();
        var itemSlug = $(this).data('value');
        var itemcolorName = $(this).data('value1');
        var urlitemcolor = $(this).data('href');
        var token = $('meta[name=csrf-token]').attr("content");
        $('#loader-btn').removeClass('dn');
        $.ajax({
            type: "post",
            url: baseUrl + locale + "/cart/itemeditcolor",
            data: {_token: token,
                itemSlug: itemSlug,
                itemcolorName: itemcolorName
            },
            success: function (result) {
                if (result.success === true) {
                    window.location = urlitemcolor;
                }else {
                    showMessageError(result.message);
                }

            },
            error: function (result) {
                showMessageError(result.message);

            }
        });
    });


});

function cartajaxcall(uid, value) {
    var token = $('meta[name=csrf-token]').attr("content");
    console.log('token',token);
    $.ajax({
        type: "POST",
        url: baseUrl + locale + "/cart/update",
        data: {_token: token, uuid: uid, quantity: value},
        success: function (result) {
            if (result.success === true) {
                if (currency === 'USD') {
                    $('#total_price_' + uid).html("USD " + parseFloat(result.data.total_price).toFixed(2));
                    $('#sub_total').html("USD " + result.data.total);
                    $('#shipping_cost').html("USD " + result.data.shipping_cost);
                    $('#tax_amount').html("USD " + result.data.tax_amount);
                    var g_total = parseFloat(result.data.total) + parseFloat(result.data.shipping_cost) + parseFloat(result.data.tax_amount);
                    $('#grand_total').html("USD " + parseFloat(g_total).toFixed(2));
                } else {
                    $('#total_price_' + uid).html("SAR " + parseFloat(result.data.total_price).toFixed(2));
                    $('#sub_total').html("SAR " + result.data.total);
                    $('.accessories_qty_'+uid).html(value);
                    var accessories_loop_lenght=$('#accesoires_counter'+uid).val();

                    for (let i = 0; i < accessories_loop_lenght; i++) {
                        var price= $("#total_price_accesoires_"+uid+'_'+i).attr('data-values');
                        var total_accesoires=(value * price);
                        $("#total_price_accesoires_"+uid+'_'+i).html(total_accesoires);

                    }

                    $('#shipping_cost').html("SAR " + result.data.shipping_cost);
                    $('#tax_amount').html("SAR " + result.data.tax_amount);
                    var g_total = parseFloat(result.data.total) + parseFloat(result.data.shipping_cost) + parseFloat(result.data.tax_amount);
                    $('#grand_total').html("SAR " + parseFloat(g_total).toFixed(2));
                }

            } else if (result.success === false) {
                showMessageError(result.message);
            }
        },
        error: function () {
            showMessageError(result.message);
        }
    });


    $('#shipping_city').keydown(function(e) {

        if($('.dropdown-menu').is(':visible')) {

            var menu = $('.dropdown-menu');
            var active = menu.find('.active');
            var height = active.outerHeight(); //Height of <li>
            var top = menu.scrollTop(); //Current top of scroll window
            var menuHeight = menu[0].scrollHeight; //Full height of <ul>

            //Up
            if(e.keyCode == 38) {
                if(top != 0) {
                    //All but top item goes up
                    menu.scrollTop(top - height);
                } else {
                    //Top item - go to bottom of menu
                    menu.scrollTop(menuHeight + height);
                }
            }
            //Down
            if(e.keyCode == 40) {
                //window.alert(menuHeight - height);
                var nextHeight = top + height; //Next scrollTop height
                var maxHeight = menuHeight - height; //Max scrollTop height

                if(nextHeight <= maxHeight) {
                    //All but bottom item goes down
                    menu.scrollTop(top + height);
                } else {
                    //Bottom item - go to top of menu
                    menu.scrollTop(0);
                }
            }
        }
    });



}
