<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('public/theme-images/favicon.ico') }}">
<link href="{{asset('public/css/datatables.bundle.css')}}" media="all" rel="stylesheet" type="text/css" />
<link href="{{asset('public/css/vendors.bundle.css')}}" media="all" rel="stylesheet" type="text/css" />
<link href="{{asset('public/css/style.bundle.css')}}" media="all" rel="stylesheet" type="text/css" />
<link href="{{asset('public/css/light.css')}}" media="all" rel="stylesheet" type="text/css" />
<link href="{{asset('public/css/dark.css')}}" media="all" rel="stylesheet" type="text/css" />
<link href="{{asset('public/css/dark_aside.css')}}" media="all" rel="stylesheet" type="text/css" />
<link href="{{asset('public/css/login-v3.default.css')}}" media="all" rel="stylesheet" type="text/css" />
<link href="{{asset('public/css/fullcalendar.bundle.css')}}" media="all" rel="stylesheet" type="text/css" />
<link href="{{asset('public/css/chbib.css')}}" media="all" rel="stylesheet" type="text/css" />
<link href="{{asset('public/css/spectrum.css')}}" media="all" rel="stylesheet" type="text/css" />
<link href="{{asset('public/css/intlTelInput.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
WebFont.load({
    google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
    active: function () {
        sessionStorage.fonts = true;
    }
});
</script>
<script language="JavaScript" type="text/javascript" src="https://code.jquery.com/jquery-1.2.6.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script type="text/javascript">
siteUrl = '<?php echo URL::to('/'); ?>/';
bannerUrl = '<?php config('paths.home_url') . config('paths.medium-banners-thumb')?>';
</script>