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
                            Product Metadata(optional)
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('storeMeataData')}}" method="POST"  enctype="multipart/form-data">

                    <input type="hidden" name="item_id" value="{{$id}}">
                    <input type="hidden" name="variant_id" value="{{$v_uuid}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="kt-portlet__body">
                        <div class="kt-portlet__head-label">
                            <h5 class="kt-portlet__head-title">
                                Product Manual(optional)
                            </h5>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <span class="form-text">Title English</span>
                                <input type="text" class="form-control" placeholder="" name="manual[en_title]" maxlength="255" value="{{old('manual.en_title')}}">
                                <span class="form-text text-muted">Please enter title here</span>
                            </div>

                            <div class="col-md-3">
                                <span class="form-text">Title Arabic</span>
                                <input type="text" class="form-control" placeholder="" name="manual[ar_title]" maxlength="255" value="{{old('manual.ar_title')}}">
                                <span class="form-text text-muted">Please enter title here</span>
                            </div>

                        </div>
                        <div class="form-group row">

                            <div class="col-md-3">
                                <span class="form-text">Manual File(English)</span>
                                <input type="file" class="form-control" placeholder="" name="manual[en_file]" id="pdf" accept=".pdf" >
                                <span class="form-text text-muted">Please select pdf file for the user</span>
                            </div>
                            <div class="col-md-3">
                                <span class="form-text">Manual File(Arabic)</span>
                                <input type="file" class="form-control" placeholder="" name="manual[ar_file]" id="pdf" accept=".pdf" >
                                <span class="form-text text-muted">Please select pdf file for the user</span>
                            </div>

                        </div>

                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-portlet__head-label">
                            <h5 class="kt-portlet__head-title">
                                Product Videos(optional)
                            </h5>
                        </div>
                        <div class="form-group row" >
                            <div class="col-md-3">
                                <span class="form-text">Title(English)</span>
                                <input type="text" class="form-control" placeholder="" name="link[en_title]" maxlength="255" value="{{old('link.en_title')}}">
                                <span class="form-text text-muted">Please add URL title in English</span>
                            </div>

                            <div class="col-md-3">
                                <span class="form-text">Title(Arabic)</span>
                                <input type="text" class="form-control" placeholder="" name="link[ar_title]" maxlength="255" value="{{old('link.ar_title')}}">
                                <span class="form-text text-muted">Please URL title in Arabic</span>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <div class="col-md-3">
                                <span class="form-text">URL(English)</span>
                                <input type="url" class="form-control" placeholder="" name="link[en]" maxlength="255" value="{{old('link.en')}}">
                                <span class="form-text text-muted" style=" color: red;">
                                    Please enter English URL for your video.
                                    You must ensure the URL contains embed rather watch as the /embed endpoint allows outside requests, whereas the /watch endpoint does not.
                                </span>   
                            </div>
                            <div class="col-md-3">
                                <span class="form-text">URL(Arabic)</span>
                                <input type="url" class="form-control" placeholder="" name="link[ar]" maxlength="255" value="{{old('link.ar')}}">
                                <span class="form-text text-muted" style=" color: red;" >
                                    Please enter Arabic URL for your video.
                                    You must ensure the URL contains embed rather watch as the /embed endpoint allows outside requests, whereas the /watch endpoint does not.
                                </span>                   
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet__foot kt-portlet__foot--fit-x ">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3 ">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-success">Live Item</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Portlet-->
    @endsection