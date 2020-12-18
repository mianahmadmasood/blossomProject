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
                        <p><i class="icon icon-user"></i> {{ __('localization.my_profile')}} </p>
                        @if(Auth::check())
                        @include('partials.mobile_menu')
                        @endif
                    </div><!--MenuBox-->
                    <div class="cProfile">
                        <div class="eHead">
                            <h3> {{ __('localization.personal_details')}}</h3>
                            <p> {{ __('localization.personal_desc')}}</p>
                        </div>
                        <div class="box1 w100">
                            <div class="profileInfo" @if(Session::has('error_message'))style="display: none;"   @endif >
                                <div class="pfile">
                                    <div class="box">
                                        @if(Auth::user()->image)
                                        <img  style="max-width: 140px; min-height:140px;" src="{{ config('paths.medium_profile') . Auth::user()->image}}">
                                        @else
                                        <img src="{{asset('public/images/user.png')}}">
                                        @endif
                                    </div>
                                </div><!--pfile-->
                                <p> {{ __('localization.first_name')}} <span> {{Auth::user()->first_name}} </span></p>
                                <p> {{ __('localization.last_name')}} <span> {{Auth::user()->last_name}}</span></p>
                                <p> {{ __('localization.email')}} <span> {{Auth::user()->email}}</span></p>
                                <p> {{ __('localization.phone_number')}}   <span style="direction: ltr!important;"> {{Auth::user()->phone_no}}</span></p>
                                <div class="w100">
                                    <a style="cursor: pointer;" id="editProfile" class="def-btn"> {{ __('localization.edit_profile')}}</a>
                                </div>
                            </div><!--profileInfo-->
                            <div id="editProfileForm" class="w100" @if(Session::has('error_message')) @else style="display: none;" @endif >
                                <div class="profilein">
                                    <div class="d-flex justify-content-center p-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ __('localization.Uploadyourimagehere')}}</h5>
                                                <div class="profile-img p-3">
                                                    @if(Auth::user()->image)
                                                    <img  id="profile-pic" src="{{ config('paths.medium_profile') . Auth::user()->image}}">
                                                    @else
                                                    <img src="{{asset('public/assets/images/camera.png')}}" id="profile-pic">
                                                    @endif
                                                </div>
                                                <div class="btn btn-dark">
                                                    <input type="file" class="file-upload fileAgain" id="file-upload"
                                                           name="profile_picture" accept="image/*">
                                                    {{ __('localization.UploadNewPhoto')}}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- The Modal -->
                                    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="Full_mapTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="max-width: 350px; margin:40px auto 100px">
                                            <div class="modal-content">
                                                <!-- Modal Header -->

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <h4 class="modal-title cropTitle">Crop Image And Upload</h4>
                                                    <div class="body-message">

                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div id="resizer"></div>
                                                    <button class="btn rotate float-lef" data-deg="90" >
                                                        <i class="fas fa-undo"></i></button>
                                                    <button class="btn rotate float-right" data-deg="-90" >
                                                        <i class="fas fa-redo"></i></button>
                                                    <hr>
                                                    <button class="btn btn-block btn-dark" id="upload" >
                                                        Crop And Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{route('updateProfile', ['lang' => app()->getLocale()])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="w100" style="position: relative; " >
                                        <div class="cFields col-md-12 mt-3 mb-4">
                                            <div class="form-group2">
                                                <label> {{ __('localization.first_name')}}*</label>
                                                <input name="first_name" maxlength="25" type="text" required="" value="{{Auth::user()->first_name}}">
                                            </div>
                                            <div class="form-group2">
                                                <label> {{ __('localization.last_name')}}*</label>
                                                <input name="last_name" maxlength="25" type="text" required="" value="{{Auth::user()->last_name}}">
                                            </div>
                                            <div class="form-group2">
                                                <label> {{ __('localization.email')}}*</label>
                                                <input name="email" maxlength="49" type="text" required="" value="{{Auth::user()->email}}" disabled="">
                                            </div>
                                            <div class="form-group2 inputPhone">
                                                <label> {{ __('localization.phone_number')}}*</label>
                                                <input id="phone_no" name="phone_no" maxlength="15" type="text" required="" value="{{Auth::user()->phone_no}}" >
                                            </div>
                                            <div class="w100">
                                                <button style="cursor: pointer;" type="submit" class="def-btn"> {{ __('localization.save_profile')}}</button>
                                                <a style="cursor: pointer;" class="Reset"  id="editProfileLink" > {{ __('localization.cancel_btn')}}</a>
                                            </div>
                                        </div><!--profileInfo-->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!--cProfile-->
                </div><!--Box_right-->
            </div>
        </div><!--row-->
    </div>
</section><!--Profilepage-->

@endsection
