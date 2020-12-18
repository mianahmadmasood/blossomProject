@extends('layouts.item_listing')
@section('content')
@inject('paths', 'App\Http\Services\Profile')
<section class="Profilepage">
    <div class="container">
        @include('partials.messages')
        <div class="row">
            @include('partials.pagesSideMenu')
            <div class="col-md-9">

                <div class="Box_right">
                    <div class="MenuBox">
                        <p><i class="icon icon-user"></i> {{ __('localization.address_btn')}} </p>
                        @if(Auth::check())
                        @include('partials.mobile_menu')
                        @endif
                    </div><!--MenuBox-->
                    <div id="message" class="alert alert-danger" role="alert" style="display: none;">
                        This is a danger alert—check it out!
                    </div>
                    <div class="cProfile">
                        <div class="eHead">
                            <h3> {{ __('localization.shipping_address')}}</h3>
                            {{ __('localization.shipping_desc')}}
                        </div>
                        <form action="{{route('updateProfile', ['lang' => Session::get('locale')])}}" method="POST" >
                            @csrf
                            <div class="box1 w100">
                                <h6> {{ __('localization.shipping_address')}}</h6>
                                <div class="cFields">
                                    <div class="form-group2">
                                        <label> {{ __('localization.country')}}*</label>
                                        <select  name="address[country]" >
                                            @if(!empty($address_data) && isset($address_data))
                                                @foreach($address_data as $row)
                                                    <option value="{{$row['id']}}-{{$row['en_name']}}-{{$row['ar_name']}}" @if(!empty($profile['country']) && $profile['country'] == $row['id'])  selected @endif>
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
                                        <label> {{ __('localization.street_address')}}*</label>
                                        <input name="address[full_address]" type="text" required="" value="{{ isset($profile) && !empty($profile['full_address']) ? $profile['full_address'] : ''}}">
                                        <input name="is_address" type="hidden" value="1">
                                    </div>
                                    <div class="form-group3">
                                        <label> {{ __('localization.zip_code')}}*</label>
                                        <input  name="address[zip_code]" id="address_zip_code" required="" value="{{isset($profile) && !empty($profile['zip_code']) ? $profile['zip_code'] : '0'}}"   type="number" min="0" oninput="validity.valid||(value='');" pattern="^[0-9]"  onKeyPress="if(this.value.length==8) return false;">
                                    </div>
                                    <div class="form-group3">
                                        <label> {{ __('localization.state')}}</label>
                                        <input name="address[state]" type="text" maxlength="45" value="{{isset($profile) && !empty($profile['state']) ? $profile['state'] : ''}}">
                                    </div>
                                    <div class="form-group3">
                                        <label> {{ __('localization.city')}}*</label>
                                        <select id="shipping_city" name="address[city]" >
                                                @if(!empty($address_data) && isset($address_data))
                                                    @foreach($address_data[0]['cities'] as $row)
                                                        <option value="{{$row['id']}}-{{$row['en_name']}}-{{$row['ar_name']}}" @if(!empty($profile['city_id']) && $profile['city_id'] == $row['id']  ) selected @endif >
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
                                </div>
                                <div class="w100">
                                    <button type="submit" id="profileAddress" class="def-btn"> {{ __('localization.save_btn')}}</button>
                                    <a class="Reset" href="{{route('myProfile', ['lang' => App::getLocale()])}}"> {{ __('localization.cancel_btn')}}</a>
                                </div>
                            </div><!--box1-->
                        </form>
                    </div><!--cProfile-->
                </div><!--Box_right-->
            </div>
        </div><!--row-->
    </div>
</section><!--Profilepage-->
@endsection
