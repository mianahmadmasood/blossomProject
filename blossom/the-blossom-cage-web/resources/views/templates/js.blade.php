    <script src="{{asset('public/assets/js/popper.min.js')}}"></script>
<script src="{{asset('public/assets/js/bootstrap-4.0.0.js')}}"></script>
<script src="{{asset('public/assets/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('public/assets/js/bootstrap-slider.min.js')}}"></script>
<script src="{{asset('public/assets/js/owl.carousel.min.js')}}"></script>

<script>
$('#owl-featured').owlCarousel({
    items: 6,
    loop: false,
    responsiveClass: true,
    nav: true,
    autoplay: true,
    dots: false,
    responsive: {
        320: {
            items: 1
        },
        568: {
            items: 2
        },
        768: {
            items: 3
        },
        800: {
            items: 4
        },
        1100: {
            items: 5
        },
        1400: {
            items: 6
        }
    }
});
</script>
<script type="text/javascript">
    $('#aboutOwl').owlCarousel({
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 4,
                nav: true,
                loop: false
            }
        }
    });
</script>
<script type="text/javascript">
    jQuery("#chbibSlider").owlCarousel({
        autoplay: true,
        lazyLoad: true,
        loop: true,
        margin: 20,

        animateOut: 'fadeOut',
        animateIn: 'fadeIn',

        responsiveClass: true,
        autoHeight: true,
        autoplayTimeout: 7000,
        smartSpeed: 800,
        nav: false,
        responsive: {
            0: {
                items: 1
            },

            600: {
                items: 1
            },

            1024: {
                items: 1
            },

            1366: {
                items: 1
            }
        }
    });
</script>
<script type="text/javascript">
    $('#flashDeals').owlCarousel({
        margin:8,
        autoplay:true,
        autoplayTimeout:4000,
        autoplaySpeed: 4000,
        autoplayHoverPause:false,
        slideTransition: 'linear',
        loop:false,
        responsive:{
            0:{
                items:3,
                nav:false
            },
            400:{
                items:4,
                nav:false
            },
            460:{
                items:5,
                nav:false
            },
            568:{
                items:6,
                nav:false
            },
            620:{
                items:7,
                nav:false
            },
            700:{
                items:8,
                nav:false
            },
            800:{
                items:10,
                nav:false
            },
            993:{
                items:5.5,
                nav:false,
            },
            1010:{
                items:6,
                nav:false,
            }
        }
    })
</script>
<script type="text/javascript">
    $('.topCategoriez').owlCarousel({
        margin:8,
        autoplay:false,
        //autoplayTimeout:4000,
        //autoplaySpeed: 4000,
        //autoplayHoverPause:false,
        //slideTransition: 'linear',
        loop:false,
        responsive:{
            0:{
                items:3,
                nav:false
            },
            400:{
                items:4,
                nav:false
            },
            480:{
                items:5,
                nav:false
            },
            568:{
                items:3,
                nav:false
            },
            650:{
                items:4,
                nav:false
            },
            768:{
                items:4,
                nav:false
            },
            820:{
                items:5,
                nav:false
            },
            900:{
                items:5.5,
                nav:false
            },
            993:{
                items:2.7,
                nav:false,
            },
            1100:{
                items:3,
                nav:false,
            }
        }
    })
</script>
<script src="{{asset('public/assets/js/custom.js')}}"></script>
<script src="{{asset('public/js/cart.js')}}"></script>
<script src="{{asset('public/js/signin.js')}}"></script>
<script src="{{asset('public/js/signup.js')}}"></script>
<script src="{{asset('public/js/search.js')}}"></script>
<script src="{{asset('public/js/header_search.js')}}"></script>
<script src="{{asset('public/js/passwords.js')}}"></script>
<script src="{{asset('public/js/profile.js')}}"></script>
<script src="{{asset('public/js/wishlist.js')}}"></script>
<script src="{{asset('public/js/home.js')}}"></script>
<script src="{{asset('public/js/contact.js')}}"></script>
<script src="{{asset('public/js/cart_loader.js')}}"></script>
{{--<script src="{{asset('public/build/js/intlTelInput.js')}}"></script>--}}
<script src="{{asset('public/js/checkout.js')}}"></script>
<!-- Croppie js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
<script src="{{asset('public/js/cropper.js')}}"></script>
<!--  End cropperCroppie js -->
<script src="{{asset('public/js/price.js')}}"></script>
<script src="{{asset('public/js/product_page_images.js')}}"></script>

<script src="{{asset('public/assets/js/jquery.zoom.min.js')}}"></script>
<script src="{{asset('public/assets/js/jquery.mixitup.js')}}"></script>
<!-- <script src="{{asset('public/assets/js/jquery.prettydropdowns.js')}}"></script> -->

{{--<script src="{{asset('public/js/utils.js')}}"></script>--}}

<script type="text/javascript">
	$(function(){
	  $('#mixitup').mixItUp();
	});
</script>


<script>
    $(document).ready(function() {
        $('select').prettyDropdown({
            height:35,
            hoverIntent:500
        });
    });
    $(document).ready(function () {
        $('.modal').on("hidden.bs.modal", function (e) {
            if ($('.modal:visible').length)
            {
                $('.modal-backdrop').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) - 10);
                $('body').addClass('modal-open');
            }
        }).on("show.bs.modal", function (e) {
            if ($('.modal:visible').length)
            {
                $('.modal-backdrop.in').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) + 10);
                $(this).css('z-index', parseInt($('.modal-backdrop.in').first().css('z-index')) + 10);
            }
        });
        // $("#phone_no").intlTelInput();
        // $("#shipping_phone_no").intlTelInput();
        // $("#billing_phone_no").intlTelInput();
    });
</script>



<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("#preloader").delay(300).fadeOut("fast");
        $("#signin_alert").delay(300).fadeOut("fast");
    });
</script>

<script>
    $(function() {
        $('.zoom-image').each(function(){
            var originalImagePath = $(this).find('img').data('original-image');
            $(this).zoom({
                url: originalImagePath,
                magnify: 1
            });
        });
    });

</script>
