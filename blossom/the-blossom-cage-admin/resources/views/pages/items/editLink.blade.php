@extends('layouts.main')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Product Variant Information Schema
                        </h3>
                    </div>
                </div>
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('updateVideo')}}" method="POST">

                    <input type="hidden" name="uuid" value="{{$video->uuid}}">
                    <input type="hidden" name="item_id" value="{{$video->item_id}}">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="kt-portlet__head-label">
                            <h5 class="kt-portlet__head-title">
                                Product Manual
                            </h5>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <span class="form-text">Title</span>
                                <input type="text" class="form-control" placeholder="" name="title" value="{{$video->title}}">
                                <span class="form-text text-muted">Please enter title</span>
                            </div>
                            <div class="col-md-4">
                                <span class="form-text">New Embedded Link</span>
                                <input type="text" class="form-control" placeholder="" name="video" value="{{$video->video}}">
                                <span class="form-text" style=" color: red;">
                                    Please enter English URL for your video.
                                    You must ensure the URL contains embed rather watch as the /embed endpoint allows outside requests, whereas the /watch endpoint does not.
                                </span>                             
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <span class="form-text">Existing Video</span>
                                <iframe width="420" height="315" src="{{$video->video}}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3 ">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{route('showItem', ['uid' => $itemUuid])}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection