<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 7
Author: KeenThemes
Website: https://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" >
    <!-- begin::Head -->

    <!-- Mirrored from keenthemes.com/metronic/preview/default/custom/error/error-v3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Mar 2019 10:22:42 GMT -->
    <!-- Added by HTTrack --><meta https-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
    <head>
        <meta charset="utf-8"/>

        <title>Metronic | Error Page - 3</title>
        <meta name="description" content=""> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--begin::Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
            WebFont.load({
                google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
                active: function () {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        <link href="{{asset('public/css/error.css')}}" rel="stylesheet" type="text/css" />
        @include('ingredients.css')

    </head>
    <!-- end::Head -->

    <!-- begin::Body -->
    <body  class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"  >


        <!-- begin:: Page -->
        <div class="kt-grid kt-grid--ver kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v3" style="background-image: url(public/theme-images/error.jpg);">
                <div class="kt-error_container">
                    <span class="kt-error_number">
                        <h1>{{$ex->getCode()}}</h1>		 
                    </span> 	
                    <p class="kt-error_title kt-font-light">
                        How did you get here
                    </p>
                    <p class="kt-error_subtitle">
                        {{$ex->getMessage().$ex->getFile().$ex->getLine()}}
                    </p>		 
                </div>	 
            </div>
        </div>

        <script>
            var KTAppOptions = {"colors": {"state": {"brand": "#5d78ff", "dark": "#282a3c", "light": "#ffffff", "primary": "#5867dd", "success": "#34bfa3", "info": "#36a3f7", "warning": "#ffb822", "danger": "#fd3995"}, "base": {"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"], "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]}}};
        </script>
        @include('ingredients.js')
    </body>
</html>