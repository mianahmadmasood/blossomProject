@extends('layouts.item_listing')
@section('content')
@inject('paths', 'App\Http\Services\Profile')

<section class="Profilepage">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('partials.messages')
                <div class="Box_right">
                    <div class="cProfile">
                        <div class="MenuBox">
                            <p><i class="icon icon-user"></i>  {{ __('localization.reset_password')}}</p>
                            @if(Auth::check())
                            @include('partials.mobile_menu')
                            @endif
                        </div><!--MenuBox-->
                        <div class="eHead">
                            <h3> {{ __('localization.reset_password')}}</h3>
                            <p> {{ __('localization.reset_your_password')}}</p>
                        </div>
                        <form id="chanepasswordform" action="{{route('updatResetPassword', ['lang' => app()->getLocale()])}}" method="post">
                            @csrf
                            <div class="box1 w100">
                                <div class="cFields col-md-8 mt-3 mb-4">
                                    <p id="message_password" class="password_message" style="display: none;"> <p>
                                    <div class="form-group1">
                                        <label> {{ __('localization.reset_code')}}*</label>
                                        <input id="old_password" name="reset_code" type="password" autocomplete="off">
                                    </div>	
                                    <div class="form-group1">
                                        <label> {{ __('localization.new_password')}}*</label>
                                        <input id="new_password" name="new_password"  type="password" autocomplete="off">
                                    </div>	
                                    <div class="form-group1">
                                        <label> {{ __('localization.con_password')}}*</label>
                                        <input name="confirm_password" id="con_password" type="password"  autocomplete="off">
                                    </div>
                                    <button  type="submit"  class="def-btn"> {{ __('localization.save_password')}}</button >
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