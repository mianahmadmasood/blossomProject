@extends('layouts.item_listing')
@section('content')
@inject('paths', 'App\Http\Services\Profile')
<section class="Profilepage">
    <div class="container">
        <div class="row">
            @include('partials.pagesSideMenu')	
            <div class="col-md-9">
                @include('partials.messages')
                <div class="Box_right">
                    <div class="cProfile">
                        <div class="MenuBox">
                            <p><i class="icon icon-user"></i>  {{ __('localization.c_password_btn')}}</p>
                            <button class="hamburger hamburger--slider" type="button">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div><!--MenuBox-->
                        <div class="eHead">
                            <h3> {{ __('localization.change_password')}}</h3>
                            <p> {{ __('localization.change_password_desc')}}</p>
                        </div>
                        <form id="chanepasswordform" action="{{route('updatePassword', ['lang' => app()->getLocale()])}}" method="post">
                            @csrf
                            <div class="box1 w100">
                                <div class="cFields col-md-8 mt-3 mb-4">
                                    <p id="message_password" class="password_message" style="display: none;"> <p>
                                    <div class="form-group1">
                                        <label> {{ __('localization.old_password')}}*</label>
                                        <input id="old_password" name="old_password" type="password" autocomplete="off">
                                    </div>	
                                    <div class="form-group1">
                                        <label> {{ __('localization.new_password')}}*</label>
                                        <input id="new_password" name="new_password"  type="password" autocomplete="off">
                                    </div>	
                                    <div class="form-group1">
                                        <label> {{ __('localization.con_password')}}*</label>
                                        <input id="con_password" type="password"  autocomplete="off">
                                    </div>
                                    <button  type="submit" id="changePassword" class="def-btn"> {{ __('localization.save_password')}}</button >
                                </div>	
                            </div>
                        </form>
                    </div><!--cProfile-->
                </div><!--Box_right-->
            </div>	
        </div><!--row-->
    </div>	
</section><!--Profilepage-->
@endsection