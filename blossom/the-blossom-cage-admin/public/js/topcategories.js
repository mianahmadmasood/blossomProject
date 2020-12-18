
$('#banner_categoires_for_subcatgories_1').on('change', function () {


    $.ajax({
        type: "GET",
        url: baseUrl + "sub-categories/ajax/" + this.value,
        success: function (result) {

            if (result.success === true) {
                var select = $('#banner_categoires_for_item_1');
                select.find('option').remove();
                select.append(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});
$('#banner_categoires_for_subcatgories_2').on('change', function () {


    $.ajax({
        type: "GET",
        url: baseUrl + "sub-categories/ajax/" + this.value,
        success: function (result) {

            if (result.success === true) {
                var select = $('#banner_categoires_for_item_2');
                select.find('option').remove();
                select.append(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});
$('#banner_categoires_for_subcatgories_3').on('change', function () {


    $.ajax({
        type: "GET",
        url: baseUrl + "sub-categories/ajax/" + this.value,
        success: function (result) {

            if (result.success === true) {
                var select = $('#banner_categoires_for_item_3');
                select.find('option').remove();
                select.append(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});
$('#banner_categoires_for_subcatgories_4').on('change', function () {


    $.ajax({
        type: "GET",
        url: baseUrl + "sub-categories/ajax/" + this.value,
        success: function (result) {

            if (result.success === true) {
                var select = $('#banner_categoires_for_item_4');
                select.find('option').remove();
                select.append(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});


$('#banner_categoires_for_item_1').on('change', function (e) {

    var catId = $(this).val();
    var selected = $(this).find('option:selected');
    var type = selected.data('value');
    var catType = selected.attr('data-type');

    $('#items_ajax_div_1').hide();
    $.ajax({
        type: "post",
        url: baseUrl + "topCategories/ajaxCall",
        data: {_token: token, id: catId,type:type,catType:catType},

        success: function (result) {

            if (result.success === true) {
                $('#items_ajax_div_1').show();
                var select = $('#banner_products_1');
                select.find('option').remove();
                select.append(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});

$('#banner_categoires_for_item_2').on('change', function (e) {

    var catId = $(this).val();
    var selected = $(this).find('option:selected');
    var type = selected.data('value');
    var catType = selected.attr('data-type');

    $('#items_ajax_div_2').hide();
    $.ajax({
        type: "post",
        url: baseUrl + "topCategories/ajaxCall",
        data: {_token: token, id: catId,type:type,catType:catType},

        success: function (result) {

            if (result.success === true) {
                $('#items_ajax_div_2').show();
                var select = $('#banner_products_2');
                select.find('option').remove();
                select.append(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});
$('#banner_categoires_for_item_3').on('change', function (e) {

    var catId = $(this).val();
    var selected = $(this).find('option:selected');
    var type = selected.data('value');
    var catType = selected.attr('data-type');

    $('#items_ajax_div_3').hide();
    $.ajax({
        type: "post",
        url: baseUrl + "topCategories/ajaxCall",
        data: {_token: token, id: catId,type:type,catType:catType},

        success: function (result) {

            if (result.success === true) {
                $('#items_ajax_div_3').show();
                var select = $('#banner_products_3');
                select.find('option').remove();
                select.append(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});
$('#banner_categoires_for_item_4').on('change', function (e) {

    var catId = $(this).val();
    var selected = $(this).find('option:selected');
    var type = selected.data('value');
    var catType = selected.attr('data-type');

    $('#items_ajax_div_4').hide();
    $.ajax({
        type: "post",
        url: baseUrl + "topCategories/ajaxCall",
        data: {_token: token, id: catId,type:type,catType:catType},

        success: function (result) {

            if (result.success === true) {
                $('#items_ajax_div_4').show();
                var select = $('#banner_products_4');
                select.find('option').remove();
                select.append(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});

$('#banner_products_1').on('change', function (e) {
    $('#product_show_1').hide();
    $.ajax({
        type: "GET",
        url: baseUrl + "topSaleProduct/ajax/" + this.value,
        success: function (result) {
            if (result.success === true) {
                $('#product_show_1').show();
                $('#product_show_1').html(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});$('#banner_products_2').on('change', function (e) {
    $('#product_show_2').hide();
    $.ajax({
        type: "GET",
        url: baseUrl + "topSaleProduct/ajax/" + this.value,
        success: function (result) {
            if (result.success === true) {
                $('#product_show_2').show();
                $('#product_show_2').html(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});$('#banner_products_3').on('change', function (e) {
    $('#product_show_3').hide();
    $.ajax({
        type: "GET",
        url: baseUrl + "topSaleProduct/ajax/" + this.value,
        success: function (result) {
            if (result.success === true) {
                $('#product_show_3').show();
                $('#product_show_3').html(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});$('#banner_products_4').on('change', function (e) {
    $('#product_show_4').hide();
    $.ajax({
        type: "GET",
        url: baseUrl + "topSaleProduct/ajax/" + this.value,
        success: function (result) {
            if (result.success === true) {
                $('#product_show_4').show();
                $('#product_show_4').html(result.data);
            } else {

            }
        },
        error: function () {

        }
    });
});



