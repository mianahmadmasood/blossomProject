@extends('layouts.item_listing')
@section('content')
<section class="cCart">
    <script src="{{asset('public/build/js/intlTelInput.js')}}"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('partials.messages')
                <div class="w100 pageStatus mb-3 breadcrumbs_box">
                    <a href="{{route('searchItem')}}"> {{ __('localization.h_btn')}}</a>
                    <a href="">/</a>
                    <a href="{{route('viewBag')}}"> {{ __('localization.shopping_cart')}}</a>
                    <a href="">/</a>
                    <a href="#"> {{ __('localization.checkout')}}</a>
                </div><!--w100-->
                <div class="w100">
                    <div class="hero-content pb-5 text-center">
                        <h1 class="hero-heading"> {{ __('localization.checkout')}}</h1>
                    </div>
                </div><!--w100-->
            </div><!--col-md-12-->
        </div><!--row-->
        <div id="message" class="alert alert-danger" role="alert" style="display: none;">
            This is a danger alert—check it out!
        </div>
        <div id="main_container" class="row mb-5">
            <div class="col-lg-8">
                <form id="checkout" action="{{route('placeOrder', ['lang' => App::getLocale()])}}" method="POST" novalidate="" >
                    {{ csrf_field() }}
                    <div class="box1 w100">
                        @include('partials.shippingAddress')
                        <button id="show_payment_form" class="def-btn"> @if(Session::get('payment_method') == 1 || old('payment_method') == 1 ) {{ __('localization.place_order')}} @else {{ __('localization.continue_payment')}} @endif </button>

                        @include('partials.shippingSummary')



                        <a id="edit_shhipping_details" class="def-btn dn"> {{ __('localization.edit')}}</a>
                        <a  id="submit" class="def-btn"  style=" display: none;" > {{ __('localization.place_order')}}</a>
                    </div><!--box2-->
                </form>
            </div>
            @include('partials.checkoutSummary')
        </div>
    </div><!--container-->
</section><!--cCart-->

<script>

    var input = document.querySelector("#phone_no");
    window.intlTelInput(input, {
        // allowDropdown: false,
        autoHideDialCode: false,
        // autoPlaceholder: "on",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: true,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        preferredCountries: ['sa'],
        separateDialCode: false,
        // initialDialCode: true,
        // americaMode: false,
        // onlyCountries: [],
        utilsScript: "{{asset('public')}}/build/js/utils.js",


    });

    var input = document.querySelector("#shipping_phone_no");
    window.intlTelInput(input, {
        // allowDropdown: false,
        autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        preferredCountries: ['sa'],
        separateDialCode: false,
        utilsScript: "{{asset('public')}}/build/js/utils.js",
    });

    var input = document.querySelector("#billing_phone_no");
    window.intlTelInput(input, {
        // allowDropdown: false,
        autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        formatOnDisplay: true,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        preferredCountries: ['sa'],
        separateDialCode: false,
        utilsScript: "{{asset('public')}}/build/js/utils.js",
    });

    $(document).on("focusout", "#phone_no", function () {

        var phone_no = $('#phone_no').val();
        var shipping_phone_no = $('#shipping_phone_no').val();
        var billing_phone_no = $('#billing_phone_no').val();

        if (shipping_phone_no.length < 5 || shipping_phone_no === '0' || shipping_phone_no === '' || shipping_phone_no === NaN || shipping_phone_no === undefined) {

            var input = document.querySelector("#shipping_phone_no");

            var iti = window.intlTelInput(input, {
                nationalMode: false,
                initialCountry: '',
                utilsScript: "{{asset('public')}}/build/js/utils.js",
            });

            $('#f_shipping2, .iti, .iti--allow-dropdown, .iti__flag-container, .iti__selected-flag, .newflag').css({
                'display':'none!important',
                'float':'left',
            });
            $('#f_shipping2,.intl-tel-input,.country-list, .iti-flag').css({
                'border':'none!important',
            });
            $('#f_shipping2, .iti__flag, .iti__sa').css({
                'border':'none!important',
            });
            iti.setNumber(phone_no);

            $('#shipping_phone_no').val(phone_no);
        }
        if (billing_phone_no.length < 5 || billing_phone_no === '0' || billing_phone_no === '' || billing_phone_no === NaN || billing_phone_no === undefined) {


            var input2 = document.querySelector("#billing_phone_no");

            var iti2 = window.intlTelInput(input2, {
                nationalMode: false,
                initialCountry: '',
                utilsScript: "{{asset('public')}}/build/js/utils.js",
            });

            $('#f_shipping2, .iti, .iti--allow-dropdown, .iti__flag-container, .iti__selected-flag, .newflag').css({
                'display':'none!important',
                'float':'left',
            });
            $('#f_shipping2,.intl-tel-input,.country-list, .iti-flag').css({
                'border':'none!important',
            });
            $('#f_shipping2, .iti__flag, .iti__sa').css({
                'border':'none!important',
            });
            iti2.setNumber(phone_no);
        }

    });

</script>

@endsection
