<footer class="cfooter">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="footerIn">
                    <div class="fot_col_1">
                        <a href="{{route('searchItem')}}"><img src="{{asset('public/assets/images/logo-color.png')}}"></a>
                        <p>{{ __('localization.store_address')}}<br> {{ __('localization.conutry_name')}}</p>
                    </div><!--fot_col_1-->
                    <div class="fot_col_2">
                        <a href="{{route('contact')}}"> {{ __('localization.c_btn')}}</a>
                        <a href="{{route('store')}}">{{ __('localization.store_btn')}}</a>
                        <a href="{{route('faq')}}">{{ __('localization.faq_btn')}}</a>
                        <a href="{{route('delivery')}}">{{ __('localization.delivery_btn')}}</a>
                        <a href="{{route('payment')}}">{{ __('localization.payment_btn')}}</a>
                    </div><!--fot_col_2-->
                    <div class="fot_col_3">
                        <a href="https://www.facebook.com/"><img width="8" src="{{asset('public/assets/images/fb.png')}}"></a>
                        <a href="https://twitter.com/"><img width="21" src="{{asset('public/assets/images/tw.png')}}"></a>
                        <a href="https://www.instagram.com/"><img width="21" src="{{asset('public/assets/images/in.png')}}"></a>
                    </div><!--fot_col_3-->
                    <div class="fot_col_44">
                        <div class="fotLogo">
                            <a class="fotL" href="javascript:void(0)"><img width="46" src="{{asset('public/assets/images/fotLogo.png')}}"></a>
                            <a href="https://www.facebook.com"><img width="8" src="{{asset('public/assets/images/fb.png')}}"></a>
                            <a href="https://twitter.com/"><img width="21" src="{{asset('public/assets/images/tw.png')}}"></a>
                            <a href="https://www.instagram.com/"><img width="21" src="{{asset('public/assets/images/in.png')}}"></a>
                        </div><!--fotLogo-->
                        <div class="fottxt">

                            <p>{{ __('localization.store_address')}}<br> {{ __('localization.conutry_name')}}</p>
                            <a href="{{route('privacy')}}"> {{ __('localization.ploicy_btn')}}</a>
                            <a href="{{route('terms')}}">{{ __('localization.term_btn')}}</a>
                        </div><!--fottxt-->	
                    </div><!--fot_col_3-->
                </div><!--footerIn-->
                <div class="cRights">
                    <p>© {{date('Y')}} Blossom Cage. {{ __('localization.rights')}}</p>
                    <div class="float-right">
                        <a href="{{route('privacy')}}">{{ __('localization.ploicy_btn')}}</a>
                        <a href="{{route('terms')}}">{{ __('localization.term_btn')}}</a>
                    </div>
                </div><!--cRights-->
            </div><!--col-md-12-->
        </div><!--row-->
    </div><!--container-->
</footer>