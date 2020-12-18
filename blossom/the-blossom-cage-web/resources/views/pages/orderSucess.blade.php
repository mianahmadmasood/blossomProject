@extends('layouts.item_listing')
@section('content')
<section class="Profilepage">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="cProfile">
                    <div class="eHead">
                        <h3> {{ __('localization.order_placed')}}</h3>
                        @include('partials.messages')
                    </div>
                    <div class="box1 w100 confirmation_box">
                        <img class="checked_img" src="{{asset('public/images/checked.png')}}">
                        <p>  {{ __('localization.order_s1')}}</p>
                        <p>  {{ __('localization.order_s2')}}</p>
                        <p class="confirmation_text">  {{ __('localization.order_s3')}} <a style="color: #5E7976;" href="{{route('orderDetails', ['lang' => Session::get('locale'), 'uuid' => $order_id])}}">{{$order_token}}</a></p>
                        <a href="{{route('searchItem' , ['lang' => Session::get('locale')])}}" class="def-btn confirmation_btn"> {{ __('localization.goto_sotre')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
