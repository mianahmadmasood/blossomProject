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
                            Technical Video Description
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('storeVideo')}}" method="POST" >
                    <input type="hidden" name="item_id" value="{{$uid}}">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="kt-portlet__head-label">
                            <h5 class="kt-portlet__head-title">
                                Item Video
                            </h5>
                        </div>
                        <div class="form-group row" >
                            <div class="col-md-3">
                                <span class="form-text">Title(English)</span>
                                <input type="text" class="form-control" placeholder="" name="en_title" value="{{old('en_title')}}" maxlength="255">
                                <span class="form-text text-muted">Please enter English title for your video</span>
                            </div>

                            <div class="col-md-3">
                                <span class="form-text">Title(Arabic)</span>
                                <input type="text" class="form-control" placeholder="" name="ar_title" value="{{old('ar_title')}}" maxlength="255">
                                <span class="form-text text-muted">Please enter English title for your video</span>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <div class="col-md-3">
                                <span class="form-text">URL(English)</span>
                                <input type="url" class="form-control" placeholder="" name="en" value="{{old('en')}}" maxlength="255">
                                <span class="form-text text-muted" style=" color: red;">
                                    Please enter English URL for your video.
                                    You must ensure the URL contains embed rather watch as the /embed endpoint allows outside requests, whereas the /watch endpoint does not.
                                </span>
                            </div>
                            <div class="col-md-3">
                                <span class="form-text">URL(Arabic)</span>
                                <input type="url" class="form-control" placeholder="" name="ar"  value="{{old('ar')}}" maxlength="255">
                                <span class="form-text text-muted" style=" color: red;">
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
{{--                                    <a href="javascript:void(0)" id="mycancellBtn" class="btn btn-secondary">Cancel</a>--}}
                                    <a href="{{route('showItem', ['uid' => $uid])}}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-success">Submit</button>
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