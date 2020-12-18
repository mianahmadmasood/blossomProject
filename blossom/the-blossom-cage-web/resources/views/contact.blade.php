@extends('layouts.item_listing')
@section('content')
<section class="cContact_single">
    <div class="container">
        @include('partials.messages')
        <div class="row">
            <div class="col-md-12">
                <div class="cCin">
                    <h2> {{ __('localization.c_btn')}}</h2>
                    <div class="cClft">
                        <h5> {{ __('localization.contact_slogan')}}</h5>
                        <p>{{ __('localization.email')}} <span>marketing@theblossomcage.com</span></p>
                        <p> {{ __('localization.phone_number')}} <span style=" direction: ltr !important;">+966 00000 0000</span></p>
                        <p> {{ __('localization.address_btn')}}<span> {{ __('localization.store_address')}}<br> {{ __('localization.conutry_name')}}</span></p>
                        <div class="w100">
                            <p> {{ __('localization.social_btn')}} </p>
                            <a href="javascript:void(0)"><img width="8" src="{{asset('public/assets/images/Facebook_Icon.png')}}"></a>
                            <a href="javascript:void(0)"><img width="20" src="{{asset('public/assets/images/Twitter_Icon.png')}}"></a>
                            <a href="javascript:void(0)"><img width="21" src="{{asset('public/assets/images/Instagram_Icon.png')}}"></a>

                        </div><!--w100-->
                    </div><!--cClft-->
                    <div class="cCrit">
                        <form id="myForm">
                            <div class="cFields">
                                @if(Auth::check())
                                <label> {{ __('localization.name')}}</label>
                                <input  maxlength="25" id="name_contact" type="text" required="" disabled="" value="{{Auth::check() ? Auth::user()->first_name . ' '. Auth::user()->last_name : ''}}">
                                <label> {{ __('localization.email')}}</label>
                                <input  maxlength="255"  id="email_contact" type="text" required=""  disabled=""  value="{{Auth::check() ? Auth::user()->email : ''}}">
                                <label> {{ __('localization.message')}}</label>
                                <textarea minlength="35" id="message_contact"> </textarea>
                                @else
                                <label> {{ __('localization.name')}}</label>
                                <input  maxlength="25" id="name_contact" type="text" required="">
                                <label> {{ __('localization.email')}}</label>
                                <input  maxlength="255"  id="email_contact" type="text" required="" >
                                <label> {{ __('localization.message')}}</label>
                                <textarea minlength="35" id="message_contact"> </textarea>
                                @endif
                                    <div id="succcess_message_c" style=" display: none;">
                                        <p id="messag_p_s" style=" color: green"></p>
                                    </div>
                                    <div id="error_message_c" style=" display: none;">
                                        <p id="messag_p_e" style=" color: red"></p>
                                    </div>

                                <a id="submitFeed" href="javascript:void(0)" class="def-btn"> {{ __('localization.send')}}</a>

                            </div><!--cFields-->
                        </form>
                    </div><!--cCrit-->
                </div><!--cCin-->
            </div><!--col-md-12-->
        </div><!--row-->
    </div><!--container-->
</section>
@endsection
