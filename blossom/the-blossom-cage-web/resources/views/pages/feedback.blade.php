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
                    <div class="cProfile">
                        <div class="MenuBox">
                            <p><i class="icon icon-user"></i> Change Password </p>
                            @if(Auth::check())
                            @include('partials.mobile_menu')
                            @endif
                        </div><!--MenuBox-->
                        <div class="eHead">
                            <h3> {{ __('localization.feedback_btn')}}</h3>
                            <p> {{ __('localization.feedback_desc')}}</p>
                        </div>
                        <form method="POST" action="{{route('storeFeedback' , ['lang' => Session::get('locale')])}}">
                            @csrf
                            <div class="box1 w100">
                                <div class="cFields">
                                    <div class="form-group2">
                                        <label> {{ __('localization.first_name')}}*</label>
                                        <input type="text" required="" value="{{Auth::user()->first_name}}">
                                        <input type="hidden" value="feedback" name="type">
                                    </div>
                                    <div class="form-group2">
                                        <label> {{ __('localization.last_name')}}*</label>
                                        <input type="text" required="" value="{{Auth::user()->last_name}}">
                                    </div>
                                    <div class="form-group2">
                                        <label> {{ __('localization.email')}}*</label>
                                        <input type="text" required="" disabled="" value="{{Auth::user()->email}}">
                                    </div>
                                    <div class="form-group2">
                                        <label>{{ __('localization.phone_number')}}*</label>
                                        <input type="text" required="" value="{{Auth::user()->phone_no}}" disabled="">
                                    </div>
                                    <div class="form-group1" >
                                        <label> {{ __('localization.feedback_write')}}</label>
                                        <textarea name="feedback" placeholder=" {{ __('localization.feedback_write')}}...">{{old('feedback')}}</textarea>
                                    </div>
                                    <button type="submit" class="def-btn"> {{ __('localization.submit')}}</button>
                                </div><!--cFields-->
                            </div><!--box2-->
                        </form>



                    </div><!--Box_right-->
                </div>
            </div><!--row-->
        </div><!--row-->
    </div>
</section><!--Profilepage-->

@endsection
