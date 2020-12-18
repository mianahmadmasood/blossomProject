$(document).ready(function () {

    $("#mainFi,#mainFi2").on('click', '#sortBy,#sortByfeatured', function () {

        var ex_params = '';
        var url = baseUrl + locale + '/products';
        if (locale == 'ar') {
            $('#heading_button').html('ترتيب حسب ' + $(this).text());
        } else {
            $('#heading_button').html('SORT BY ' + $(this).text());
        }
        var sortBy = $(this).attr('attr-value');
        var category = getUrlParameters('category');
        var sub_categories = getUrlParameters('sub_categories');
        var search_key_word = getUrlParameters('search');
        var price = getUrlParameters('price');
        var page_no = getUrlParameters('page_no');
        var urlParametersBrand = getUrlParameters('brands');
        if(typeof category !== "undefined" && typeof urlParametersBrand !== "undefined"){
            ex_params = '?category=' + category + '&brands=' + urlParametersBrand;
        }else {
            if (category) {
                ex_params = '?category=' + category;
            }
        }


        if (sub_categories)
        {
            if (category) {
                ex_params = ex_params + '&sub_categories=' + sub_categories;
            } else {
                ex_params = ex_params + '?sub_categories=' + sub_categories;
            }
        }

        if (price) {
            if (category || sub_categories) {
                ex_params = ex_params + '&price=' + price;
            } else {
                ex_params = ex_params + '?price=' + price;
            }
        }
        if (search_key_word) {
            if (category) {
                ex_params = ex_params + '&search=' + search_key_word;
            } else {
                ex_params = ex_params + '?search=' + search_key_word;
            }
        }


        if (category || sub_categories || price || search_key_word || urlParametersBrand) {
            ex_params = ex_params + '&sort_by=' + sortBy;
        } else {

            if(!category){
                ex_params = '?category=all';
                ex_params = ex_params + '&sort_by=' + sortBy;
            }else{
                ex_params = ex_params + '?sort_by=' + sortBy;
            }

        }

        if(sortBy){
            page_no =1;
        }
        if (page_no) {
            ex_params = ex_params + '&page_no=' + page_no;
        }
        url = url + ex_params;

        window.location.href = url;
    });


    $(document).on("click", "#pagination", function () {
        var link = $(this).attr('attr-href');
        window.location.href = link;

    });
    $("#submitBtn,#submitBtn2").on("click", function () {


        var search_key_word = '';
        var url = baseUrl + locale + '/products';
        var urlParameters = getUrlParameters('category');

        var urlParametersBrand = getUrlParameters('brand');
        if(typeof urlParameters !== "undefined" && typeof urlParametersBrand !== "undefined"){
            url = url + '?category=' + urlParameters + '&brands=' + urlParametersBrand;
        }else {
            if (typeof urlParameters !== "undefined") {
                url = url + '?category=' + urlParameters;
            }
        }
        //adding brands to url
        var brands = $('.brandfilter.active').map(function () {
            return $(this).attr('data-value');
        }).get();


        if (brands.length > 0) {
            if (typeof urlParameters !== "undefined") {
                url = url + '&brands=' + brands.join("|");

            } else {
                url = url + '?brands=' + brands.join("|");
            }
        }

        //adding sub-categories to url

        var sub_categories = $('.checkedCategory').map(function () {
            return this.value;
        }).get();


        if (sub_categories.length > 0) {
            if (typeof urlParameters !== "undefined") {
                url = url + '&sub_categories=' + sub_categories.join("|");

            } else {
                url = url + '?sub_categories=' + sub_categories.join("|");
            }
        }
        //adding price to url

        var priceMin = $('#priceMin').val();
        var priceMax = $('#priceMax').val();


        if(priceMin === '0' || priceMin === '' || priceMin === NaN || priceMin === undefined){
            priceMin = 0;
        }if(priceMax === '0' || priceMax === '' || priceMax === NaN || priceMax === undefined){
            priceMax = 0;
        }

        if (priceMin > '0' || priceMax > '0' ) {
            if (sub_categories.length > 0 || typeof urlParameters !== "undefined") {
                url = url + '&price=' + priceMin+','+priceMax;
            } else {
                url = url + '?price=' + priceMin+','+priceMax;
            }
        }
        //adding search keyword
        search_key_word = $('#search-item').val();
        if (search_key_word !== '') {
            if (priceMin > '0' || priceMax > '0' || sub_categories.length > 1 || brands.length > 1 || typeof urlParameters !== "undefined") {
                url = url + '&search=' + encodeURIComponent(search_key_word);
            } else {
                url = url + '?search=' + encodeURIComponent(search_key_word);
            }

        }

        //checking filter presence


        if (sub_categories.length === 0 && brands.length === 0 && priceMin.length == undefined && priceMax.length == undefined && priceMin == '' && priceMax == ''  && search_key_word === '') {
            showMessage(selectMessageString('error', locale, 'select_filer'));
            return;
        }
        window.location.href = url;
    });

    function getUrlParameters(sParam) {
        var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    }



    $(document).on("click", '.category', function (e) {
        e.preventDefault();

        if ( $(this).parent().find('label').hasClass("checkboxfilterchecked") ) {
            $(this).parent().find('label').removeClass('checkboxfilterchecked');
            this.removeAttribute("checked");
            $(this).removeClass("checkedCategory");

        }else {
            $(this).parent().find('label').addClass('checkboxfilterchecked');
            this.setAttribute("checked", "checked");
            $(this).addClass("checkedCategory");
        }

        // $(this).closest('label').addClass('checkboxfilterchecked');

        // if($(this).prop('checked') == true){
        //     $(this).removeAttr('checked');
        // }else{
        //     $(this).attr('checked');
        // }

    });


        // $('.category ').hover(function(){
        //     $('#carousel').css('background-position', '10px 10px');
        // }, function(){
        //     $('#carousel').css('background-position', '');
        // });



    /**
     * Seach the item by key word
     */

    $('#search-item').keydown(function (event) {

        if (event.keyCode === 13) {
            event.preventDefault();
            var search_keyword = $(this).val();
            if (search_keyword === '') {
                return;
            }
            searchBox(search_keyword);
        }

    })

    $('#search-item-btn').click(function (event) {

        var keyword = $('#search-item').val();
        if (keyword === '' || keyword === undefined) {
            return;
        }
        searchBox(keyword);

    });

    $('#search-item-header-btn').click(function (event) {

        var keyword = $('#search-item-header').val();
        if (keyword === '' || keyword === undefined) {
            return;
        }
        searchBoxHeader(keyword);

    });

    $('#btn-ss-header').click(function (event) {
        var keyword = $('#search').val();
        if (keyword === '' || keyword === undefined) {
            return;
        }
        searchBoxHeader(keyword);

    });

    $('#search-item-header').keydown(function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            var search_keyword = $(this).val();
            if (search_keyword === '') {
                return;
            }
            searchBoxHeader(search_keyword);
        }

    })
    $('#search').keydown(function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            var search_keyword = $(this).val();
            if (search_keyword === '') {
                return;
            }
            searchBoxHeader(search_keyword);
        }

    })

    function searchBoxHeader(searchKeyWord) {
        var url = baseUrl + locale + '/products';
        url = url + '?search=' + encodeURIComponent(searchKeyWord);
        window.location.href = url;
    }

    // function encodeUrlValues(url) {
    //     if (encodeURIComponent) url = encodeURIComponent(url);
    //     else if (encodeURI) url = encodeURI(url);
    //     else url = escape(url);
    //     url = url.replace(/\+/g, '%2B'); // Force the replacement of "+"
    //     var escapedValue = encodeURIComponent(url).replace('%26','&');
    //     alert(escapedValue);
    //     return escapedValue;
    // };



    function searchBox(searchKeyWord) {

        var url = baseUrl + locale + '/products';
        //adding parent category to url
        var urlParameters = getUrlParameters('category');

        if (typeof urlParameters !== "undefined") {
            url = url + '?category=' + urlParameters;
        }        //adding sub-categories to url
        var sub_categories = $('.css-checkbox:checkbox:checked').map(function () {
            return this.value;
        }).get();
        if (urlParameters && sub_categories.length > 0) {
            url = url + '&sub_categories=' + sub_categories.join("|");
        } else if (sub_categories.length > 0) {
            url = url + '?sub_categories=' + sub_categories.join("|");
        }

        //adding price to url

        var priceMin = $('#priceMin').val();
        var priceMax =  $('#priceMax').val();
        if(priceMin === '0' || priceMin === '' || priceMin === NaN || priceMin === undefined){
            priceMin = 0;
        }if(priceMax === '0' || priceMax === '' || priceMax === NaN || priceMax === undefined){
            priceMax = 0;
        }


        if (priceMin > '0' || priceMax > '0' ) {
            if (sub_categories.length > 0 || typeof urlParameters !== "undefined") {
                url = url + '&price=' + priceMin+','+priceMax;
            } else {
                url = url + '?price=' + priceMin+','+priceMax;
            }
        }

        if (searchKeyWord !== '') {
            if (priceMin > '0' || priceMax > '0' || sub_categories.length > 0 || typeof urlParameters !== "undefined") {
                url = url + '&search=' + encodeURIComponent(searchKeyWord);
            } else if (searchKeyWord) {
                url = url + '?search=' + encodeURIComponent(searchKeyWord);
            }
        }
        window.location.href = url;
    }

    $(document).on("click", "#link", function () {
        var url = baseUrl + locale + '/products?category=' + $(this).attr('attr-slug');
        window.location.href = url;


    });
});


$(".ok").on("click", function () {
    hideMessage();
});


$(".shadow").on("click", function () {
    hideMessage();
});

function showMessage(message, btn = null) {

    $('.ChbibBox').addClass('bblur');
    $('.shadow').show();
    $('#popup_message').html(message);
    $('.successBox').removeClass('dn');
    if (btn !== null) {
        $('.mb-3').removeClass('dn');
    }
}
function showMessageWishlist(message) {
    $('.ChbibBox').addClass('bblur');
    $('.shadow').show();
    $('#popup_message_wishlist_show_popup').html(message);
    $('.successBoxwishlist').removeClass('dn');
}
function showMessageCart(message,datacategory) {

    $('.ChbibBox').addClass('bblur');
    $('.shadow').show();
    var urlProduCtcategory = baseUrl + locale + '/products?category=all';
    var urlCart = baseUrl + locale + '/cart';

    $('#popup_message_cartMsg').html(message);
    if (locale === 'ar') {
        $('#popup_message_cart').html('<a href="' + urlCart + '"  class="btn btn-primary clsbtn">عرض العربة</a>');
    }else{
        $('#popup_message_cart').html('<a href="'+ urlCart +'"  class="btn btn-primary clsbtn">View Cart</a>');
    }
    if (locale === 'ar') {
        $('#popup_message_cartCategory').html('<a href="' + urlProduCtcategory + '"  class="btn btn-primary clsbtn">مواصلة التسوق</a>');
    }else {
        $('#popup_message_cartCategory').html('<a href="' + urlProduCtcategory + '"  class="btn btn-primary clsbtn">Continue Shopping</a>');
    }
    $('.successBoxForcart').removeClass('dn');
    $('.mb-3').removeClass('dn');
}
function showMessageCartItemDelete(uid) {

    $('.ChbibBox').addClass('bblur');
    $('.shadow').show();
    if (locale === 'ar') {
        $('.popup_message_cartMsg_foritem').html(' <p id="popup_message">هل تريد إزالة هذا العنصر؟ </p>');
        $('.popup_message_cartItem').html(' <a id="removeFromBag_card" data-value="'+uid+'" href="javascript:void(0)" class="btn btn-primary clsbtn "> نعم</a>');
        $('.popup_message_cartItem_close').html('<a  id="btnClick" style="display: inline-block;" href="javascript:void(0)"   class="btn btn-primary clsbtn">لا</a>');

      }else{
        $('.popup_message_cartMsg_foritem').html(' <p id="popup_message"> Do you  want to remove this Item? </p>');
        $('.popup_message_cartItem').html(' <a id="removeFromBag_card" data-value="'+uid+'" href="javascript:void(0)" class=" btn btn-primary clsbtn "> Yes</a>');
        $('.popup_message_cartItem_close').html('<a   id="btnClick" style="display: inline-block;" href="javascript:void(0)"  class="btn btn-primary clsbtn">No</a>');

    }

    $('.successBoxForcart').removeClass('dn');
    $('.mb-3').removeClass('dn');
}
function showMessageCartItemAccessoiresDelete(accessoriesId,uid) {

    $('.ChbibBox').addClass('bblur');
    $('.shadow').show();

    if (locale === 'ar') {
        $('.popup_message_cartMsg_foritem').html(' <p id="popup_message">هل تريد إزالة هذه الملحقات؟ </p>');
        $('.popup_message_cartItem').html(' <a id="removeFromBag_accessoires_card" data-value="'+accessoriesId+'" data-value-uuid="'+uid+'" href="javascript:void(0)" class=" btn btn-primary clsbtn removeFromBag_accessoires_card "> نعم</a>');
        $('.popup_message_cartItem_close').html('<a   id="btnClick" style="display: inline-block;" href="javascript:void(0)"  class="btn btn-primary clsbtn">لا</a>');

    }else{
        $('.popup_message_cartMsg_foritem').html(' <p id="popup_message"> Do you  want to remove this accessories? </p>');
        $('.popup_message_cartItem').html(' <a id="removeFromBag_accessoires_card" data-value="'+accessoriesId+'" data-value-uuid="'+uid+'" href="javascript:void(0)" class="btn btn-primary clsbtn removeFromBag_accessoires_card "> Yes</a>');
        $('.popup_message_cartItem_close').html('<a  id="btnClick" style="display: inline-block;" href="javascript:void(0)"   class="btn btn-primary clsbtn">No</a>');

    }

    $('.successBoxForcart').removeClass('dn');
    $('.mb-3').removeClass('dn');
}
function showMessageError(message,datacategory) {

    $('.ChbibBox').addClass('bblur');
    $('.shadow').show();
    $('#popup_messageError').html(message);
    $('.errorBox').removeClass('dn');
}

function hideMessage() {
    $('.shadow').hide();
    $('.ChbibBox').removeClass('bblur');
    $('.successBox').addClass('dn');
    $('.successBoxForcart').addClass('dn');
    $('.successBoxwishlist').addClass('dn');
}

$(document).on("click", '.brandfilter', function (e) {
    e.preventDefault();
    if ( $(this).hasClass("active") ) {
        $(this).removeClass('active');
    }else {
        $(this).addClass('active');
    }
});


$(document).on("click", ".successBox", function () {
    hideMessage();
});

$(document).on("click", ".successBoxForcart", function () {
    hideMessage();
});
$(document).on("click", ".successBoxwishlist", function () {
    hideMessage();
});
