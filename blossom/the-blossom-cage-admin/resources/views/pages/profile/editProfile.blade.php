@extends('layouts.main')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Update Profile
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('userProfileUpate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-4">
                        <div class="kt-portlet kt-portlet--height-fluid">
                            <div class="kt-widget14">
                                <div class="kt-widget19__userpic">
                                    <img style=" max-width: 100px; border-radius: 50px;" src="{{config('paths.home_url') . config('paths.medium-profiles-thumb') . Auth::user()->image}}" alt="">
                                </div>
                            </div>
                            <div class="kt-widget14__legends" style=" padding-left: 25px;">
                                <h4 class="card-title">{{Auth::user()->first_name}}</h4>
                                <p class="card-text"><i class="fa fa-envelope"></i> : {{Auth::user()->email}}</p>
                                <p class="card-text"> <i class="fa fa-phone"></i> : {{Auth::user()->phone_no}}</p>
                            </div>
                        </div>

                    </div>
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">First Name: <span style=" color: red;">*</span></label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Enter your first name here" name="first_name" maxlength="255" value="{{Auth::user()->first_name}}">
                            </div>
                            <label class="col-lg-2 col-form-label">Last Name:<span style=" color: red;">*</span></label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Enter your last name here" name="last_name" maxlength="255" value="{{Auth::user()->last_name}}">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Profile Image:</label>
                            <div class="col-lg-3">
                                <input id="file" type="file" name="image" accept="image/*">
                                <span class="form-text text-muted">Please select image for Profile</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
@endsection