$(document).ready(function () {

    var owl_1 = $('#owl-1');
    var owl_2 = $('#owl-2');
    var owl_3 = $('#owl-3');

    owl_1.owlCarousel({
        loop: false,
        margin: 10,
        items: 1,
        dots: false
    });
    owl_2.owlCarousel({
        margin: 10,
        items: 5,
        dots: false
    });
    owl_3.owlCarousel({
        // margin: 10,
        width:'100px',
        items: 5,
        dots: false
    });
    owl_2.find(".item").click(function () {
        var slide_index = owl_2.find(".item").index(this);
        owl_1.trigger('to.owl.carousel', [slide_index, 300]);
    });
    owl_3.find(".item").click(function () {
        var slide_index = owl_3.find(".item").index(this);
        var slide_index_qty = $(this).attr('data-image-qty');
        var slide_index_qty_counter = $(this).attr('data-image-qty-counter');
        if(slide_index_qty != 0) {
            $("#owl-2 .item img").removeClass('imgBorder');
            owl_1.trigger('to.owl.carousel', [slide_index_qty_counter, 300]);
        }else {
            $("#owl-2 .item img").removeClass('imgBorder');
            owl_1.trigger('to.owl.carousel', [0, 300]);
        }
    });
    owl_1.find('.owl-nav').removeClass('disabled');
    owl_1.on('changed.owl.carousel', function (event) {
        $(this).find('.owl-nav').removeClass('disabled');
    });
    owl_2.find('.owl-nav').removeClass('disabled');
    owl_2.on('changed.owl.carousel', function (event) {
        $(this).find('.owl-nav').removeClass('disabled');
    });
    owl_3.find('.owl-nav').removeClass('disabled');
    owl_3.on('changed.owl.carousel', function (event) {
        $(this).find('.owl-nav').removeClass('disabled');
    });
    // Custom Button
    $('.customNextBtn').click(function () {
        owl_1.trigger('next.owl.carousel', 500);
    });
    $('.customPreviousBtn').click(function () {
        owl_1.trigger('prev.owl.carousel', 500);
    });
    $('.customNextBtn').click(function () {
        owl_3.trigger('next.owl.carousel', 500);
    });
    $('.customPreviousBtn').click(function () {
        owl_3.trigger('prev.owl.carousel', 500);
    });
});
$("#owl-2 .item img").click(function(){
    $("#owl-2 .item img").removeClass('imgBorder');
    $(this).addClass('imgBorder');
});

$(document).ready(function(){

    var owl_1 = $('#owl-1');
    var owl_2 = $('#owl-2');

    owl_1.owlCarousel({
        margin:10,
        nav:true,
        items: 1,
        dots: false,

    });

    owl_2.owlCarousel({
        margin:27,
        nav: true,
        items: 4,
        dots:false
    });

    owl_2.find(".item").click(function(){
        var slide_index = owl_2.find(".item").index(this);
        owl_1.trigger('to.owl.carousel',[slide_index,300]);

    });

    // Custom Button
    $('.customNextBtn').click(function() {
        owl_1.trigger('next.owl.carousel',500);
    });
    $('.customPreviousBtn').click(function() {
        owl_1.trigger('prev.owl.carousel',500);
    });




});
$("#owl-2 .item img").click(function(){
    $("#owl-2 .item img").removeClass('imgBorder');
    $(this).addClass('imgBorder');
});



$(document).ready(function(){
    $('button').click(function(e){
        var button_classes, value = +$('.counter').val();
        button_classes = $(e.currentTarget).prop('class');
        if(button_classes.indexOf('up_count') !== -1){
            value = (value) + 1;
        } else {
            value = (value) - 1;
        }
        value = value < 0 ? 0 : value;
        $('.counter').val(value);
    });
    $('.counter').click(function(){
        $(this).focus().select();
    });
});
$('.relatedProducts').owlCarousel({
    margin:12,
    autoplay:false,
    nav:false,
    loop:true,
    responsive:{
        320:{
            items:1,
            nav:false
        },
        420:{
            items:2,
            nav:false
        },
        568:{
            items:3,
            nav:false
        },
        990:{
            items:4,
            nav:false
        },
        1100:{
            items:5,
            nav:false,
        }
    }
});
