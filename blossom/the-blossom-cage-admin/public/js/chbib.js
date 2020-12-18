$(document).ready(function () {
    $("#phone_no").intlTelInput();
//    create custom select2 dropdown
    $('.js-example-basic-single').select2();
    $('.js-example-basic-single2').select2();
    $('.js-example-basic-single3').select2();
    $('.js-example-basic-single-brands').select2();
    $('.js-example-basic-single-discounted_type').select2();
    $('.js-example-basic-single-itemAccessories').select2();
    $('.itemcolorDropdwon').select2();

    $('#item_color1').select2();
    $('#item_color12').select2();
    $('#item_color13').select2();
    $('#item_color4').select2();
    $('#item_color5').select2();
    $('#item_color6').select2();
    $('#item_color7').select2();
    $('#item_color8').select2();
    $('#item_color9').select2();
    $('#item_color10').select2();


    $('.itemcolorDropdwonAddColor').select2();


//    selecting sub categories

    // $('#catpopcancell').on('click', function () {
    //     var cate_id = $('#parent_cat_id').val();
    //     $("select#js-example-basic-single-sub-cat").val(cate_id);
    //
    // });

    $("#mycancellBtn").click(function () {
        window.location.reload();
    });

    $('#js-example-basic-single-sub-cat').on('change', function () {
        var cate_id = this.value;
        $("#myModalForSubCategory" + cate_id).modal("show");
    });
    $('#item_color').on('change', function () {

        var selected = $(this).find('option:selected');
        var colorCode = selected.attr('data-values');
        if (colorCode === '' || colorCode === 'NaN' || colorCode === undefined) {
            $('#colorShow').hide();
        } else {
            $('#colorShow').html('<div class="kt-badge kt-badge--xl kt-badge--brand" style="border: 1px solid #ccc; width: 30px !important;height: 30px !important;background-color: ' + colorCode + ' !important; margin-top: 25px;margin-left: 6px;"></div>');
            $('#colorShow').show();

        }

    });
    $('.item_color').on('change', function () {

        var selected = $(this).find('option:selected');
        var colorCode1 = selected.attr('data-values1');
        var colorCode = selected.attr('data-values');

        if (colorCode === '' || colorCode === 'NaN' || colorCode === undefined) {
            $('#colorShow_' + colorCode1).hide();
        } else {
            $('#colorShow_' + colorCode1).html('<div class="kt-badge kt-badge--xl kt-badge--brand" style="border: 1px solid #ccc; width: 30px !important;height: 30px !important;background-color: ' + colorCode + ' !important; margin-top: 25px;margin-left: 6px;"></div>');
            $('#colorShow_' + colorCode1).show();

        }

    });

    $(document).on("change", '#type_to_link', function (e) {
        var id = $(this).val();

        // if (id === '' || id === 'NaN' || id === undefined) {
        //
        // }

        if (id === 'brands') {
            $('#brand_div').show();
            $('#categoires_div').hide();
            $('#items_div').hide();
        } else if (id === 'categoires') {
            $('#categoires_div').show();
            $('#brand_div').hide();
            $('#items_div').hide();
        } else if (id === 'products') {
            $('#items_div').show();
            $('#categoires_div').hide();
            $('#brand_div').hide();
        } else {
            $('#items_div').hide();
            $('#categoires_div').hide();
            $('#brand_div').hide();
        }
    });


    $('#js-example-basic-single').on('change', function () {


        $.ajax({
            type: "GET",
            url: baseUrl + "sub-categories/ajax/" + this.value,
            success: function (result) {

                if (result.success === true) {
                    var select = $('#js-example-basic-single2');
                    select.find('option').remove();
                    select.append(result.data);
                } else {

                }
            },
            error: function () {

            }
        });
    });

    $('#cat_sl').on('change', function () {

        $('#body').addClass('kt-page--loading');
        $.ajax({
            type: "GET",
            url: baseUrl + "sub-categories/ajax/" + this.value,
            success: function (result) {

                if (result.success === true) {
                    $('#body').removeClass('kt-page--loading');
                    var select = $('#js-example-basic-single2');
                    select.find('option').remove();
                    // select.find('option').not(':first').remove();
                    select.append(result.data);
                } else {
                    $('#body').removeClass('kt-page--loading');
                }
            },
            error: function () {
                $('#body').removeClass('kt-page--loading');
            }
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#prev').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on("change", "#imgInp", function () {

        var size = this.files[0].size;
        if (size > 1033414) {
            $.alert({
                title: 'Warning!',
                content: 'Please watch the size of image(i.e 1MB only)',
            });
            $(this).val('');
            return;
        }
        readURL(this);
    });

    $('#change_status').on('change', function () {


        var status = $(this).find(":selected").val();
        var order_id = $('#order_id').val();
        if (parseInt(status) === 2) {
            var message = 'By changing status, you are making this order in process';
        }

        if (parseInt(status) === 3) {
            var message = 'By changing status, you are marking this order in dispatched';
        }

        if (parseInt(status) === 4) {
            var message = 'By changing status, you are marking this order in delivered';
        }

        $.confirm({
            title: 'Confirm!',
            content: message,
            buttons: {

                confitm: {
                    text: 'Change Status',
                    btnClass: 'btn-color',
                    keys: ['enter', 'shift'],
                    action: function () {
                        $.ajax({
                            type: "PUT",
                            url: baseUrl + "orders/status/change",
                            data: {_token: token, status: status, orderId: order_id},
                            success: function (result) {

                                if (result.success === true) {

                                    $.confirm({
                                        title: 'Congrats!',
                                        content: 'Status order has been changed successfully;',
                                        buttons: {
                                            ok: {
                                                action: function () {
                                                    window.location.reload();
                                                }
                                            }
                                        }
                                    });
                                } else {
                                    $.alert({
                                        title: 'Aww!',
                                        content: 'Internal server error.',
                                    });
                                }
                            },
                            error: function () {
                                $.alert({
                                    title: 'Aww!',
                                    content: 'Internal server error.',
                                });
                            }
                        });
                    }

                },
                cancel: function () {
                    window.location.reload();
                },
            }
        });
    });
    $(document).on("change", "#file", function () {

        var filename = $("#file").val();
        var aux = filename.split('.');
        var extension = aux[aux.length - 1].toUpperCase();
        if (filename !== '' && extension !== 'PNG' && extension !== 'JPG' && extension !== 'JPEG') {

            $.alert({
                title: 'Warning!',
                content: 'You have slected invalid format for the file.',
                buttons: {
                    ok: {}
                }
            });
            $(this).val('');
        }
        var size = this.files[0].size;
        if (this.files[0].size > 5000000) {
            $.alert({
                title: 'Warning!',
                content: 'Please upload file less than 5MB. Thanks!!',
                buttons: {
                    ok: {}
                }
            });
            $(this).val('');
            return;
        }

    });

    $(document).on("change", '[type="radio"]', function () {

        var uuid = $(this).val();
//        alert(uuid);
    });
    $(document).on("change", "#pdf", function () {

        var filename = $(this).val();
        var aux = filename.split('.');
        var extension = aux[aux.length - 1].toUpperCase();

        if (extension !== 'PDF') {

            $.alert({
                title: 'Warning!',
                content: 'You have slected invalid format for the file.',
                buttons: {
                    ok: {}
                }
            });
            $(this).val('');
        }

        if (this.files[0].size > 4000000) {
            $.alert({
                title: 'Warning!',
                content: 'Please upload file less than 4MB. Thanks!!',
                buttons: {
                    ok: {}
                }
            });
            $(this).val('');
            return
        }

//    if (weight_unit === '') {
//        $('#wu_message').html('Please select product wight unit.');
//        $('#wu_message').show();
//        return false;
//    }

    });


});

$('#submit_form_itemAccessories').on('click', function (e) {

    e.preventDefault();
    var accessoriesId = $('#accessories_id').val();

    if (accessoriesId === '' || accessoriesId === 'NaN' || accessoriesId === undefined) {
        $('#itemAss_message').html('Please a Select Accessories.');
        $('#itemAss_message').show();
        return false;
    } else {

        $('#itemAss_message').hide();
    }

    $('#itemAccessoires_form').submit();

});

$('#submit_form').on('click', function (e) {

    e.preventDefault();
    var weight = $('#wieght').val();
    var lenght = $('#lenght').val();
    var width = $('#width').val();
    var height = $('#height').val();
    var unit_of_power_value = $('#unit_of_power_value').val();
    var unit_of_power = $('#unit_of_power').val();
    var orientation_unit = $("#orientation_unit option:selected").val();


    var counter = $('#counter').val();
    var item_color = $('#item_color1').val();

    // var item_color = $('.item_color').find('option:selected');

    // alert(item_color);
    // return false;
    //
    // alert(item_color);
    //
    // console.log('sdfsdf',item_color);
    // return false;

    var color_qty = $('#color_qty').val();
    var image_name = $("input[name='images[]']")
        .map(function () {
            return $(this).val();
        }).get();


    var color_image_name = $("input[name='color_image[1][]']")
        .map(function () {
            return $(this).val();
        }).get();


    if (weight === '') {
        $('#w_message').html('Please enter product weight in interger or decimal values.');
        $('#w_message').show();
        return false;
    }

    if (unit_of_power_value !== '') {
        $('#pv_message').hide();
        if (unit_of_power === '') {
            $('#pu_message').html('Please select power of unit from the list.');
            $('#pu_message').show();
            return false;

        }
    }

    if (lenght !== '') {
        if (orientation_unit === '') {
            $('#ou_message').html('Please select orientation unit from the list.');
            $('#ou_message').show();
            return false;
        }
    }
    if (width !== '') {
        if (orientation_unit === '') {
            $('#ou_message').html('Please select orientation unit from the list.');
            $('#ou_message').show();
            return false;
        }
    }

    if (height !== '') {
        if (orientation_unit === '') {
            $('#ou_message').html('Please select orientation unit from the list.');
            $('#ou_message').show();
            return false;
        }
    }

    if (counter < 3) {

        if (item_color === '') {
            $('#cn_message').html('Please enter a Color Name.');
            $('#cn_message').show();
            $('#ciq_message').hide();
            $('#cc_message').hide();
            $('#c_image_message').hide();
            return false;
        }

        if (color_qty === '' || color_qty === 'NaN' || color_qty === undefined) {
            $('#ciq_message').html('Please enter a Color Quantity');
            $('#ciq_message').show();
            $('#cn_message').hide();
            $('#c_image_message').hide();
            return false;
        }

        // if (color_image_name == '' || color_image_name === 'NaN' || color_image_name === undefined) {
        //     if (image_name == '' || image_name === 'NaN' || image_name === undefined) {
        //         $('#c_image_message').html('Please enter a Color Image.');
        //         $('#c_image_message').show();
        //         $('#ciq_message').hide();
        //         $('#cn_message').hide();
        //         return false;
        //     }
        // }
        //
        // if (image_name == '' || image_name === 'NaN' || image_name === undefined) {
        //     if (color_image_name == '' || color_image_name === 'NaN' || color_image_name === undefined) {
        //         $('#c_image_message').html('Please enter a Color Image.');
        //         $('#c_image_message').show();
        //         $('#ciq_message').hide();
        //         $('#cn_message').hide();
        //         return false;
        //     }
        // }
    }
    $('#variant_form').submit();
});

$('#banner_categoires_for_item').on('change', function (e) {

    var catId = $(this).val();
    var selected = $(this).find('option:selected');
    var type = selected.data('value');
    var catType = selected.attr('data-type');

    $('#items_ajax_div').hide();
    $.ajax({
        type: "post",
        url: baseUrl + "banners/ajaxCall",
        data: {_token: token, id: catId, type: type, catType: catType},

        success: function (result) {

            if (result.success === true) {
                $('#items_ajax_div').show();
                var select = $('#banner_products');
                select.find('option').remove();
                select.append(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});

$('.top_sale_products').on('change', function (e) {
    $('#product_show').hide();
    $.ajax({
        type: "GET",
        url: baseUrl + "topSaleProduct/ajax/" + this.value,
        success: function (result) {
            if (result.success === true) {
                $('#product_show').show();
                $('#product_show').html(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});
$('#fileBanner').on('click', function (e) {

    e.preventDefault();
    var image_name_banner_eng = $('#image_name_1').val();
    var image_name_banner_ar = $('#image_name_2').val();
    var type_to_link = $('#type_to_link').val();
    var validationClass = $('#banner_' + type_to_link).val();

    if (image_name_banner_eng === '') {
        $('#eng_image_message').html('Please upload a english banner Photo.');
        $('#eng_image_message').show();
        $('#ar_image_message').hide();
        return false;
    }

    if (image_name_banner_ar === '') {
        $('#ar_image_message').html('Please upload a arabic banner Photo.');
        $('#ar_image_message').show();
        $('#eng_image_message').show();
        return false;
    }

    if (type_to_link === '') {
        $('#type_to_link_message').html('Please select this field.');
        $('#type_to_link_message').show();
        return false;

    }

    if (validationClass === '' || validationClass === 'NaN' || validationClass === undefined) {
        $('#validation_id_message').html('Please select this field.');
        $('#validation_id_message').show();
        return false;

    }
    $('#banner_form').submit();
});
$('#filetopBrand').on('click', function (e) {

    e.preventDefault();
    var image_name_banner_eng = $('#image_name_1').val();
    var image_name_banner_ar = $('#image_name_2').val();
    var type_to_link = $('#banner_brands').val();

    if (image_name_banner_eng === '') {
        $('#eng_image_message').html('Please upload a english top Brand banner.');
        $('#eng_image_message').show();
        $('#brand_id_message').hide();
        $('#ar_image_message').hide();
        return false;
    }

    if (image_name_banner_ar === '') {
        $('#ar_image_message').html('Please upload a arabic top Brand banner.');
        $('#ar_image_message').show();
        $('#eng_image_message').hide();
        $('#brand_id_message').hide();
        return false;
    }

    if (type_to_link === '') {
        $('#brand_id_message').html('Please select a brand field.');
        $('#brand_id_message').show();
        $('#ar_image_message').hide();
        $('#eng_image_message').hide();
        return false;

    }


    $('#top_brand_banner_form').submit();
});

$('#order_type_filter').on('change', function (e) {
    var id = $('#uuid').val();
    window.location = baseUrl + "customer/orders/" + id + "/" + this.value;

});

$('#submit_form_add_color').on('click', function (e) {

    e.preventDefault();

    var item_color = $('#item_color').val();
    var color_qty = $('#color_qty').val();
    var image_name = $("input[name='images[]']")
        .map(function () {
            return $(this).val();
        }).get();


    var color_image_name = $("input[name='color_image[1][]']")
        .map(function () {
            return $(this).val();
        }).get();


    if (item_color === '') {
        $('#cn_message').html('Please enter a Color Name.');
        $('#cn_message').show();
        $('#ciq_message').hide();
        $('#cc_message').hide();
        $('#c_image_message').hide();
        return false;
    }

    if (color_qty === '' || color_qty === 'NaN' || color_qty === undefined) {
        $('#ciq_message').html('Please enter a Color Quantity');
        $('#ciq_message').show();
        $('#cn_message').hide();
        $('#c_image_message').hide();
        return false;
    }

    // if (color_image_name == '' || color_image_name === 'NaN' || color_image_name === undefined) {
    //     if (image_name == '' || image_name === 'NaN' || image_name === undefined) {
    //         $('#c_image_message').html('Please enter a Color Image.');
    //         $('#c_image_message').show();
    //         $('#ciq_message').hide();
    //         $('#cn_message').hide();
    //         return false;
    //     }
    // }
    //
    // if (image_name == '' || image_name === 'NaN' || image_name === undefined) {
    //     if (color_image_name == '' || color_image_name === 'NaN' || color_image_name === undefined) {
    //         $('#c_image_message').html('Please enter a Color Image.');
    //         $('#c_image_message').show();
    //         $('#ciq_message').hide();
    //         $('#cn_message').hide();
    //         return false;
    //     }
    // }

    $('#variant_form').submit();
});


$('#productmanualfilesSbnitBtn').on('click', function (e) {
    e.preventDefault();
    var en_title = $('#en_title').val();
    var ar_title = $('#ar_title').val();
    var en_file = $('.en_file').val();
    var ar_file = $('.ar_file').val();

    if (en_title === '') {
        $('#en_title_message').html('Please enter a english title.');
        $('#en_title_message').show();
        $('#ar_title_message').hide();
        $('#en_file_message').hide();
        $('#ar_file_message').hide();

        return false;
    }
    if (ar_title === '') {
        $('#ar_title_message').html('Please enter a arabic title.');
        $('#ar_title_message').show();
        $('#en_title_message').hide();
        $('#en_file_message').hide();
        $('#ar_file_message').hide();

        return false;
    }
    if (en_file === '' || en_file === 'NaN' || en_file == undefined) {
        $('#en_file_message').html('Please enter a english file.');
        $('#en_file_message').show();
        $('#en_title_message').hide();
        $('#ar_title_message').hide();
        $('#ar_file_message').hide();

        return false;
    }
    if (ar_file === '' || ar_file === 'NaN' || ar_file == undefined) {
        $('#ar_file_message').html('Please enter a arabic file.');
        $('#ar_file_message').show();
        $('#en_title_message').hide();
        $('#ar_title_message').hide();
        $('#en_file_message').hide();
        return false;
    }
    $('#product_manual_files').submit();
});

$('#storeUpdateVariant').on('click', function (e) {
    e.preventDefault();


    var weight = $('#wieght').val();
    var lenght = $('#lenght').val();
    var width = $('#width').val();
    var height = $('#height').val();
    var orientation_unit = $("#orientation_unit option:selected").val();


    var item_color = $('#item_color').val();

    var color_qty = $('#color_qty').val();
    var image_name = $("input[name='images[]']")
        .map(function () {
            return $(this).val();
        }).get();

    var color_image_name = $("input[name='color_image[1][]']")
        .map(function () {
            return $(this).val();
        }).get();


    var unit_of_power_value = $('#unit_of_power_value').val();
    var unit_of_power = $('#unit_of_power').val();


    if (unit_of_power_value !== '') {
        $('#pv_message').hide();
        if (unit_of_power === '') {
            $('#pu_message').html('Please select power of unit from the list.');
            $('#pu_message').show();
            return false;

        }
    }

    if (weight === '') {
        $('#w_message').html('Please enter product weight in interger or decimal values.');
        $('#w_message').show();
        return false;
    }

    if (width !== '') {
        if (orientation_unit === '') {
            $('#ou_message').html('Please select orientation unit from the list.');
            $('#ou_message').show();
            return false;
        }
    }
    if (lenght !== '') {
        if (orientation_unit === '') {
            $('#ou_message').html('Please select orientation unit from the list.');
            $('#ou_message').show();
            return false;
        }
    }
    if (height !== '') {
        if (orientation_unit === '') {
            $('#ou_message').html('Please select orientation unit from the list.');
            $('#ou_message').show();
            return false;
        }
    }
    // if(counter < 3 ) {
    // if (item_color === '') {
    //     $('#cn_message').html('Please enter a Color Name.');
    //     $('#cn_message').show();
    //     $('#ciq_message').hide();
    //     $('#cc_message').hide();
    //     $('#c_image_message').hide();
    //     return false;
    // }
    //
    // if (color_qty === '' || color_qty === 'NaN' || color_qty === undefined) {
    //     $('#ciq_message').html('Please enter a Color Quantity');
    //     $('#ciq_message').show();
    //     $('#cn_message').hide();
    //     $('#c_image_message').hide();
    //     return false;
    // }

    // if (color_image_name == '' || color_image_name === 'NaN' || color_image_name === undefined) {
    //     if (image_name == '' || image_name === 'NaN' || image_name === undefined) {
    //         $('#c_image_message').html('Please enter a Color Image.');
    //         $('#c_image_message').show();
    //         $('#ciq_message').hide();
    //         $('#cn_message').hide();
    //         return false;
    //     }
    // }
    //
    // if (image_name == '' || image_name === 'NaN' || image_name === undefined) {
    //     if (color_image_name == '' || color_image_name === 'NaN' || color_image_name === undefined) {
    //         $('#c_image_message').html('Please enter a Color Image.');
    //         $('#c_image_message').show();
    //         $('#ciq_message').hide();
    //         $('#cn_message').hide();
    //         return false;
    //     }
    // }

    // }
    $('#updateVariant').submit();
});

$(document).ready(function () {
    $(document).on('submit', 'form', function () {
        $('button').attr('disabled', 'disabled');
    });
});

$(document).on("click", '#submit_con', function (e) {
    e.preventDefault();
    var sale_price = $('#sale_price').val();
    var item_code =  $('#item_code').val();
    var model =  $('#model').val();
    var en_title =  $('#en_title').val();
    var ar_title =  $('#ar_title').val();
    var en_short_description =  $('#en_short_description').val();
    var ar_short_description =  $('#ar_short_description').val();
    var en_description =  $('#en_description').val();
    var ar_description =  $('#ar_description').val();
    var js_example_basic_single =  $('#js-example-basic-single').val();
    var js_example_basic_single2 =  $('#js-example-basic-single2').val();
    var js_example_basic_single_brands =  $('#js-example-basic-single-brands').val();
    var cart_quantity =  $('#cart_quantity').val();
    var price =  $('#price').val();
    













    var discounted_type = $('#discounted_type').val();

    if ($.trim(sale_price) != '' || sale_price !== ''  ) {
        if (discounted_type == '' || discounted_type === 'NaN' || discounted_type === undefined) {
            $('#discounted_type_message').html('Please select a Discounted Type .');
            $('#discounted_type_message').show();
            $('#discounted_type').addClass('field-error');
            return false;
        } else {
            $('#discounted_type_message').hide();
            if (discounted_type == 'percentage') {
                if (sale_price > 100) {
                    $('#sale_price_message').html('Please enter the sale price less then 100.');
                    $('#sale_price_message').show();
                    $('#sale_price').addClass('field-error');
                    return false;
                }
            }
        }
    }


    if (item_code === '' || item_code === 'NaN' || item_code === undefined) {
        $('#item_code').addClass('field-error');
        return false;
    }

    if (model === '' || model === 'NaN' || model === undefined) {
        $('#model').addClass('field-error');
        return false;
    }
    if (en_title === '' || en_title === 'NaN' || en_title === undefined) {
        $('#en_title').addClass('field-error');
        return false;
    }
    if (ar_title === '' || ar_title === 'NaN' || ar_title === undefined) {
        $('#ar_title').addClass('field-error');
        return false;
    }
    if (en_short_description === '' || en_short_description === 'NaN' || en_short_description === undefined) {
        $('#en_short_description').addClass('field-error');
        return false;
    }

    if (ar_short_description === '' || ar_short_description === 'NaN' || ar_short_description === undefined) {
        $('#ar_short_description').addClass('field-error');
        return false;
    }
    if (en_description === '' || en_description === 'NaN' || en_description === undefined) {
        $('#en_description').addClass('field-error');
        return false;
    }
    if (ar_description === '' || ar_description === 'NaN' || ar_description === undefined) {
        $('#ar_description').addClass('field-error');
        return false;
    } if (js_example_basic_single === '' || js_example_basic_single === 'NaN' || js_example_basic_single === undefined) {
        $('#js-example-basic-single').addClass('field-error');
        return false;
    }

    if (js_example_basic_single2 === '' || js_example_basic_single2 === 'NaN' || js_example_basic_single2 === undefined) {
        $('#js-example-basic-single2').addClass('field-error');
        return false;
    }
    if (js_example_basic_single_brands === '' || js_example_basic_single_brands === 'NaN' || js_example_basic_single_brands === undefined) {
        $('#js-example-basic-single-brands').addClass('field-error');
        return false;
    }
    if (cart_quantity === '' || cart_quantity === 'NaN' || cart_quantity === undefined) {
        $('#cart_quantity').addClass('field-error');
        return false;
    }
    if (price === '' || price === 'NaN' || price === undefined) {
        $('#price').addClass('field-error');
        return false;
    }
    

    $('#sale_price_message').hide();
    if ($("input[type=radio]:checked").length === 0) {
        $.alert({
            title: 'Alert!',
            content: 'Please select default image for the product',
        });
        $('#submit_con').prop("disabled", false);
        return false;
    }
    $('#item_form').submit();

});
$(document).on("click", '#submit_edit_product', function (e) {
    e.preventDefault();

    var sale_price = $('#sale_price').val();
    var discounted_type = $('#discounted_type').val();

    if ($.trim(sale_price) != '' || sale_price !== ''  ) {
        if (discounted_type == '' || discounted_type === 'NaN' || discounted_type === undefined) {
            $('#discounted_type_message').html('Please select a Discounted Type .');
            $('#discounted_type_message').show();
            return false;
        } else {
            $('#discounted_type_message').hide();
            if (discounted_type == 'percentage') {
                if (sale_price > 100) {
                    $('#sale_price_message').html('Please enter the sale price less then 100.');
                    $('#sale_price_message').show();
                    return false;
                }
            }
        }
    }

    $('#sale_price_message').hide();

    $('#item_edit_form').submit();

});

$(document).on("click", '.alterConfirmMassage', function (e) {
    e.preventDefault();
    var linkValue = $(this).attr('href');
    var html = '<p>Do you  want to Remove this product Image ?</p>' +
        '<input id="activeinput" type="hidden" value="' + linkValue + '">';
    $("#alterdivmassagess").html(html);
    $('#alterdivmassagemain').show();

});
$(document).on("click", '#alterclose', function (e) {
    $('#alterdivmassagemain').hide();

});
$(document).on("click", '#altersubmit', function (e) {
    window.location.href = $('#activeinput').val();
    $('#alterdivmassagemain').hide();

});

$(document).on("click", '#submit_tech_spec', function (e) {
    e.preventDefault();
    $('#techspec_form').submit();

});


$(document).on("click", '#submit_tech_spec_add', function (e) {
    e.preventDefault();
    addProductTechSpec();
});
$(document).on("click", '.remove_td', function (e) {
    e.preventDefault();
    $(this).closest('.description_text').remove();
    $(this).parent().remove();
});
$(document).on("click", '.remove_spec_row', function (e) {
    e.preventDefault();
    var rowcount = $(this).data('value');
    var removeidvalue = $('#specIdremove_' + rowcount).val();
    if (removeidvalue != '') {
        $.ajax({
            type: "post",
            url: baseUrl + "product/techSpecs/deleteTechSpec",
            data: {_token: token, specIds: removeidvalue},
            success: function (result) {
                if (result.success === true) {
                } else {
                    $.alert({
                        title: 'Aww!',
                        content: 'Internal server error.',
                    });
                }
            },
            error: function () {
                $.alert({
                    title: 'Aww!',
                    content: 'Internal server error.',
                });
            }
        });
    }

    $(this).closest('.description_text').remove();
    $(this).parent().remove();
});

$(document).on("focusout", '#specs_value_en', function () {

    var specs_value_en = $('#specs_value_en').val();
    var specs_value_ar = $('#specs_value_ar').val();
    if (specs_value_ar == '') {
        $('#specs_value_ar').val(specs_value_en);
    }

});


function addProductTechSpec() {
    var counter = parseInt($('#counter').val());
    var specs_en = $('#specs_en').val();
    var specs_ar = $('#specs_ar').val();
    var specs_value_en = $('#specs_value_en').val();
    var specs_value_ar = $('#specs_value_ar').val();
    var spec_unit = $('#spec_unit').val();

    var result = techspecdata(specs_en, specs_ar, specs_value_en, specs_value_ar, spec_unit);

    if (result == false) {
        return false;
    }
    var html = '<div class="form-group description_text row row_' + counter + '">\n' +
        '<div class="col-lg-3">\n' +
        '<input type="text" class="form-control" placeholder="Enter Technical Specification"\n' +
        ' name="techspecs[' + counter + '][specs_en]" value="' + specs_en + '" >\n' +
        '<span id="specs_en_message"  class="form-text text-muted" style="color: red !important"></span>\n' +
        '</div>\n' +
        '<div class="col-lg-1">\n' +
        '<input type="text" class="form-control" placeholder="Enter value(en)"\n' +
        'name="techspecs[' + counter + '][specs_value_en]"  value="' + specs_value_en + '" >\n' +
        '<span id="specs_value_en_message"  class="form-text text-muted" style="color: red !important"></span>\n' +
        '</div>\n' +
        '<div class="col-lg-3">\n' +
        ' <input type="text" class="form-control" placeholder="Enter Technical Specification"\n' +
        'name="techspecs[' + counter + '][specs_ar]"  value="' + specs_ar + '" >\n' +
        '<span id="specs_ar_message" class="form-text text-muted" style="color: red !important"></span>\n' +
        '</div>\n' +
        '<div class="col-lg-1">\n' +
        '<input type="text" class="form-control" placeholder="Enter value(ar)"\n' +
        'name="techspecs[' + counter + '][specs_value_ar]" value="' + specs_value_ar + '" >\n' +
        '<span id="specs_value_ar_message"  class="form-text text-muted" style="color: red !important"></span>\n' +
        '</div>' +
        '<div class="col-md-2">\n' +
        '<select id="spec_unit_new_' + counter + '"  class="form-control js-example-basic-single"  name="techspecs[' + counter + '][unit]" >\n' +
        '<option value="">Select Unit</option>';
    if (spec_unit === "watt-w-واط-ث") {
        html += '<option value="watt-w-واط-ث" selected > w - واط</option>';
    } else {
        html += '<option value="watt-w-واط-ث" > w - واط</option>';
    }
    if (spec_unit === "horsepower-hp-قوة حصان-حصان") {
        html += '<option value="horsepower-hp-قوة حصان-حصان" selected>hp  - قوة حصان</option>';
    } else {
        html += '<option value="horsepower-hp-قوة حصان-حصان"> hp  - قوة حصان</option>';
    }
    if (spec_unit === "Liter Per Second-l/sec-لتر في الثانية-لتر/ثانية") {
        html += '<option value="Liter Per Second-l/sec-لتر في الثانية-لتر/ثانية" selected>l/sec -  لتر في الثانية</option>';
    } else {
        html += '<option value="Liter Per Second-l/sec-لتر في الثانية-لتر/ثانية"> l/sec -  لتر في الثانية</option>';
    }
    if (spec_unit === "pascal-pa-باسكال-باسكال") {
        html += '<option value="pascal-pa-باسكال-باسكال" selected>Pa - باسكال</option>';
    } else {
        html += '<option value="pascal-pa-باسكال-باسكال"> Pa - باسكال</option>';
    }
    if (spec_unit === "kilopascal-kpa-كيلوباسكال-كيلوباسكال") {
        html += '<option value="kilopascal-kpa-كيلوباسكال-كيلوباسكال" selected> kPa - كيلوباسكال</option>';
    } else {
        html += '<option value="kilopascal-kpa-كيلوباسكال-كيلوباسكال"> kPa - كيلوباسكال</option>';
    }
    if (spec_unit === "decibel-dB(A)-ديسيبل-ديسيبل") {
        html += '<option value="decibel-dB(A)-ديسيبل-ديسيبل" selected> dB(A) -  ديسيبل</option>';
    } else {
        html += '<option value="decibel-dB(A)-ديسيبل-ديسيبل"> dB(A) -  ديسيبل</option>';
    }
    if (spec_unit === "litre-litre-لتر-ل") {
        html += '<option value="litre-litre-لتر-ل" selected> l -  لتر</option>';
    } else {
        html += '<option value="litre-litre-لتر-ل"> l -  لتر</option>';
    }
    if (spec_unit === "meter-m-متر-م") {
        html += '<option value="meter-m-متر-م" selected>m -  متر</option>';
    } else {
        html += '<option value="meter-m-متر-م"> m -  متر</option>';
    }
    if (spec_unit === "centimetre-cm-سنتيمتر-سم") {
        html += '<option value="centimetre-cm-سنتيمتر-سم" selected> cm-  سم</option>';
    } else {
        html += '<option value="centimetre-cm-سنتيمتر-سم"> cm-  سم</option>';
    }
    if (spec_unit === "kilogram-kg-كيلوغرام-كلغ") {
        html += '<option value="kilogram-kg-كيلوغرام-كلغ" selected>kg -  كيلوغرام</option>';
    } else {
        html += '<option value="kilogram-kg-كيلوغرام-كلغ"> kg-  كيلوغرام</option>';
    }
    if (spec_unit === "second-s-ثانيا-ثانية") {
        html += '<option value="second-s-ثانيا-ثانية" selected>s-  ثانيا</option>';
    } else {
        html += '<option value="second-s-ثانيا-ثانية"> s -  ثانيا</option>';
    }
    if(spec_unit === "Energy efficiency class-ec-فئة كفاءة الطاقة-ث") {
        html += '<option value="Energy efficiency class-ec-فئة كفاءة الطاقة-ث" selected>EC - ث</option>';

    }else{
        html += '<option value="Energy efficiency class-ec-فئة كفاءة الطاقة-ث"> EC - ث</option>';
    }

    if(spec_unit === "Annual energy consumption-kWh/annum-استهلاك الطاقة السنوي-كيلوواط ساعة / سنة") {
        html += ' <option value="Annual energy consumption-kWh/annum-استهلاك الطاقة السنوي-كيلوواط ساعة / سنة" selected> kWh/annum - كيلوواط ساعة / سنة</option>';

    }else{
        html += ' <option value="Annual energy consumption-kWh/annum-استهلاك الطاقة السنوي-كيلوواط ساعة / سنة"> kWh/annum - كيلوواط ساعة / سنة</option>';
    }

    if(spec_unit === "Dust pick up on carpet-d-التقاط الغبار على السجادة-د") {
        html += ' <option value="Dust pick up on carpet-d-التقاط الغبار على السجادة-د" selected>  D - د</option>';

    }else{
        html += ' <option value="Dust pick up on carpet-d-التقاط الغبار على السجادة-د"> D - د</option>';
    }

    // if(spec_unit === "Dust pick up on hard floor -d-يلتقط الغبار على أرضية صلبة-د") {
    //     html += '<option value="Dust pick up on hard floor -d-يلتقط الغبار على أرضية صلبة-د" selected> Dust pick up on hard floor - يلتقط الغبار على أرضية صلبة</option>';
    //
    // }else{
    //     html += '<option value="Dust pick up on hard floor -d-يلتقط الغبار على أرضية صلبة-د"> Dust pick up on hard floor - يلتقط الغبار على أرضية صلبة</option>';
    // }

    if(spec_unit === "Dust re-emission class-g-فئة إعادة انبعاث الغبار-ز") {
        html += '<option value="Dust re-emission class-g-فئة إعادة انبعاث الغبار-ز" selected>  G - ز</option>';

    }else{
        html += '<option value="Dust re-emission class-g-فئة إعادة انبعاث الغبار-ز">  G - ز</option>';
    }

    if(spec_unit === "Sound power level-dB(A)-درجة قوة الصوت-ديسيبل (أ)") {
        html += '<option value="Sound power level-dB(A)-درجة قوة الصوت-ديسيبل (أ)" selected> dB(A)-ديسيبل (أ)</option>';

    }else{
        html += '<option value="Sound power level-dB(A)-درجة قوة الصوت-ديسيبل (أ)"> dB(A)-ديسيبل (أ)</option>';
    }

    if(spec_unit === "Cable length-(m)/ plug type-طول السلك-(م) / نوع المكونات") {
        html += '<option value="Cable length-(m)/ plug type-طول السلك-(م) / نوع المكونات" selected> (m)/ plug type - (م) / نوع المكونات</option>';

    }else{
        html += '<option value="Cable length-(m)/ plug type-طول السلك-(م) / نوع المكونات"> (m)/ plug type - (م) / نوع المكونات</option>';
    }

    if(spec_unit === "Volt/frequency-v/hz-فولت / تردد-فولت / تردد") {
        html += '<option value="Volt/frequency-v/hz-فولت / تردد-فولت / تردد" selected> v/hz-فولت / تردد</option>';

    }else{
        html += '<option value="Volt/frequency-v/hz-فولت / تردد-فولت / تردد">v/hz-فولت / تردد</option>';
    }

    if(spec_unit === "Protection class / ip protection-w-فئة الحماية / حماية الملكية الفكرية-دبليو") {
        html += '<option value="Protection class / ip protection-w-فئة الحماية / حماية الملكية الفكرية-دبليو" selected>  W-دبليو</option>';

    }else{
        html += '<option value="Protection class / ip protection-w-فئة الحماية / حماية الملكية الفكرية-دبليو"> W-دبليو</option>';
    }

    // if(spec_unit === "Rated power-w-القوة المصنفة-دبليو") {
    //     html += '<option value="Rated power-w-القوة المصنفة-دبليو" selected> Rated power\tالقوة المصنفة-</option>';
    //
    // }else{
    //     html += '<option value="Rated power-w-القوة المصنفة-دبليو"> Rated power\tالقوة المصنفة-</option>';
    // }


    // if(spec_unit === "Suction power end of tube-w-قوة شفط الأنبوب-دبليو") {
    //     html += '<option value="Suction power end of tube-w-قوة شفط الأنبوب-دبليو" selected> Suction power end of tube\tقوة شفط الأنبوب-</option>';
    //
    // }else{
    //     html += '<option value="Suction power end of tube-w-قوة شفط الأنبوب-دبليو"> Suction power end of tube\tقوة شفط الأنبوب-</option>';
    // }

    // if(spec_unit === "Airflow -l/Sec-قوة شفط الأنبوب-لتر / ثانية") {
    //     html += '<option value="Airflow -l/Sec-قوة شفط الأنبوب-لتر / ثانية" selected> Airflow \tقوة شفط الأنبوب-</option>';
    //
    // }else{
    //     html += '<option value="Airflow -l/Sec-قوة شفط الأنبوب-لتر / ثانية"> Airflow \tقوة شفط الأنبوب-</option>';
    // }

    if(spec_unit === "Vacuum at nozzle-Kpa-فراغ في فوهة -كبا") {
        html += '<option value="Vacuum at nozzle-Kpa-فراغ في فوهة -كبا" selected>Kpa-كبا</option>';

    }else{
        html += '<option value="Vacuum at nozzle-Kpa-فراغ في فوهة -كبا"> Kpa-كبا</option>';
    }


    // if(spec_unit === "Sound pressure level (BS 5415)-dB(A)-مستوى ضغط الصوت  -ديسيبل (أ)") {
    //     html += '<option value="Sound pressure level (BS 5415)-dB(A)-مستوى ضغط الصوت  -ديسيبل (أ)" selected> Sound pressure level (BS 5415) -مستوى ضغط الصوت </option>';
    //
    // }else{
    //     html += '<option value="Sound pressure level (BS 5415)-dB(A)-مستوى ضغط الصوت  -ديسيبل (أ)"> Sound pressure level (BS 5415) -مستوى ضغط الصوت </option>';
    // }

    // if(spec_unit === "Dust bag capacity-l-سعة كيس الغبار -لام") {
    //     html += '<option value="Dust bag capacity-l-سعة كيس الغبار -لام" selected> Dust bag capacity -سعة كيس الغبار</option>';
    //
    // }else{
    //     html += '<option value="Dust bag capacity-l-سعة كيس الغبار -لام"> Dust bag capacity -سعة كيس الغبار</option>';
    // }

    if(spec_unit === "Main filter area-cm²-منطقة التصفية الرئيسية -سم²") {
        html += '<option value="Main filter area-cm²-منطقة التصفية الرئيسية -سم²" selected>cm²-سم²</option>';

    }else{
        html += '<option value="Main filter area-cm²-منطقة التصفية الرئيسية -سم²">cm²-سم²</option>';
    }

    if(spec_unit === "Length x width x height-cm-الطول × العرض × الارتفاع -سم") {
        html += '<option value="Length x width x height-cm-الطول × العرض × الارتفاع -سم" selected>cm-سم</option>';

    }else{
        html += '<option value="Length x width x height-cm-الطول × العرض × الارتفاع -سم">cm-سم</option>';
    }

    if(spec_unit === "Weight-kg-وزن -كلغ") {
        html += '<option value="Weight-kg-وزن -كلغ" selected>kg-كلغ</option>';

    }else{
        html += '<option value="Weight-kg-وزن -كلغ">kg-كلغ</option>';
    }

    if(spec_unit === "Weight-OZ / Gram-وزن -اوز / جرام") {
        html += '<option value="Weight-OZ / Gram-وزن -اوز / جرام" selected>OZ / Gram-اوز / جرام</option>';

    }else{
        html += '<option value="Weight-OZ / Gram-وزن -اوز / جرام">OZ / Gram-اوز / جرام</option>';
    }


    if(spec_unit === "Ø mm-Ø mm-Ø مم-Ø مم") {
        html += '<option value="Ø mm-Ø mm-Ø مم-Ø مم" selected> Ø mm -  Ø مم</option>';
    }else{
        html += '<option value="Ø mm-Ø mm-Ø مم-Ø مم"> Ø mm -  Ø مم</option>';
    }
    if(spec_unit === "no.- no.-.لا.- لا") {
        html += '<option value="no.- no.-.لا.- لا" selected>  no. -   .لا</option>';
    }else{
        html += '<option value="no.- no.-.لا.- لا">  no. -   .لا</option>';
    }
    if(spec_unit === "Rpm-Rpm-دورة في الدقيقة-دورة في الدقيقة") {
        html += '<option value="Rpm-Rpm-دورة في الدقيقة-دورة في الدقيقة" selected> Rpm -  دورة في الدقيقة</option>';
    }else{
        html += '<option value="Rpm-Rpm-دورة في الدقيقة-دورة في الدقيقة"> Rpm -  دورة في الدقيقة</option>';
    }
    if(spec_unit === "Orb / Min-Orb / Min-الجرم السماوي / دقيقة-الجرم السماوي / دقيقة") {
        html += '<option value="Orb / Min-Orb / Min-الجرم السماوي / دقيقة-الجرم السماوي / دقيقة" selected> Orb / Min - الجرم السماوي / دقيقة</option>';
    }else{
        html += '<option value="Orb / Min-Orb / Min-الجرم السماوي / دقيقة-الجرم السماوي / دقيقة"> Orb / Min - الجرم السماوي / دقيقة</option>';
    }
    if(spec_unit === "ML-ML-مل-مل") {
        html += '<option value="ML-ML-مل-مل" selected> ML - مل</option>';
    }else{
        html += '<option value="ML-ML-مل-مل"> ML - مل</option>';
    }
    if(spec_unit === "V-V-الجهد االكهربى-الجهد االكهربى") {
        html += ' <option value="V-V-الجهد االكهربى-الجهد االكهربى" selected> V - الجهد االكهربى</option>';
    }else{
        html += ' <option value="V-V-الجهد االكهربى-الجهد االكهربى"> V - الجهد االكهربى</option>';
    }

    if(spec_unit === "HZ-HZ-هرتز-هرتز") {
        html += '<option value="HZ-HZ-هرتز-هرتز" selected> HZ - هرتز</option>';
    }else{
        html += '<option value="HZ-HZ-هرتز-هرتز"> HZ - هرتز</option>';
    }

    if(spec_unit === "mm-mm-مم-مم") {
        html += '<option value="mm-mm-مم-مم" selected> mm - مم</option>';
    }else{
        html += '<option value="mm-mm-مم-مم"> mm - مم</option>';
    }

    
                                        
                                        
                                        
                                       
                                        







    html += '</select>\n' +
        '<span id="pu_message" class="form-text" style=" color: red;  display: none;"></span>\n' +
        '</div>' +
        '<div class="row col-lg-2">\n' +
        '<span class="remove_td" style="margin-top: 5%;margin-left: 35%;cursor: pointer;" \n' +
        '> X ' +
        '</span>\n' +
        '<input type="hidden" id="counter" value="1">\n' +
        '</div>' +
        '</div>';
    $("#rowAppended").append(html);
    $('#specs_value_ar_message').hide();
    $('#specs_unit_message').hide();
    $('#specs_value_en_message').hide();
    $('#specs_ar_message').hide();
    $('#specs_en_message').hide();
    $('#specs_en').val('');
    $('#specs_ar').val('');
    $('#specs_value_en').val('');
    $('#specs_value_ar').val('');
    $('#spec_unit_new_' + counter).select2();
    counter++;
    $('#counter').val(counter);
}

function techspecdata(specs_en, specs_ar, specs_value_en, specs_value_ar, spec_unit) {


    if (specs_en === '') {
        $('#specs_en_message').html('Please enter a Technical Specification(en).');
        $('#specs_en_message').show();
        $('#specs_ar_message').hide();
        $('#specs__value_en_message').hide();
        $('#specs__value_ar_message').hide();
        $('#specs_unit_message').hide();
        return false;
    }

    if (specs_value_en === '' || specs_value_en === 'NaN' || specs_value_en === undefined) {
        $('#specs_value_en_message').html('Please enter a Value.');
        $('#specs_value_en_message').show();
        $('#specs_ar_message').hide();
        $('#specs_en_message').hide();
        $('#specs_value_ar_message').hide();
        $('#specs_unit_message').hide();
        return false;
    }

    if (specs_ar === '') {
        $('#specs_ar_message').html('Please enter a Technical Specification(ar).');
        $('#specs_ar_message').show();
        $('#specs_en_message').hide();
        $('#specs__value_en_message').hide();
        $('#specs__value_ar_message').hide();
        $('#specs_unit_message').hide();
        return false;
    }

    if (specs_value_ar === '' || specs_value_ar === 'NaN' || specs_value_ar === undefined) {
        $('#specs_value_ar_message').html('Please enter a Value.');
        $('#specs_value_ar_message').show();
        $('#specs_ar_message').hide();
        $('#specs_en_message').hide();
        $('#specs_value_en_message').hide();
        $('#specs_unit_message').hide();
        return false;
    }
    // if (spec_unit === '' || spec_unit === 'NaN' || spec_unit === undefined) {
    //     $('#specs_unit_message').html('Please select Select Unit .');
    //     $('#specs_unit_message').show();
    //     $('#specs_value_ar_message').hide();
    //     $('#specs_ar_message').hide();
    //     $('#specs_en_message').hide();
    //     $('#specs_value_en_message').hide();
    //     return false;
    // }

}

$(document).on('click', ".close", function () {
    var id = $(this).attr('data-img');
    var div_id = 'image_div_' + id;
    $('#' + div_id).remove();
    $('#image_' + id).remove();
});


$(document).on("change", '#admin_status_id', function () {
    var uuid = $(this).val();
    if (uuid !== '' || uuid !== 'NaN' || uuid !== undefined) {
        if (uuid === '5') {
            $('#employee_dropdwon').hide();
        } else {
            $('#employee_dropdwon').show();
        }
    }
});

$(document).on("change", '#employee_status_id', function () {
    var uuid = $(this).val();
    if (uuid !== '' || uuid !== 'NaN' || uuid !== undefined) {
        if (uuid === '3') {
            $('#dispatcheddev').show();
            $('#delivereddev').hide();
            $('#delivereddev').html('');
        } else if (uuid === '4') {
            $('#delivereddev').show();
            $('#dispatcheddev').hide();
            $('#dispatcheddev').html('');
        } else {
            $('#delivereddev').hide();
            $('#dispatcheddev').hide();
        }
    }
});
