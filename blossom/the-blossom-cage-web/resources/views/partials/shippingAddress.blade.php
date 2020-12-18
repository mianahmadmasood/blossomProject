
<style>
    .intl-tel-input .flag-dropdown { display: none; }
    .intl-tel-input input[type=tel], .intl-tel-input input[type=text] { padding-left: 12px; }
    </style>
@if(!Auth::check())
    <h6 id="h_shipping"> {{ __('localization.guest_info')}}</h6>
    <div id="f_shipping" class="cFields">
        <div class="form-group2">
            <label> {{ __('localization.first_name')}} <span style="color: red">*</span></label>
            <input maxlength="25" id="f_name" name="first_name" type="text" required=""
                   value="{{ Auth::check() ? Auth::user()->first_name : session()->get('first_name')}}"
                   placeholder=" {{ __('localization.first_name')}}">
        </div>
        <div class="form-group2">
            <label> {{ __('localization.last_name')}}<span style="color: red">*</span></label>
            <input maxlength="25" id="l_name" name="last_name" type="text" required=""
                   value="{{ Auth::check() ? Auth::user()->last_name : session()->get('last_name') }}"
                   placeholder=" {{ __('localization.last_name')}}">
        </div>
        @if(Auth::check())
            <div class="form-group2">
                <label>{{ __('localization.email')}}<span style="color: red">*</span></label>
                <input maxlength="49" id="email-1" name="email" type="email" disabled="" value="{{Auth::user()->email}}"
                       placeholder=" {{ __('localization.email')}}">
                <input name="email" type="hidden" value="{{Auth::user()->email}}">
            </div>
        @else
            <div class="form-group2">
                <label>{{ __('localization.email')}}<span style="color: red">*</span></label>
                <input maxlength="49" id="email-1" name="email" type="email" value="{{session()->get('email')}}"
                       placeholder=" {{ __('localization.email')}}">
            </div>
        @endif
        <div class="form-group2 inputPhone">
            <label> {{ __('localization.phone_number')}}<span style="color: red">*</span></label>
            <input maxlength="25" id="phone_no" name="phone_no" type="tel"
                   @if(Session::has('error_message'))
                       @if(session::get('error_message') == 'your guest phone number is not valid. please enter the valid phone number')
                       class="field-error"
                       @endif
                       @if(session::get('error_message') == 'هاتف ضيفك غير صالح. يرجى إدخال رقم الهاتف صالح')
                       class="field-error"
                       @endif
                   @endif
                   value="{{Auth::check() ? Auth::user()->phone_no :  Session::get('phone_no')}}"
                    maxlength="15">
        </div>


    </div><!--cFields-->
    <input name="user_login_flag" id="user_login_flag" type="hidden" value="0">
    <input name="is_guest_login" id="is_guest_login" type="hidden" value="0">
@else
    <input name="user_login_flag" id="user_login_flag" type="hidden" value="1">
    <input name="is_guest_login" id="is_guest_login" type="hidden" value="1">
    <input name="email" type="hidden" value="{{Auth::user()->email}}">
    <input name="first_name" type="hidden" value="{{Auth::user()->first_name}}">
    <input name="last_name" type="hidden" value="{{Auth::user()->last_name}}">
    <div style="display: none">
    <input name="phone_no" id="phone_no" type="hidden" value="{{Auth::user()->phone_no}}">
    </div>
@endif



<h6 id="h_shipping"> {{ __('localization.shipping_address')}}</h6>
<div id="f_shipping2" class="cFields">
    <div class="form-group2">
        <label> {{ __('localization.first_name')}} <span style="color: red">*</span></label>
        <input maxlength="25" id="shipping_first_name" name="shipping_first_name" type="text" required=""
               value="{{ Auth::check() ? Auth::user()->first_name : Session('first_name')}}"
               placeholder=" {{ __('localization.first_name')}}">
    </div>
    <div class="form-group2">
        <label> {{ __('localization.last_name')}}<span style="color: red">*</span></label>
        <input maxlength="25" id="shipping_last_name" name="shipping_last_name" type="text" required=""
               value="{{ Auth::check() ? Auth::user()->last_name : Session('last_name')}}"
               placeholder=" {{ __('localization.last_name')}}">
    </div>

    <div class="form-group2 inputPhone">
        <label> {{ __('localization.phone_number')}}<span style="color: red">*</span></label>
        <input maxlength="25" id="shipping_phone_no" name="shipping_phone_no" type="tel"
               @if(Session::has('error_message'))
               @if(session::get('error_message') == 'your shipping phone number is not valid. please enter the valid phone number')
               class="field-error"
               @endif
               @if(session::get('error_message') == 'رقم هاتف الشحن الخاص بك غير صالح. يرجى إدخال رقم الهاتف صالح')
               class="field-error"
               @endif
               @endif
               value="{{Auth::check() ? Auth::user()->phone_no :  Session::get('phone_no')}}"
                maxlength="15">
    </div>
    <div class="form-group2">
        <label> {{ __('localization.country')}}<span style="color: red">*</span></label>
        <select class="selectpicker" id="shipping_country" name="shipping_country">
            @if(!empty($address_data) && isset($address_data))
                @foreach($address_data as $row)
                    <option value="{{$row['id']}}-{{$row['en_name']}}-{{$row['ar_name']}}"
                            @if(!empty($user_profile) && $user_profile != null && $user_profile->country == $row['id'] || Session::get('shipping_country') == $row['id'] ) selected @endif>
                        @if(Session::get('locale') === 'ar')
                            {{$row['ar_name']}}
                        @else
                            {{$row['en_name']}}
                        @endif
                    </option>
                @endforeach
            @endif
        </select>
    </div>
    <input name="old_order_id" type="hidden" value="{{Session::get('old_order_id')}}">



    <div class="form-group2">
        <label> {{ __('localization.street_address')}}<span style="color: red">*</span></label>
        <input id="shpping_full_address" name="shipping_full_address" type="text"
               value="{{$user_profile != null ? $user_profile->full_address : Session::get('shipping_full_address')}}"
               placeholder=" {{ __('localization.street_address')}}">
    </div>
    <div class="form-group2 fixHeight" id="addshipping_city">
        <label> {{ __('localization.city')}}<span style="color: red">*</span></label>
        <select class="selectpicker" id="shipping_city" name="shipping_city" required>
            <option value="">{{ __('localization.select_your_city')}} </option>
            @if(!empty($address_data) && isset($address_data))
                @foreach($address_data[0]['cities'] as $row)
                    <option value="{{$row['id']}}-{{$row['en_name']}}-{{$row['ar_name']}}"
                            @if(!empty($user_profile) && $user_profile != null && $user_profile->city == $row['id'] || Session::get('shipping_city') == $row['en_name']  || Session::get('shipping_city') == $row['ar_name'] )
                            selected @endif >@if(Session::get('locale') === 'ar'){{$row['ar_name']}}@else{{$row['en_name']}}@endif
                    </option>
                @endforeach
            @endif
        </select>
    </div>


    <div class="form-group2">
        <label> {{ __('localization.state')}}<span style="color: red">*</span> </label>
        <input id="shipping_state" name="shipping_state" maxlength="45" type="text"
               value="{{$user_profile != null && $user_profile->state ? $user_profile->state :  Session::get('shipping_state')}}"
               placeholder="{{ __('localization.state')}}">
    </div>

    <div class="form-group2">
        <label> {{ __('localization.zip_code')}} <span style="color: red">*</span> </label>
        <input id="shipping_zipcode" name="shipping_zip_code"
               value="{{$user_profile != null && $user_profile->zip_code ? $user_profile->zip_code :  Session::get('shipping_zip_code')}}"
               placeholder="{{ __('localization.zip_code')}}" required="" type="number" min="0"
               oninput="validity.valid||(value='');" pattern="^[0-9]" onKeyPress="if (this.value.length == 8)
                    return false;">
    </div>

    <input name="is_same_billing" id="is_same_billing" type="hidden" value="1"/>
</div><!--cFields-->

<h6 id="h_shipping"> {{ __('localization.billing_address')}}</h6>


<div class="checkbx" style=" margin-top: -10px;">
    <div class="checkbox-row">
        <input type="checkbox" name="checkboxBilling" id="checkboxBilling" class="css-checkbox"
               checked="" value="0">
        <label id="paytabs_text" for="checkboxBilling"
               class="css-label lbletxt">  {{ __('localization.as_same')}} </label>
    </div><!--checkbox-row-->
</div><!--checkbox-row-->


<div id="f_shipping" class="cFields">
    <div class="billingDev"
         @if(Session::has('error_message'))
         @if(session::get('error_message') == 'your shipping phone number is not valid. please enter the valid phone number')
         @else
         style="display: none;"
         @endif
         @if(session::get('error_message') == 'رقم هاتف الشحن الخاص بك غير صالح. يرجى إدخال رقم الهاتف صالح')
         @else
         style="display: none;"
         @endif
         @else
         style="display: none;"
         @endif >

        <div class="form-group2">
            <label> {{ __('localization.first_name')}} <span style="color: red">*</span></label>
            <input maxlength="25" id="billing_first_name" name="billing_first_name" type="text" required=""
                   value="{{ Auth::check() ? Auth::user()->first_name : Session('first_name')}}"
                   placeholder=" {{ __('localization.first_name')}}">
        </div>
        <div class="form-group2">
            <label> {{ __('localization.last_name')}}<span style="color: red">*</span></label>
            <input maxlength="25" id="billing_last_name" name="billing_last_name" type="text" required=""
                   value="{{ Auth::check() ? Auth::user()->last_name : Session('last_name')}}"
                   placeholder=" {{ __('localization.last_name')}}">
        </div>

        <div class="form-group2 inputPhone">
            <label> {{ __('localization.phone_number')}}<span style="color: red">*</span></label>
            <input maxlength="25" id="billing_phone_no" name="billing_phone_no" type="tel"

                   @if(Session::has('error_message'))
                   @if(session::get('error_message') == 'your billing phone number is not valid. please enter the valid phone number')
                   class="field-error"
                   @endif
                   @if(session::get('error_message') == 'رقم هاتف الفواتير الخاص بك غير صالح. يرجى إدخال رقم الهاتف صالح')
                   class="field-error"
                   @endif
                   @endif

                   value="{{Auth::check() ? Auth::user()->phone_no :  Session::get('phone_no')}}"
                    maxlength="15">
        </div>
        <div class="form-group2">
            <label> {{ __('localization.country')}}<span style="color: red">*</span></label>
            <select class="selectpicker" id="billing_country" name="billing_country" >
                @if(!empty($address_data) && isset($address_data))
                    @foreach($address_data as $row)
                        <option value="{{$row['id']}}-{{$row['en_name']}}-{{$row['ar_name']}}"
                                @if(!empty($user_profile) && $user_profile != null && $user_profile->country == $row['id'] || Session::get('shipping_country') == $row['id'] ) selected @endif>
                            @if(Session::get('locale') === 'ar')
                                {{$row['ar_name']}}
                            @else
                                {{$row['en_name']}}
                            @endif
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <input name="old_order_id" type="hidden" value="{{Session::get('old_order_id')}}">
        <div class="form-group2">
            <label> {{ __('localization.street_address')}}<span style="color: red">*</span></label>
            <input id="billing_full_address" name="billing_full_address" type="text"
                   value="{{$user_profile != null ? $user_profile->full_address : Session::get('shipping_full_address')}}"
                   placeholder=" {{ __('localization.street_address')}}">
        </div>
        <div class="form-group2 fixHeight" id="addbilling_city">
            <label> {{ __('localization.city')}}<span style="color: red">*</span></label>
            <select class="selectpicker" id="billing_city" name="billing_city" >
                <option value="">{{ __('localization.select_your_city')}} </option>
                @if(!empty($address_data) && isset($address_data))
                    @foreach($address_data[0]['cities'] as $row)
                        <option value="{{$row['id']}}-{{$row['en_name']}}-{{$row['ar_name']}}"
                                @if(!empty($user_profile) && $user_profile != null && $user_profile->city == $row['id'] || Session::get('shipping_city') == $row['id'] ) selected @endif >
                            @if(Session::get('locale') === 'ar')
                                {{$row['ar_name']}}
                            @else
                                {{$row['en_name']}}
                            @endif
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="form-group2">
            <label> {{ __('localization.state')}}<span style="color: red">*</span> </label>
            <input id="billing_state" name="billing_state" maxlength="45" type="text"
                   value="{{$user_profile != null && $user_profile->state ? $user_profile->state :  Session::get('shipping_state')}}"
                   placeholder="{{ __('localization.state')}}">
        </div>
        <div class="form-group2">
            <label> {{ __('localization.zip_code')}} <span style="color: red">*</span> </label>
            <input id="billing_zipcode" name="billing_zip_code"
                   value="{{$user_profile != null && $user_profile->zip_code ? $user_profile->zip_code :  Session::get('shipping_zip_code')}}"
                   placeholder="{{ __('localization.zip_code')}}" required="" type="number" min="0"
                   oninput="validity.valid||(value='');" pattern="^[0-9]" onKeyPress="if (this.value.length == 8)
                    return false;">
        </div>
    </div>


    <h6> {{ __('localization.payment_method')}}</h6>
    <div class="checkbx" style=" margin-top: -10px;">
        <div class="checkbox-row">
            <input type="checkbox" name="payment_method" id="checkboxG99" class="css-checkbox"
                   @if(Session::get('payment_method') != 1) checked="" @endif value="0">
            <label id="paytabs_text" for="checkboxG99"
                   class="css-label lbletxt"> {{ __('localization.paytabs')}}</label>
            <div class="paymenMethods">
                <a href="javascript:void(0)" style="cursor: text;"><img src="{{asset('public/images/visa-card.png')}}">
                </a>
                <a href="javascript:void(0)" style="cursor: text;"><img src="{{asset('public/images/mastercard.png')}}">
                </a>
                <a href="javascript:void(0)" style="cursor: text;"><img
                        src="{{asset('public/images/america-card.png')}}"> </a>
            </div>
        </div><!--checkbox-row-->

        <div class="checkbox-row">
            <input type="checkbox" name="payment_method" id="checkboxG97" class="css-checkbox"
                   @if(Session::get('payment_method') != 1) checked="" @endif value="0">
            <label id="paytabs_text" for="checkboxG99"
                   class="css-label lbletxt"> {{ __('localization.paytabs')}}</label>
            <div class="paymenMethods">
                <a href="javascript:void(0)" style="cursor: text;"><img src="{{asset('public/images/visa-card.png')}}">
                </a>
                <a href="javascript:void(0)" style="cursor: text;"><img src="{{asset('public/images/mastercard.png')}}">
                </a>
                <a href="javascript:void(0)" style="cursor: text;"><img
                        src="{{asset('public/images/america-card.png')}}"> </a>
            </div>
        </div><!--checkbox-row-->

        <div class="checkbox-row w100">
            <input type="checkbox" name="payment_method" id="checkboxG98"
                   @if(Session::get('payment_method') == 1) checked="" @endif class="css-checkbox" value="1">
            <label id="cod_text" for="checkboxG98" class="css-label lbletxt"> {{ __('localization.cod')}}</label>
            <div class="paymenMethods2">
                <a href="javascript:void(0)" style="cursor: text;"><img
                        src="{{asset('public/images/cash-on-delivery.png')}}"> </a>

            </div>

        </div><!--checkbox-row-->
    </div>
    <h6> {{ __('localization.shipping_method')}}</h6>
    <div class="checkbx" style=" margin-top: -10px;">
        <div class="checkbox-row">
            <input type="checkbox" name="checkboxG4" id="checkboxG100" checked="" disabled="" class="css-checkbox">
            <label for="checkboxG100" class="css-label">SMSA</label>
        </div><!--checkbox-row-->
    </div>
    
</div><!--cFields-->


<style>
    .paymenMethods {
        float: left;
    }

    .paymenMethods a {
        float: left;
        width: 50px;
        margin: 0 10px 0 0;
    }

    .paymenMethods a img {
        width: 100%;
    }

    .paymenMethods2 {
        float: left;
    }

    .paymenMethods2 a {
        float: left;
        width: 35px;
        margin: 0 10px 0 0;
    }

    .paymenMethods2 a img {
        width: 100%;
    }

    .lbletxt {
        float: left !important;
        width: auto !important;
        margin: 9px 10px 35px 0 !important;
    }
</style>
