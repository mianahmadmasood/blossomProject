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
                            Update Password
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('passwordUpate')}}" method="POST">
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
                            <label class="col-lg-2 col-form-label">Current Password: <span style=" color: red;">*</span></label>
                            <div class="col-lg-3">
                                <input type="password" class="form-control" placeholder="Enter your current password here" name="old_password" maxlength="45">
                            </div>
                            <label class="col-lg-2 col-form-label">New Password:<span style=" color: red;">*</span></label>
                            <div class="col-lg-3">
                                <input type="password" class="form-control" placeholder="Enter your new password here" name="new_password" maxlength="45" >

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Confirm Password<span style=" color: red;">*</span></label>
                            <div class="col-lg-3">
                                <input type="password" class="form-control" placeholder="Enter your new password again" name="confirm_password" maxlength="45" >

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