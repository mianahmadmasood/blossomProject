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
                                Colors Information Schema
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('storecolor')}}"
                          method="POST" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Color Name English: <span
                                            style=" color: red;">*</span></label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" placeholder="Enter color name"
                                           name="en_title" value="{{old('en_title')}}" maxlength="255">
                                    <span class="form-text text-muted">Please enter color name in English</span>
                                </div>
                                <label class="col-lg-2 col-form-label">Color Name  Arabic:<span style=" color: red;">*</span></label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" placeholder="Enter color name"
                                           name="ar_title" value="{{old('ar_title')}}" maxlength="255">
                                    <span class="form-text text-muted">Please enter color name in Arabic</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Color Picker:<span style=" color: red;">*</span></label>
                                <div class="col-lg-3">
                                    <input name="color_code" id="color_code" type="text" size="50" value="#eecccc"
                                           class="jscolor form-control">
                                    <span class="form-text text-muted"> Please choose color from the color palette.</span>
                                    <span id="cc_message" class="form-text"
                                          style=" color: red;  display: none;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-8"></div>
                                    <div class="col-lg-4">
                                        <button type="submit" id="fileBrand" class="btn btn-success">Submit</button>
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