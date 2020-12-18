/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    $(document).on("click", "#wishlist_addToCart", function () {


        var uid = $(this).attr("data-attr");
        var slug = $(this).attr("data-slug");
        var fav_id = $(this).attr("data-uuid");
        var title = $(this).attr("data-title");
        var price = $(this).attr("data-price");
        var image = $(this).attr("data-image");
        var weight = $(this).attr("data-weight");
        var weight_unit = $(this).attr("data-weight_unit");
        var en_title = $(this).attr("data-entitle");
        var ar_title = $(this).attr("data-artitle");
        var sale_price = $(this).attr("data-saleprice");
        var cart_quantity = $(this).attr("data-cartquantity");
        var total = $("#total").attr('data-value');
        var token = $('meta[name=csrf-token]').attr("content");
        var div_id = '#item_' + uid;
        var quantity = 1;


        $('#loader-btn').removeClass('dn');
        $.ajax({

            type: "POST",
            url: baseUrl + locale + "/cart/store",
            data: {_token: token, sale_price: sale_price, cart_quantity: cart_quantity, title: title, en_title: en_title, ar_title: ar_title, price: price, slug: slug, image: image, quantity: quantity, total: total, uuid: uid, weight: weight, weight_unit: weight_unit},

            success: function (result) {

                if (result.success === true) {
                    if (locale === 'ar') {
                        $('#wishlist_addToCart'+uid).html('<i id="check" class="fa fa-check"></i>أضيف إلى السلة');
                    } else {
                        $('#wishlist_addToCart'+uid).html('<i id="check" class="fa fa-check"></i> ADDED TO CART');
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

                    // $.ajax({
                    //     type: "POST",
                    //     url: baseUrl + locale + "/wishlist/delete",
                    //     data: {_token: token, id: uid, item_id: uid},
                    //
                    //     success: function (result) {
                    //
                    //         if (result.success === true) {
                    //
                    //             if (locale === 'ar') {
                    //                 $('#addToBag').html('<i id="check" class="fa fa-check"></i> أضيف إلى السلة');
                    //             } else {
                    //                 $('#addToBag').html('<i id="check" class="fa fa-check"></i> ADDED TO CART');
                    //             }
                    //
                    //             if (parseInt(result.data.count) === 0) {
                    //                 $('#wishlistmessage').show();
                    //                 if (locale === 'ar') {
                    //                     $('#wishlistmessage').html('ليس لديك حاليًا أي منتج تم إضافته إلى قائمة الأمنيات');
                    //
                    //                 } else {
                    //                     $('#wishlistmessage').html('You currently do not have any product added to your Wishlist.');
                    //
                    //                 }
                    //             }
                    //
                    //         }
                    //
                    //     },
                    //     error: function (result) {
                    //         showMessage(result.message);
                    //
                    //     }
                    // });
                    //
                    // if (result.data.total_items === 0) {
                    //     $('#wishlistmessage').show();
                    //     if (locale === 'ar') {
                    //         $('#wishlistmessage').html('You currently do not have any product added to your Wishlist.');
                    //     } else {
                    //         $('#wishlistmessage').html('ليس لديك حاليًا أي منتج تم إضافته إلى قائمة الأمنيات');
                    //     }
                    // }
                }

            },
            error: function (result) {
                showMessageWishlist(result.message);

            }
        });

    });

    $(document).on("click", "#removeFromList", function () {

        var uuid = $(this).attr('data-uuid');
        var item_id = $(this).attr('data-itemuuid');
        var div_id = '#item_' + item_id;
        var token = $('meta[name=csrf-token]').attr("content");

        $.ajax({

            type: "POST",
            url: baseUrl + locale + "/wishlist/delete",
            data: {_token: token, id: item_id, item_id: item_id},

            success: function (result) {
                if (result.success === true) {
                    console.log(result.data.count);
                    if (parseInt(result.data.count) === 0) {
                        $('#wishlistmessage').show();
                        if (locale === 'ar') {
                            $('#wishlistmessage').html('ليس لديك حاليًا أي منتج تم إضافته إلى قائمة الأمنيات');

                        } else {
                            $('#wishlistmessage').html('You currently do not have any product added to your Wishlist.');

                        }
                    }
                    $(div_id).slideUp('slow');
                }

            },
            error: function (result) {
                showMessageWishlist(result.message);

            }
        })

    });

    $(document).on("click", "#rmFav", function () {

        var item_id = $(this).attr('data-uuid');

        var token = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: "POST",
            url: baseUrl + locale + "/wishlist/delete",
            data: {_token: token, id: item_id, item_id: item_id},
            success: function (result) {

                if (result.success === true) {
                    $('#rmFav').hide();
                    $('#addToFav').show();
                    showMessageWishlist(result.message);
                }

            },
            error: function (result) {
                showMessageWishlist(result.message);

            }
        })

    });

    $(document).on("click", "#addToFav", function () {

        var uuid = $(this).attr('data-uuid');
        var token = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            type: "POST",
            url: baseUrl + locale + "/wishlist/store",
            data: {_token: token, item_id: uuid},
            success: function (result) {
                if (result.success === true) {
                    $('#addToFav').hide();
                    $('#rmFav').show();
                    showMessageWishlist(result.message);
                }
            },
            error: function (result) {
                showMessageWishlist(result.message);

            }
        });

    });


    $(document).on("click", "#addToFav_home", function () {

        var e = $(this);
        var uuid = $(this).attr('data-uuid');
        var token = $('meta[name=csrf-token]').attr("content");


        if (e.hasClass('active')) {
            $.ajax({
                type: "POST",
                url: baseUrl + locale + "/wishlist/delete",
                data: {_token: token, id: uuid, item_id: uuid},
                success: function (result) {

                    if (result.success === true) {
                        e.removeClass('active');
                        showMessageWishlist(result.message);
                    }

                },
                error: function (result) {
                    showMessageWishlist(result.message);

                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: baseUrl + locale + "/wishlist/store",
                data: {_token: token, item_id: uuid},
                success: function (result) {
                    if (result.success === true) {
                        e.addClass('active');
                        showMessageWishlist(result.message);
                    } else {
                        showMessageWishlist(result.message);
                    }

                },
                error: function (result) {
                    showMessageWishlist(result.message);
                }
            });

        }
    });

});
