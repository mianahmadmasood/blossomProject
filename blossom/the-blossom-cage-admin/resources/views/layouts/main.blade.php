<!DOCTYPE html>
<html lang="en" >
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8"/>

        <title>Blossom Cage| Admin Portal</title>
        <meta name="description" content="Basic datatables examples"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script type="text/javascript">
            baseUrl = '<?php echo URL::to('/'); ?>/';
            token = '<?php echo csrf_token(); ?>';
            currentUrl = '<?php echo Request::url('/'); ?>';
        </script>
        @include('ingredients.css')
    </head>
    <!-- end::Head -->

    <!-- begin::Body -->
    <body id="body" class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"  >

        <div id="preloader" style="display: none">
            <div class="modal-backdrop show"></div>
            <div id="loader">
                <a class="" href="javascript:void(0)">
                    <img alt="" width="145" src="{{asset('public/images/imageloader.gif')}}">
                </a>
            </div><!--loader-->
        </div>
        <div id="alterdivmassagemain" style="display: none">
            <div class="modal-backdrop show"></div>
            <div class="modal modal-stick-to-bottom fade show" id="kt_modal_7" role="dialog" data-backdrop="false" aria-modal="true" style="padding-right: 15px; display: block;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alter Message</h5>
                        </div>
                        <div class="modal-body">
                            <p id="alterdivmassagess">
                            </p><!--loader-->
                       </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="alterclose" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" id="altersubmit" >Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="alterdivmassagemainForImage" style="display: none">
            <div class="modal-backdrop show"></div>
            <div class="modal modal-stick-to-bottom fade show" id="kt_modal_7" role="dialog" data-backdrop="false" aria-modal="true" style="padding-right: 15px; display: block;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alter Message</h5>
                        </div>
                        <div class="modal-body">
                            <p id="alterdivmassagessForImage">
                            </p><!--loader-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="altercloseForImage" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" id="altersubmitForImage" >Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- begin:: Page -->
        <!-- begin:: Header Mobile -->
        <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed " >
            <div class="kt-header-mobile__logo">
                <a href="{{route('dashboard')}}">
                    <img height="50" width="50" style="background-color: #ffff;" alt="Logo" src="{!! asset('public/theme-images/logo-light.png') !!}"/>
                </a>
            </div>
            <div class="kt-header-mobile__toolbar">
                <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
                <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
            </div>
        </div>
        <!-- end:: Header Mobile -->	
        <div id="page" class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                <!-- begin:: Aside -->
                <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
                @include('components.sideMenu')
                <!-- end:: Aside -->			
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                    <!-- begin:: Header -->
                    @include('components.header')
                    @include('components.sessionMessages')
                    <!-- end:: Header -->
                    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

                        @yield('content')
                    </div>				
                    <!-- begin:: Footer -->
                    @include('components.footer')
                    <!-- end:: Footer -->	
                </div>
            </div>
        </div>
        @include('ingredients.js')
    </body>
</html>