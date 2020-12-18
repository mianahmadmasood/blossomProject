$('#file-upload').on('click', function () {
    $('#file-upload').val('');
});
$('#file-upload-item').on('click', function () {
    $('#file-upload-item').val('');
});
$('#file-upload-item-color').on('click', function () {
    $('#file-upload-item-color').val('');
});
var current_row_number = 1;
var current_row_number_counter = 1;
var current_number_counter_for_icon_categories = 0;

$(function () {
    var croppie = null;
    var croppie12 = null;
    var el = document.getElementById('resizer');

    $.base64ImageToBlob = function (str) {
        // extract content type and base64 payload from original string
        var pos = str.indexOf(';base64,');
        var type = str.substring(5, pos);
        var b64 = str.substr(pos + 8);

        // decode base64
        var imageContent = atob(b64);

        // create an ArrayBuffer and a view (as unsigned 8-bit)
        var buffer = new ArrayBuffer(imageContent.length);
        var view = new Uint8Array(buffer);

        // fill the view, using the decoded base64
        for (var n = 0; n < imageContent.length; n++) {
            view[n] = imageContent.charCodeAt(n);
        }

        // convert ArrayBuffer to Blob
        var blob = new Blob([buffer], {type: type});

        return blob;
    }

    $.getImage = function (input, croppie) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                croppie.bind({
                    url: e.target.result,
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#file-upload-brand").on("change", function (event) {

        var filename = $("#file-upload-brand").val();
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
            return false;
        }
        var size = this.files[0].size;
        if(this.files[0].size > 5000000) {
            $.alert({
                title: 'Warning!',
                content: 'Please upload file less than 5MB. Thanks!!',
                buttons: {
                    ok: {
                    }
                }
            });
            $(this).val('');
            return false;

        }


        $("#myModal").modal();
        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el, {
            viewport: {
                width: 400,
                height: 400,
                type: 'square'
            },
            boundary: {
                width: 400,
                height: 400
            },
            enableOrientation: true
        });
        $.getImage(event.target, croppie);
    });


    $("#file-upload").on("change", function (event) {


        var filename = $("#file-upload").val();
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
        if(this.files[0].size > 5000000) {
            $.alert({
                title: 'Warning!',
                content: 'Please upload file less than 5MB. Thanks!!',
                buttons: {
                    ok: {
                    }
                }
            });
            $(this).val('');
            return;
        }

        $("#myModal").modal();
        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el, {

            viewport: {
                width: 400,
                height: 400,
                type: 'square'
            },
            boundary: {
                width: 400,
                height: 400
            },
            enableOrientation: true


        });


        $.getImage(event.target, croppie);
    });
    $("#file-upload-item").on("change", function (event) {



        var filename = $("#file-upload-item").val();
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
        if(this.files[0].size > 5000000) {
            $.alert({
                title: 'Warning!',
                content: 'Please upload file less than 5MB. Thanks!!',
                buttons: {
                    ok: {
                    }
                }
            });
            $(this).val('');
            return;
        }

        $("#myModal").modal();
        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el, {
            viewport: { width: 350, height: 350 },
            boundary: { width: 400, height: 400 },
            minZoom:0,
            showZoomer: true,
            // enableResize: true,
            enableOrientation: true
        });
        $.getImage(event.target, croppie);
    });

    $("#file-upload").on("change", function (event) {

        var filename = $("#file-upload").val();
        current_number_counter_for_icon_categories = 1;
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
        if(this.files[0].size > 5000000) {
            $.alert({
                title: 'Warning!',
                content: 'Please upload file less than 5MB. Thanks!!',
                buttons: {
                    ok: {
                    }
                }
            });
            $(this).val('');
            return;
        }

        $("#myModal").modal();
        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el, {
            viewport: {
                width: 500,
                height: 500,
                type: 'square'
            },
            boundary: {
                width: 500,
                height: 500
            },
            enableOrientation: true
        });
        $.getImage(event.target, croppie);
    });


    $("#file-upload-icon-categories").on("change", function (event) {

        var filename = $("#file-upload-icon-categories").val();

        current_number_counter_for_icon_categories = 2;

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
        if(this.files[0].size > 300000) {
            $.alert({
                title: 'Warning!',
                content: 'The Uploaded file should be less then 300KB Thanks!!',
                buttons: {
                    ok: {
                    }
                }
            });
            $(this).val('');
            return;
        }

        $("#myModal").modal();
        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el, {
            viewport: {
                width: 200,
                height: 200,
                type: 'square'
            },
            boundary: {
                width: 200,
                height: 200
            },
            enableOrientation: true
        });
        $.getImage(event.target, croppie);
    });

    $(".file-upload_ME").on("change", function (event) {

        current_row_number = $(this).attr("data-value");
        current_row_number_counter = $(this).attr("data-values");
        var filename = $("#file-upload-item-color").val();
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
        if(this.files[0].size > 5000000) {
            $.alert({
                title: 'Warning!',
                content: 'Please upload file less than 5MB. Thanks!!',
                buttons: {
                    ok: {
                    }
                }
            });
            $(this).val('');
            return;
        }


        $("#myModal").modal();
        croppie = new Croppie(el, {
            // viewport: {
            //     width: 400,
            //     height: 400,
            //     type: 'square'
            // },
            // boundary: {
            //     width: 400,
            //     height: 400
            // },
            // enableOrientation: true

            viewport: { width: 350, height: 350 },
            boundary: { width: 400, height: 400 },
            minZoom:0,
            showZoomer: true,
            enableOrientation: true
        });
        $.getImage(event.target, croppie);

    });

    $(".file-upload_banner").on("change", function (event) {

        
        current_row_number = $(this).attr("data-value");
        current_row_number_counter = $(this).attr("data-values");
        var filename = $("#file-upload-banner").val();
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
        if(this.files[0].size > 5000000) {
            $.alert({
                title: 'Warning!',
                content: 'Please upload file less than 5MB. Thanks!!',
                buttons: {
                    ok: {
                    }
                }
            });
            $(this).val('');
            return;
        }


        $("#myModal").modal();
        croppie = new Croppie(el, {
            viewport: { width: 400, height: 160 },
            boundary: { width: 500, height: 250 },
            minZoom:0,
            showZoomer: true,
            // enableResize: true,
            enableOrientation: true
        });
        $.getImage(event.target, croppie);

    });

    $("#upload").on("click", function () {
        $('#preloader').show();
        croppie.result({
            // type : 'canvas',
            // format : 'jpeg',
            quality: '1',
            size: {width: 1400, height: 1400}
        }).then(function (base64) {
            $("#myModal").modal("hide");
            var url = baseUrl + 'product/image-upload';
            var formData = new FormData();
            formData.append("image", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
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
                    $('#file-upload-item').val('');
                    $('#preloader').hide();
                    if (currentUrl.includes('images/create')) {
                        addProductImageSingle(result, base64);
                    } else {
                        addProductImages(result, base64);
                    }

                },
                error: function (error) {
                    console.log(error);
                    $("#profile-pic").attr("src", "/images/icon-cam.png");
                }
            });
        });
    });

    $("#upload-brand-image").on("click", function () {
        $('#preloader').show();
        croppie.result('base64').then(function (base64) {
            $("#myModal").modal("hide");
            var url = baseUrl + 'brands/image-upload';
            var formData = new FormData();
            formData.append("image", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
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
                    $('#file-upload-brand').val('');
                    $('#preloader').hide();
                    addBrandsImage(result, base64);

                },
                error: function (error) {
                    console.log(error);
                    $("#profile-pic").attr("src", "/images/icon-cam.png");
                }
            });
        });
    });
    $("#upload-accessorie-image").on("click", function () {
        $('#preloader').show();
        croppie.result('base64').then(function (base64) {
            $("#myModal").modal("hide");
            var url = baseUrl + 'accessories/image-upload';
            var formData = new FormData();
            formData.append("image", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
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
                    $('#file-upload').val('');
                    $('#preloader').hide();
                    addAccessoriesImage(result, base64);

                },
                error: function (error) {
                    console.log(error);
                    $("#profile-pic").attr("src", "/images/icon-cam.png");
                }
            });
        });
    });
    $(".upload-item-color-image").on("click", function () {
        $('#preloader').show();
        croppie.result({
            // type : 'canvas',
            // format : 'jpeg',
            quality: '1',
            size: {width: 1400, height: 1400}
        }).then(function (base64) {
            $("#myModal").modal("hide");
            var url = baseUrl + 'product/variants/image-upload';
            var formData = new FormData();
            formData.append("image", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
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
                    $('#file-upload-item-color').val('');
                    $('#preloader').hide();
                    addProductItemColorImage(result, base64);
                },
                error: function (error) {
                    console.log(error);
                    $("#profile-pic").attr("src", "/images/icon-cam.png");
                }
            });
        });
    });

    $(".upload-banner-image").on("click", function () {
        $('#preloader').show();
        croppie.result({
            // type : 'canvas',
            // format : 'jpeg',
            quality: '1',
            size: {width: 1440, height: 575}
        }).then(function (base64) {
            $("#myModal").modal("hide");
            var url = baseUrl + 'banners/image-upload';
            var formData = new FormData();
            formData.append("image", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
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
                    $('#file-upload-banner').val('');
                    $('#preloader').hide();
                    addBannerImage(result, base64);
                },
                error: function (error) {
                    console.log(error);
                    $("#profile-pic").attr("src", "/images/icon-cam.png");
                }
            });
        });
    });
    $("#upload-warehouse-image").on("click", function () {
        $('#preloader').show();
        croppie.result('base64').then(function (base64) {
            $("#myModal").modal("hide");
            var url = baseUrl + 'warehouse/image-upload';
            var formData = new FormData();
            formData.append("image", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
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
                    $('#file-upload').val('');
                    $('#preloader').hide();
                    addWarehousesImage(result, base64);

                },
                error: function (error) {
                    console.log(error);
                    $("#profile-pic").attr("src", "/images/icon-cam.png");
                }
            });
        });
    });
    $("#upload-category-image").on("click", function () {

        $('#preloader').show();
        croppie.result('base64').then(function (base64) {
            $("#myModal").modal("hide");
            var url = baseUrl + 'categories/image-upload';
            var formData = new FormData();
            formData.append("image", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
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
                    $('#file-upload').val('');
                    $('#preloader').hide();
                    addCategoryImage(result, base64);

                },
                error: function (error) {
                    console.log(error);
                    $("#profile-pic").attr("src", "/images/icon-cam.png");
                }
            });
        });

    });
    $("#upload-icon-category-image").on("click", function () {

        

       if(current_number_counter_for_icon_categories == 2) {
           $('#preloader').show();
           croppie.result('base64').then(function (base64) {
               $("#myModal").modal("hide");
               var url = baseUrl + 'categories/icon-categories-image-upload';
               var formData = new FormData();
               formData.append("image", $.base64ImageToBlob(base64));

               // This step is only needed if you are using Laravel
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
                       $('#file-upload-icon-categories').val('');
                       $('#preloader').hide();
                       addIconCategoryImage(result, base64);

                   },
                   error: function (error) {
                       console.log(error);
                       $("#profile-pic").attr("src", "/images/icon-cam.png");
                   }
               });
           });
       }else{
           $('#preloader').show();
           croppie.result('base64').then(function (base64) {
               $("#myModal").modal("hide");
               var url = baseUrl + 'categories/image-upload';
               var formData = new FormData();
               formData.append("image", $.base64ImageToBlob(base64));

               // This step is only needed if you are using Laravel
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
                       $('#file-upload').val('');
                       $('#preloader').hide();
                       addCategoryImage(result, base64);

                   },
                   error: function (error) {
                       console.log(error);
                       $("#profile-pic").attr("src", "/images/icon-cam.png");
                   }
               });
           });

       }
    });

    $("#upload-subcategory-image").on("click", function () {
        $('#preloader').show();
        croppie.result('base64').then(function (base64) {
            $("#myModal").modal("hide");
            var url = baseUrl + 'sub-categories/image-upload';
            var formData = new FormData();
            formData.append("image", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
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
                    $('#file-upload').val('');
                    $('#preloader').hide();
                    addSubCategoryImage(result, base64);

                },
                error: function (error) {
                    console.log(error);
                    $("#profile-pic").attr("src", "/images/icon-cam.png");
                }
            });
        });
    });
    $("#upload-employee-image").on("click", function () {
        $('#preloader').show();
        croppie.result('base64').then(function (base64) {
            $("#myModal").modal("hide");
            var url = baseUrl + 'employee/image-upload';
            var formData = new FormData();
            formData.append("image", $.base64ImageToBlob(base64));

            // This step is only needed if you are using Laravel
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
                    $('#file-upload').val('');
                    $('#preloader').hide();
                    addEmployeeImage(result, base64);

                },
                error: function (error) {
                    console.log(error);
                    $("#profile-pic").attr("src", "/images/icon-cam.png");
                }
            });
        });
    });

    // To Rotate Image Left or Right
    $(".rotate").on("click", function () {
        croppie.rotate(parseInt($(this).data('deg')));
    });



    $('#myModal').on('hidden.bs.modal', function (e) {
        // This function will call immediately after model close
        // To ensure that old croppie instance is destroyed on every model close
        setTimeout(function () {
            croppie.destroy();
        }, 100);
    })

});

function addProductItemColorImage(result, base64) {

    if (result.success === true) {
        $('#body').removeClass('blur');
        var count = Date.now();
        if(current_row_number_counter === '' || current_row_number_counter === NaN || current_row_number_counter === undefined) {
            var input = '<input id="image_' + result.data.div_id + '" class="itemimageinput" type="hidden" name="images[]">';
        }else {
            var input = '<input id="image_' + result.data.div_id + '" class="itemimageinput" type="hidden" name="color_image[' + current_row_number_counter + '][]">';
        }
        var image_div = '<div id="image_div_' + result.data.div_id + '" class="profile-img1 p-3">' + input + '<a class="close closeItemColor" style="cursor: pointer;" data-img="' + result.data.div_id + '">×</a> <img id="' + count + '"  ></div>';
        $("#prevItemColorImage_"+current_row_number).append(image_div);
        $("#" + count).attr("src", base64);
        $("#image_" + result.data.div_id).val(result.data.file_name);
    } else {
        $.alert({
            title: 'Alert!',
            content: result.message,
        });
    }

}

function addBannerImage(result, base64) {
    
    if (result.success === true) {
        $('#body').removeClass('blur');
        $("#prevBannerImage_div"+current_row_number).hide();
        $("#prevBannerImage_"+current_row_number).show();
        $("#prevBannerImage_"+current_row_number).attr("src", base64);
        $("#image_name_"+current_row_number).val(result.data.file_name);
    } else {
        $.alert({
            title: 'Alert!',
            content: result.message,
        });
    }
}


function addProductImages(result, base64) {
    if (result.success === true) {
        $('#body').removeClass('blur');
        var count = Date.now();
        var input = '<input id="image_' + result.data.div_id + '" type="hidden" name="images[]">';
        var radio = '<div class="md-radio" > <label class="kt-radio">    <input id="mk_default" type="radio" name="default" value="' + result.data.file_name + '" > Make Default   <span></span></label></div>' + input;
        var image_div = '<div id="image_div_' + result.data.div_id + '" class="profile-img p-3"> <a class="close" style="cursor: pointer;" data-img="' + result.data.div_id + '">×</a> <img id="' + count + '" src="{{asset("public/theme-images/time-left.gif")}}" id="profile-pic"> ' + radio + '</div>';
        $("#imagerow").append(image_div);
        $("#" + count).attr("src", base64);
        $("#image_" + result.data.div_id).val(result.data.file_name);
    } else {
        $.alert({
            title: 'Alert!',
            content: result.message,
        });
    }
}

function addProductImageSingle(result, base64) {
    if (result.success === true) {
        $('#body').removeClass('blur');
        $("#prev").attr("src", base64);
        $("#image_name").val(result.data.file_name);
    } else {
        $.alert({
            title: 'Alert!',
            content: result.message,
        });
    }
}
function addBrandsImage(result, base64) {
    if (result.success === true) {
        $('#body').removeClass('blur');
        $("#prevBrandsImage").attr("src", base64);
        $("#image_name").val(result.data.file_name);
    } else {
        $.alert({
            title: 'Alert!',
            content: result.message,
        });
    }
}
function addAccessoriesImage(result, base64) {
    if (result.success === true) {
        $('#body').removeClass('blur');
        $("#prevAccessoriesImage").attr("src", base64);
        $("#image_name").val(result.data.file_name);
    } else {
        $.alert({
            title: 'Alert!',
            content: result.message,
        });
    }
}
function addWarehousesImage(result, base64) {
    if (result.success === true) {
        $('#body').removeClass('blur');
        $("#prevWarehousesImage").attr("src", base64);
        $("#image_name").val(result.data.file_name);
    } else {
        $.alert({
            title: 'Alert!',
            content: result.message,
        });
    }
}
function addIconCategoryImage(result, base64) {
    if (result.success === true) {
        $('#body').removeClass('blur');
        $("#prevIconCategoriesImage").attr("src", base64);
        $("#icon_image").val(result.data.file_name);
    } else {
        $.alert({
            title: 'Alert!',
            content: result.message,
        });
    }
}
function addCategoryImage(result, base64) {
    if (result.success === true) {
        $('#body').removeClass('blur');
        $("#prevCategoriesImage").attr("src", base64);
        $("#image_name").val(result.data.file_name);
    } else {
        $.alert({
            title: 'Alert!',
            content: result.message,
        });
    }
}
function addSubCategoryImage(result, base64) {
    if (result.success === true) {
        $('#body').removeClass('blur');
        $("#prevSubCategoriesImage").attr("src", base64);
        $("#image_name").val(result.data.file_name);
    } else {
        $.alert({
            title: 'Alert!',
            content: result.message,
        });
    }
}
function addEmployeeImage(result, base64) {
    if (result.success === true) {
        $('#body').removeClass('blur');
        $("#prevEmployeesImage").attr("src", base64);
        $("#image_name").val(result.data.file_name);
    } else {
        $.alert({
            title: 'Alert!',
            content: result.message,
        });
    }
}


