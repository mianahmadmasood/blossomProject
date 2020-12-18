@extends('layouts.main')
@section('content')
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Create Employee Account</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="#" class="kt-subheader__breadcrumbs-link">
                    Employee
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="#" class="kt-subheader__breadcrumbs-link">
                    Create Account
                </a>

            </div>

        </div>
    </div>

    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Employee Basic Details
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('storeEmployee')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Warehouse:<span style=" color: red;">*</span></label>
                                <div class="col-lg-3">
                                    <select required style=" width: 100%;"class="js-example-basic-single-brands" id="js-example-basic-single-brands" name="warehouse_id">
                                        <option value="">Select Warehouse:</option>
                                        @foreach($warehouses as $warehouse)
                                            @if( $warehouse->id == old('warehouse_id'))
                                                <option value="{{$warehouse->id}}"  selected> {{$warehouse->en_title}} - {{$warehouse->city}} - {{$warehouse->phone}}</option>
                                            @else
                                                <option value="{{$warehouse->id}}" > {{$warehouse->en_title}} - {{$warehouse->city}} - {{$warehouse->phone}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">First Name:<span style=" color: red;">*</span></label>
                                <div class="col-lg-3">
                                    <input type="text" maxlength="45" class="form-control" placeholder="Enter employee first name..." name="first_name" value = "{{ old('first_name') }}"  >
                                    <span class="form-text text-muted">Please enter employee first name.</span>
                                </div>
                                <label class="col-lg-2 col-form-label">Last Name: <span style=" color: red;">*</span></label>
                                <div class="col-lg-3">
                                    <input type="text" maxlength="45" class="form-control" placeholder="Enter employee last name..." name="last_name" value = "{{ old('last_name') }}">
                                    <span class="form-text text-muted">Please enter employee last name.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Country Code: <span style=" color: red;">*</span></label>
                                <div class="col-lg-3">
                                    @include('partials.countryCode')
                                </div>
                                <label class="col-lg-2 col-form-label">Contact Number: <span style=" color: red;">*</span></label>

                                <div class="col-lg-3 float-lg-right">
                                     <input  class="form-control"  placeholder="Enter employee contact number..." name="phone_no" value="{{ old('phone_no') }}"   type="number" min="0" oninput="validity.valid||(value='');" pattern="^[0-9]"  onKeyPress="if(this.value.length==15) return false;"     >
                                    <span class="form-text text-muted">Please enter employee contact number e.g 3001234567.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Email:<span style=" color: red;">*</span></label>
                                <div class="col-lg-3">
                                    <input type="email" class="form-control" placeholder="Enter employee email..." name="email" value = "{{ old('email') }}" maxlength="255">
                                    <span class="form-text text-muted">Please enter employee email e.g abc@chbib.com</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Account Password: <span style=" color: red;">*</span></label>
                                <div class="col-lg-3">
                                    <input type="password" class="form-control" placeholder="type password for this account.." name="password" maxlength="255">
                                    <span class="form-text text-muted" style="color: red !important; ">Please enter strong password, which should be hard to guess. Employee can login using his/her email and password</span>
                                </div>
                                <label class="col-lg-2 col-form-label">Confirm Password: <span style=" color: red;">*</span></label>
                                <div class="col-lg-3">
                                    <input type="password" class="form-control" placeholder="type password again.." name="confirm_password" maxlength="255">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Account Picture:</label>
                                <div class="col-lg-3">
                                    <div class="d-flex justify-content-center p-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <div class="btn btn-dark">
                                                    <input type="file" class="file-upload" id="file-upload"
                                                           name="employee_picture" accept="image/*">
                                                    Upload New Photo
                                                </div>
                                                <span class="form-text text-muted">eg (H:800px X W:800px) – file size  1 to 5MB</span>
                                            </div>

                                        </div>
                                    </div>
                                    <input id="image_name" type="hidden" name="image" value="{{old('image') }}"/>
                                </div>
                                <label class="col-lg-2 col-form-label">Preview</label>

                                @if(old('image') !== null)
                                    <img id="prevEmployeesImage" style="padding-top: 10px !important;" height="257"
                                         width="257"
                                         alt="No Image" src="{{config('paths.home_url') . 'thumbnails/medium/profile-images/' .  old('image')}}"
                                    />

                                @else
                                    <img id="prevEmployeesImage" style="padding-top: 10px !important;" height="257"
                                         width="257"
                                         alt="No Image" src="{{asset('public/theme-images/camera.png')}}"/>
                                @endif


                            </div>

                            <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                            <button type="submit" class="btn btn-success">Create Account</button>
                                        </div>
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
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style=" min-width: 400px;">
            <!-- Modal Header -->
            <div class="modal-header" style="padding: 5px">
                <h4 class="modal-title">Crop Image And Upload</h4>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="resizer"></div>

                <span style="cursor: pointer;" class="btn rotate float-lef" data-deg="90" >
                    <i class="fas fa-undo"></i></span>
                <span style="cursor: pointer;" class="btn rotate float-right" data-deg="-90" >
                    <i class="fas fa-redo"></i></span>

                <button type="button" class="btn btn-block btn-dark" id="upload-employee-image" >
                    Crop And Upload
                </button>
            </div>
        </div>
    </div>
</div>
@endsection