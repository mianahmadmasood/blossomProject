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
                            Edit Color Information Schema
                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right"  action="{{route('updateColor')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">English Color Name: <span style=" color: red;">*</span></label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Enter brand title" name="en_title" value="{{$color->en_title}}" maxlength="255">
                                <input type="hidden" class="form-control"  name="id" value="{{$color->id}}">
                                <span class="form-text text-muted">Please enter color name in English</span>
                            </div>
                            <label class="col-lg-2 col-form-label">Arabic Title:<span style=" color: red;">*</span></label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Enter brand title" name="ar_title" value="{{$color->ar_title}}" maxlength="255">
                                <span class="form-text text-muted">Please enter color name in Arabic</span>
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-lg-2 col-form-label">Color Code:<span style=" color: red;">*</span></label>--}}
{{--                            <div class="col-lg-3">--}}

{{--                                <input name="color_code" id="edit_color_code" type="text" size="50" value="{{$color->color_code}}"--}}
{{--                                       class="jscolor form-control">--}}
{{--                                <span class="form-text text-muted"> Please choose color from the color palette.</span>--}}
{{--                                <span id="cc_message" class="form-text"--}}
{{--                                      style=" color: red;  display: none;"></span>--}}
{{--                            </div>--}}

{{--                        </div>--}}
                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-success">Update</button>
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
<!--end::Portlet-->
@endsection