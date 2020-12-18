<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
{{--        <script type="text/javascript" src="//w.dev-scandi.com/scandi-window-1.0.0.js"></script>--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Blossom Cage</title>
        @include('templates.css')

    </head>
    <body id="body">
        <div id="preloader">
            <div id="loader">
                <a class="dlogo2" href="javascript:void(0)"><img alt="" width="145" src="{{asset('public/assets/images/logo-color.png')}}"></a>
            </div><!--loader-->
        </div> <!--preloader-->
        <script type="text/javascript">
            var csrfToken = $('[name="csrf_token"]').attr('content');

            setInterval(refreshToken, 3600000); // 1 hour

            function refreshToken(){
                $.get('refresh-csrf').done(function(data){
                    csrfToken = data; // the new token
                });
            }

            setInterval(refreshToken, 3600000); // 1 hour

        </script>
        @include('partials.dashboardMenu')
        <div class="shadow"></div>
@include('components.header')
        <div @if(Route::current()->getName()  ===  'home') class="ChbibBox" @endif>
            @yield('content')
        </div>
@include('components.footer')
@include('templates.js')
        @include('partials.f_password')
        @include('partials.search')
        @include('partials.signup')
        @include('partials.singnin')
        @include('partials.successMessage')
        @include('partials.errorMessage')
        @include('partials.successToCart')
        @include('partials.alertForDeleteMessage')
        @include('partials.successToWishlist')
        @include('partials.checkout')
    </body>
</html>
