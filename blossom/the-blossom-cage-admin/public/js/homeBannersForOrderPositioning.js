jQuery(document).ready(function ($) {
    $(".row_position").sortable({
        delay: 1,
        stop: function () {
            var selectedData = new Array();
            var type = null;
            $('.row_position>tr').each(function () {
                selectedData.push($(this).attr("id"));
                type= $(this).attr("data-value");
            });
            updateOrder(selectedData,type);
        }
    });
    $( ".row_position" ).disableSelection();
    $(".row_position_1").sortable({
        delay: 1,
        stop: function () {
            var selectedData = new Array();
            var type = null;
            $('.row_position_1>tr').each(function () {
                selectedData.push($(this).attr("id"));
                type= $(this).attr("data-value");
            });
            updateOrder(selectedData,type);
        }
    });
    $(".row_position_2").sortable({
        delay: 1,
        stop: function () {
            var selectedData = new Array();
            var type = null;
            $('.row_position_2>tr').each(function () {
                selectedData.push($(this).attr("id"));
                type= $(this).attr("data-value");
            });
            updateOrder(selectedData,type);
        }
    });
    $(".row_position_3").sortable({
        delay: 1,
        stop: function () {
            var selectedData = new Array();
            var type = null;
            $('.row_position_3>tr').each(function () {
                selectedData.push($(this).attr("id"));
                type= $(this).attr("data-value");
            });
            updateOrder(selectedData,type);
        }
    });
    $(".row_position_4").sortable({
        delay: 1,
        stop: function () {
            var selectedData = new Array();
            var type = null;
            $('.row_position_4>tr').each(function () {
                selectedData.push($(this).attr("id"));
                type= $(this).attr("data-value");
            });
            updateOrder(selectedData,type);
        }
    });
    function updateOrder(data,type) {
        console.log(data);
        $.ajax({
            type: "post",
            url: baseUrl + "banners/position",
            data: {_token: token, position: data,type:type},
            success: function (result) {
                // if (result.success === true) {
                // } else {
                //     alert({
                //         title: 'Aww!',
                //         content: 'Internal server error.',
                //     });
                // }
            },
            error: function () {
                // alert({
                //     title: 'Aww!',
                //     content: 'Internal server error.',
                // });
            }
        });

    }
});
