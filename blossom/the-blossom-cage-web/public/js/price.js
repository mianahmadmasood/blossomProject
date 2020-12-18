(function ($) {
    $(document).ready(function () {

        $('.input-range').each(function () {
            var value = $(this).attr('data-slider-value');
            var separator = value.indexOf(',');
            if (separator !== -1) {
                value = value.split(',');
                value.forEach(function (item, i, arr) {
                    arr[ i ] = parseFloat(item);
                });
            } else {
                value = parseFloat(value);
            }
            $(this).slider({
                formatter: function (value) {
                    return currency + ' ' + value;
                },
                min: parseFloat($(this).attr('data-slider-min')),
                max: parseFloat($(this).attr('data-slider-max')),
                range: $(this).attr('data-slider-range'),
                value: value,
                tooltip_split: $(this).attr('data-slider-tooltip_split'),
                tooltip: $(this).attr('data-slider-tooltip')
            });
        });
        $('.MenuIcon').click(function () {
            $(".MenuIcon").toggleClass("is-active");
            $(".FilterBox2").toggle();
            if($('#menuIconButton').hasClass('is-active')) {
                // $("#filterBoxDev").hide();
                $("#filterBoxDev").show();

                $("#mobile_filter").val(1);
            }else{
                $("#filterBoxDev").hide();
                $("#mobile_filter").val(0);
                // $("#filterBoxDev2").show();
            }

        });
    });
})(jQuery);
