jQuery(document).ready(function ($) {
    $('.selectpicker').selectpicker();
    
    //********** cropper functions **********//
    
    var btnUpload = $("#upload_ajax");
    var up_archive = new AjaxUpload(btnUpload, {
        responseType: "json",
        action: siteUrl + "ajaxUploadUser",
        name: "uploadfile",
        onSubmit: function (file, ext) {
            $('.ajx_loder').show();
            if (!(ext && /^(jpeg|JPEG|png|PNG|jpg|JPG|gif)$/.test(ext))) {
                apprise('Only jpeg , JPG , gif , or png images are Allowed');
                $('.ajx_loder').hide();
                return false;
            }
        },
        onComplete: function (file, response) {
            var name = response.name;
            if (name != false) {
                img_selector(name);
                $('#dp').prepend('<div id="imageCont" style="display: none; position:relative;" ><img id="imgRel" style="width: 250px;" src="<?php echo URL::to('/'); ?>/public/assets/avatar1.jpg"  alt=""><div onclick="del(\'' + name + '\')" class="del" style="position:absolute; top:-10px; right: -240px; cursor: pointer;" ><img src="<?php echo URL::to('/'); ?>/public/assets/cross.png"></div></div>');
                $('#dp').append('<input id="imgRel_val" type="hidden" class="numberfile" value="' + response.name + '" name="image" />')
                $('#add').show();
            } else {
                apprise(response.message);
            }
            ;
        }
    });
    
    function img_selector(name) {
        var url = siteUrl + "/public/uploads/items/originals/" + name;
        $.ajax({
            type: "post",
            url: siteUrl + "/userImageSelector",
            data: {name: name, url: url},
            success: function (result) {
                $('#image_resize').html(result).show();
            },
            error: function () {
                apprise('Something Gone wrong.');
            },
        });
    }
    
    function del(name) {
        $('.ajx_loder').show();
        $.ajax({
            type: "post",
            url: siteUrl + "/delImages",
            data: {name: name},
            success: function (result) {
                $('.ajx_loder').hide();
                $('#upload_ajax').show();
                $('#imageCont').hide();
                $('#add').hide();
                $('#imgRel_val').remove();
                $('#image_resize').html('').hide();
            },
            error: function () {
                $('.ajx_loder').hide();
                apprise('Something Gone wrong.');
            },
        });
    }
    
    //********** code repeatition **********//
    var btnUpload1 = $("#upload_ajax1");
    var up_archive = new AjaxUpload(btnUpload1, {
        responseType: "json",
        action: siteUrl + "ajaxUploadUser",
        name: "uploadfile",
        onSubmit: function (file, ext) {
            $('.ajx_loder').show();
            if (!(ext && /^(jpeg|JPEG|png|PNG|jpg|JPG|gif)$/.test(ext))) {
                apprise('Only jpeg , JPG , gif , or png images are Allowed');
                $('.ajx_loder').hide();
                return false;
            }
        },
        onComplete: function (file, response) {
            var name = response.name;
            if (name != false) {
                img_selector(name);
                $('#dp').prepend('<div id="imageCont" style="display: none; position:relative;" ><img id="imgRel" style="width: 250px;" src="<?php echo URL::to('/'); ?>/public/assets/avatar1.jpg"  alt=""><div onclick="del(\'' + name + '\')" class="del" style="position:absolute; top:-10px; right: -240px; cursor: pointer;" ><img src="<?php echo URL::to('/'); ?>/public/assets/cross.png"></div></div>');
                $('#dp').append('<input id="imgRel_val" type="hidden" class="numberfile" value="' + response.name + '" name="image" />')
                $('#add').show();
            } else {
                apprise(response.message);
            }
            ;
        }
    });
    
    var btnUpload2 = $("#upload_ajax2");
    var up_archive = new AjaxUpload(btnUpload2, {
        responseType: "json",
        action: siteUrl + "ajaxUploadUser",
        name: "uploadfile",
        onSubmit: function (file, ext) {
            $('.ajx_loder').show();
            if (!(ext && /^(jpeg|JPEG|png|PNG|jpg|JPG|gif)$/.test(ext))) {
                apprise('Only jpeg , JPG , gif , or png images are Allowed');
                $('.ajx_loder').hide();
                return false;
            }
        },
        onComplete: function (file, response) {
            var name = response.name;
            if (name != false) {
                img_selector(name);
                $('#dp').prepend('<div id="imageCont" style="display: none; position:relative;" ><img id="imgRel" style="width: 250px;" src="<?php echo URL::to('/'); ?>/public/assets/avatar1.jpg"  alt=""><div onclick="del(\'' + name + '\')" class="del" style="position:absolute; top:-10px; right: -240px; cursor: pointer;" ><img src="<?php echo URL::to('/'); ?>/public/assets/cross.png"></div></div>');
                $('#dp').append('<input id="imgRel_val" type="hidden" class="numberfile" value="' + response.name + '" name="image" />')
                $('#add').show();
            } else {
                $('.ajx_loder').hide();
                apprise(response.message);
            }
            ;
        }
    });
    
    var btnUpload3 = $("#upload_ajax3");
    var up_archive = new AjaxUpload(btnUpload3, {
        responseType: "json",
        action: siteUrl + "ajaxUploadUser",
        name: "uploadfile",
        onSubmit: function (file, ext) {
            $('.ajx_loder').show();
            if (!(ext && /^(jpeg|JPEG|png|PNG|jpg|JPG|gif)$/.test(ext))) {
                apprise('Only jpeg , JPG , gif , or png images are Allowed');
                $('.ajx_loder').hide();
                return false;
            }
        },
        onComplete: function (file, response) {
            var name = response.name;
            if (name != false) {
                img_selector(name);
                $('#dp').prepend('<div id="imageCont" style="display: none; position:relative;" ><img id="imgRel" style="width: 250px;" src="<?php echo URL::to('/'); ?>/public/assets/avatar1.jpg"  alt=""><div onclick="del(\'' + name + '\')" class="del" style="position:absolute; top:-10px; right: -240px; cursor: pointer;" ><img src="<?php echo URL::to('/'); ?>/public/assets/cross.png"></div></div>');
                $('#dp').append('<input id="imgRel_val" type="hidden" class="numberfile" value="' + response.name + '" name="image" />')
                $('#add').show();
            } else {
                $('.ajx_loder').hide();
                apprise(response.message);
            }
            ;
        }
    });
    
    //********** cropper functions **********//
    
        
});