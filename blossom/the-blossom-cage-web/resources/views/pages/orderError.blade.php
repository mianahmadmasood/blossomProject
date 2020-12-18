@extends('layouts.item_listing')
@section('content')
<section class="Profilepage">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="Box_right">
                    <div class="MenuBox">
                        <div class="MenuBox">
                            <p><i class="icon icon-cart"></i> {{ __('localization.order_rejected')}}</p>
                        </div><!--MenuBox-->
                    </div>
                </div>
                <div class="cProfile">
                    <div class="eHead">
                        <h3> {{ __('localization.order_rejected')}}</h3>
                        @include('partials.messages')
                    </div>
                    <div class="box1 w100 confirmation_box">
                        <img class="checked_img" src="{{asset('public/images/warning.png')}}">
                        <p class="confirmation_text">  {{ $message}} </p>
                        <a href="{{route('searchItem' , ['lang' => Session::get('locale')])}}" class="def-btn confirmation_btn"> {{ __('localization.goto_sotre')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection