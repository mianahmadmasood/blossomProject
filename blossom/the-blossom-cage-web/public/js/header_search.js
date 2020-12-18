
/**
 * Seach the item by key word
 */
$(document).ready(function () {


    $('#search').keydown(function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            var search_keyword = $(this).val();
            if (search_keyword === '') {
                return;
            }
            headerSearch(search_keyword);
        }

    })


    function headerSearch(search_keyword) {
        var url = baseUrl + locale + '/products?search=' + search_keyword;
        window.location.href = url;
    }

});

