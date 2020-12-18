
$(document).on("click", '#submit_item_color_add', function (e) {
    e.preventDefault();
    addProductItemColor();
});


$(document).on("click", '.remove_td', function (e) {
    e.preventDefault();
    $(this).closest('.description_text').remove();
    $(this).parent().remove();
});
$(document).on("click", '.remove_itemColor_row', function (e) {
    e.preventDefault();
    $(this).closest('.description_text_item_color').remove();
    $(this).parent().remove();
});
$(document).on("focusout", '#specs_value_en', function () {

    var specs_value_en = $('#specs_value_en').val();
    var specs_value_ar = $('#specs_value_ar').val();
    if(specs_value_ar == ''  ){
        $('#specs_value_ar').val(specs_value_en);
    }

});


function addProductItemColor() {

    var counter = parseInt($('#counter').val());
    // var counters = counter -1;
    var countermax = parseInt($('#counter').attr('data-max'));
    //
    // var item_color_name = $('.itemcolorDropdwon_'+counters).find(':selected').data('value');
    // //
    // var item_color_qty = $('.itemcolorQuantity_'+counters).val();
    //
    // var image_name = $(".itemimageinput")
    //     .map(function(){return $(this).val();}).get();
    // alert(image_name);
    // return false;

    // var image_name = $(".itemimageinput_"+counters).val();
    //
    //  var result=itemColordataValidate(item_color_name,item_color_qty,image_name);

     // if(result == false){
     //     return false;
     // }

    if(counter < countermax) {
        $('#color_'+counter).show();
        counter++;
        $('#counter').val(counter);

    }

    // var token = $('meta[name=csrf-token]').attr("content");


    // $("#rowAppendedItemColor").append(html);


    // // var item_color = $('.itemcolorDropdwon').html();
    // var item_color_name = $('#item_color').find(':selected').data('value');
    // var item_color_html = $('#item_color').html();
    // var item_color = $('#item_color').val();
    //
    // var image_name = $("input[name='images[]']")
    //     .map(function(){return $(this).val();}).get();
    //
    //
    // var color_qty = $('#color_qty').val();
    //
    // var image_html = $("#prevItemColorImage_"+current_row_number).html();
    //
    //  var result=itemColordataValidate(item_color,color_qty,image_name);
    //
    //  if(result == false){
    //      return false;
    //  }
    //
    // $('#prevItemColorImage').html('');
    //
    //  var html = '<div class="form-group description_text_item_color row row_'+counter+'">\n' +
    //      '<div class="col-md-2">\n' +
    //      '<select id="item_color"  class="form-control itemcolorDropdwon"  name="color['+counter+'][item_color]" >\n' +
    //      '<option value="'+item_color+'" selected>'+item_color_name+'</option>\n' +
    //      ''+item_color_html +'' +
    //      '</select>' +
    //      '</div>\n' +
    //      '<div class="d-flex justify-content-center p-3">\n' +
    //      '    <div class="card text-center">\n' +
    //      '        <div class="card-body">\n' +
    //      '            <div class="btn btn-dark">\n' +
    //      '                <input type="file" class="file-upload_ME file-upload" id="file-upload-item-color"\n' +
    //      '                       name="profile_picture" accept="image/*">\n' +
    //      '                Upload Me\n' +
    //      '            </div>\n' +
    //      '            <span class="form-text text-muted">file size  1 to 5MB</span>\n' +
    //      '        </div>\n' +
    //      '        <span id="c_image_message" class="form-text"\n' +
    //      '              style=" color: red;  display: none;"></span>\n' +
    //      '    </div>\n' +
    //      '</div>'+
    //     '<div class="col-md-2">\n' +
    //     '<input id="color_qty" type="number" class="form-control" \n' +
    //     'name="color['+counter+'][color_qty]" value="'+color_qty+'" maxlength="45">\n' +
    //      '<input  type="hidden" class="form-control" name="color['+counter+'][image_name]" value="'+image_name+'" maxlength="45">\n' +
    //     '</div>' +
    //     ''+image_html+'' +
    //     '<div class="col-lg-1">\n' +
    //     '<span  class="remove_itemColor_row"  data-value="1" style=" margin-top: 5%;margin-left: 35%;cursor: pointer;"> X </span>\n' +
    //     '</div>\n' +
    //     '</div>';
    //
    // $("#rowAppendedItemColor").append(html);
    // $('#cn_message').hide();
    // $('#ciq_message').hide();
    // $('#c_image_message').hide();
    //  $('#en_color_name').val('');
    //  $('#color_qty').val('');
    // $('#image_name').val('');
    // $("input[name='images[]']").val('');
    // $('#imageitemcolordev').hide();
    // $('#prevImageData').val('');
    // counter++;
    // $('#counter').val(counter);
}

function itemColordataValidate(item_color,color_qty,image_name) {

    if (item_color === '' || item_color === 'NaN' || item_color === undefined) {
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

    // if (image_name == '' || image_name === 'NaN' || image_name === undefined) {
    //     $('#c_image_message').html('Please enter a Color Image.');
    //     $('#c_image_message').show();
    //     $('#ciq_message').hide();
    //     $('#cn_message').hide();
    //     return false;
    // }

}

$(document).on('click', ".closeItemColor", function () {

    var id = $(this).attr('data-img');
    var n = $(this).css("color");


    // if($(this).css('color')=='rgb(0, 0, 0)'){
    //     $(this).attr("style", "color: red !important;");
    // }else{
    //     $(this).attr("style", "color: black !important;");
    // }
    var counterValue = $(this).attr('data-count');
    var itemColorId = $("#image_item_id_"+counterValue).val();

    $(this).closest('.description_text_item_color').addClass('new_description_text_item_color');
    var html= '<p>Do you  want to Remove this image?</p>' +
        '<input id="activeinputForImage" type="hidden" value="'+id+'">';
    $("#alterdivmassagessForImage").html(html);
    $('#alterdivmassagemainForImage').show();

});


$(document).on("click", '#altercloseForImage', function (e) {
    $('#alterdivmassagemainForImage').hide();

});
$(document).on("click", '#altersubmitForImage', function (e) {
   var image_value = $('#activeinputForImage').val();
    $('.new_description_text_item_color').remove();
    $('#alterdivmassagemainForImage').hide();

});



$(document).on("click", '.deleteItemColor', function (e) {
    e.preventDefault();
    var url = baseUrl + 'product/variants/itemcolorsingledelete';
    var counterValue = $(this).attr('data-value');
    var itemColorId = $("#itemColorId_"+counterValue).val();
    if(itemColorId != '') {
        $.ajax({
            type: "POST",
            url: url,
            data: {_token: token, itemColorId: itemColorId},
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

    $(this).closest('.description_text_row').remove();
    $(this).parent().remove();

});
$(document).on("click", '.updateItemColor', function (e) {
    e.preventDefault();
    var url = baseUrl + 'product/variants/itemcolorsingleupdate';
    var counterValue = $(this).attr('data-value');
    var itemColorId = $("#itemColorId_"+counterValue).val();
    var color_qty = $("#color_qty_"+counterValue).val();

    var image_item_id = $("input[name='imagesId["+counterValue +"][]']")
        .map(function(){return $(this).val();}).get();

    if(itemColorId != '') {
        $.ajax({
            type: "POST",
            url: url,
            data: {_token: token, itemColorId: itemColorId,color_qty:color_qty,image_item_id:image_item_id},
            success: function (result) {
                if (result.success === true) {
                    $.alert({
                        title: 'Success',
                        content: 'Item Color has been update.',
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

});



