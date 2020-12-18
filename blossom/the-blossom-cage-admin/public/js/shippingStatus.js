
function loadajax(){
    var orderId = $('#shipping_Status_get_by_order').val();
    $.ajax({
        type: "post",
        url: baseUrl + "orders/shippingStatus",
        data: {_token: token, id: orderId},
        success: function (result) {
            $('#logsHtml').html('');
            $('#logsHtml').html(result.data);
        },
        error: function () {

        }
    });
}

$(document).ready(function(){
    setTimeout(function(){
        loadajax();
    },1000); // milliseconds
});



