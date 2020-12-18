jQuery(document).ready(function ($) {
    $("#upload-banner-image-en").change(function(e) {

        var filename = $(this).val();
        var aux = filename.split('.');
        var extension = aux[aux.length - 1].toUpperCase();
        if (filename !== '' && extension !== 'PNG' && extension !== 'JPG' && extension !== 'JPEG') {

            $.alert({
                title: 'Warning!',
                content: 'You have slected invalid format for the file.',
                buttons: {
                    ok: {
                    }
                }
            });
            $(this).val('');
        }
        var size = this.files[0].size;
        if(this.files[0].size > 2000000) {
            $.alert({
                title: 'Warning!',
                content: 'Please upload file less than 2MB. Thanks!!',
                buttons: {
                    ok: {
                    }
                }
            });
            $(this).val('');
            return;
        }


        $('#preloader').show();
        for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
            var file = e.originalEvent.srcElement.files[i];
            var url = baseUrl + 'banners/image-upload';
            var formData = new FormData();
            formData.append("image", file);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {
                    console.log('response',result);
                    $('#file-upload-banner').val('');
                 var response =  addBannerImageEn(result, result.data.file_name);
                    if(response) {

                        setTimeout(function(){
                            $('#preloader').hide();
                        }, 2000);
                    }

                },
                error: function (error) {
                    console.log(error);
                    $("#profile-pic").attr("src", "/images/icon-cam.png");
                }
            });
        }
    });
    $("#upload-banner-image-ar").change(function(e) {

        var filename = $(this).val();
        var aux = filename.split('.');
        var extension = aux[aux.length - 1].toUpperCase();
        if (filename !== '' && extension !== 'PNG' && extension !== 'JPG' && extension !== 'JPEG') {

            $.alert({
                title: 'Warning!',
                content: 'You have slected invalid format for the file.',
                buttons: {
                    ok: {
                    }
                }
            });
            $(this).val('');
        }
        var size = this.files[0].size;
        if(this.files[0].size > 2000000) {
            $.alert({
                title: 'Warning!',
                content: 'Please upload file less than 2MB. Thanks!!',
                buttons: {
                    ok: {
                    }
                }
            });
            $(this).val('');
            return;
        }


        $('#preloader').show();
        for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
            var file = e.originalEvent.srcElement.files[i];
            var url = baseUrl + 'banners/image-upload';
            var formData = new FormData();
            formData.append("image", file);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {
                    console.log('response',result);
                    $('#file-upload-banner').val('');
                    var response = addBannerImageAr(result, result.data.file_name);
                    if(response) {

                        setTimeout(function(){
                            $('#preloader').hide();
                        }, 2000);
                    }
                },
                error: function (error) {
                    console.log(error);
                    $("#profile-pic").attr("src", "/images/icon-cam.png");
                }
            });
        }
    });

    function addBannerImageEn(result, base64) {

        if (result.success === true) {
            $('#body').removeClass('blur');
            $('#prevBannerImage_div1').hide();
            $('#prevBannerImage_1').show();
            $("#prevBannerImage_1").attr("src",  'https://d4q3rypwox3wu.cloudfront.net/thumbnails/small/banners/'+ base64);
            $("#image_name_1").val(result.data.file_name);
        } else {
            $.alert({
                title: 'Alert!',
                content: result.message,
            });
        }
        return true ;
    }
    function addBannerImageAr(result, base64) {

        if (result.success === true) {
            $('#body').removeClass('blur');
            $('#prevBannerImage_div2').hide();
            $('#prevBannerImage_2').show();
            $("#prevBannerImage_2").attr("src",  'https://d4q3rypwox3wu.cloudfront.net/thumbnails/small/banners/'+ base64);
            $("#image_name_2").val(result.data.file_name);
        } else {
            $.alert({
                title: 'Alert!',
                content: result.message,
            });
        }
        return true ;
    }
});
