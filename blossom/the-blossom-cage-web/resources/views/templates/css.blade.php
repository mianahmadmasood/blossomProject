<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="shortcut icon" href="{{asset('public/assets/images/favicon.ico')}}" type="image/x-icon">

    <link rel="icon" href="{{asset('public/assets/images/favicon.ico')}}" type="image/x-icon">


<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Unna:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
      integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/brands.css"
      integrity="sha384-nT8r1Kzllf71iZl81CdFzObMsaLOhqBU1JD2+XoAALbdtWaXDOlWOZTR4v1ktjPE" crossorigin="anonymous">


    <link href="{{asset('public/assets/css/icomoon.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/css/bootstrap-4.0.0.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/css/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/css/owl.theme.default.css')}}" rel="stylesheet" type="text/css"/>
    @if(App::getLocale() === 'ar')
        <!-- <link href="{{asset('public/assets/css/chbib_ar.css')}}" rel="stylesheet" type="text/css"/> -->
    @else
        <!-- <link href="{{asset('public/assets/css/chbib.css')}}" rel="stylesheet" type="text/css"/> -->
    @endif

    <link href="{{asset('public/assets/css/blossom.css')}}" rel="stylesheet" type="text/css"/>
   
    <link href="{{asset('public/assets/css/blossom0.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('public/assets/css/blossom_mobile.css')}}" rel="stylesheet" type="text/css"/>
  
    

<link href="{{asset('public/assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>


<link href="{{asset('public/css/custom.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('public/build/css/intlTelInput.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<script src="{{asset('public/assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>


<script type="text/javascript">
    baseUrl = '<?php echo URL::to('/'); ?>/';
    currentUrl = '<?php echo URL::current(); ?>';
    currentUrl_path = '<?php echo Request::path(); ?>';
    console.log('currentUrl', currentUrl);
    console.log('currentUrl_path', currentUrl_path);

    locale = '<?php echo Session::get('locale'); ?>';
    locale_app = '<?php echo App::getLocale(); ?>';
    currency = '<?php echo Session::get('cur_currency'); ?>';



</script>
<script src="{{asset('public/js/messages.js')}}"></script>
