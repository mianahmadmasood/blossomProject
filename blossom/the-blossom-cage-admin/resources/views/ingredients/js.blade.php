<script>
    var KTAppOptions = {"colors": {"state": {"brand": "#5d78ff", "dark": "#282a3c", "light": "#ffffff", "primary": "#5867dd", "success": "#34bfa3", "info": "#36a3f7", "warning": "#ffb822", "danger": "#fd3995"}, "base": {"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"], "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]}}};</script>
<script src="{{asset('public/js/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('public/js/scripts.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('public/js/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('public/js/basic.js')}}" type="text/javascript"></script>
<script src="{{asset('public/js/app.bundle.js')}}" type="text/javascript"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="{{ asset('public/js/gmaps.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/dashboard.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/login-v1.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/select2.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/globalProgram.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/chbib.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/spectrum.js') }}" type="text/javascript"></script>
<script src="{{asset('public/js/intlTelInput.js')}}"></script>
<script src="{{asset('public/js/html-table.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
<script src="{{asset('public/js/homeBannersImage.js')}}"></script>
<script src="{{asset('public/js/itemColor.js')}}"></script>
<script src="{{asset('public/js/topcategories.js')}}"></script>
<script src="{{asset('public/js/cropper.js')}}"></script>
<script src="{{asset('public/js/alterMassage.js')}}"></script>
<script src="{{asset('public/js/shippingStatus.js')}}"></script>


<script>
    jQuery(document).ready(function ($) {
        $("#color_code").spectrum({
            color: "#ECC",
            showInput: true,
            preferredFormat: "hex",
        });
    });
</script>
<script>
    jQuery(document).ready(function ($) {
        $("#edit_color_code").spectrum({
            preferredFormat: "hex",
            showInput: true,
        });
    });

</script>