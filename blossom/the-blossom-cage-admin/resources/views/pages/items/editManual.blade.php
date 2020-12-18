@extends('layouts.main')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-md-8">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Product Manual Data
                        </h3>
                    </div>
                </div>
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('updateManual')}}" method="POST"  enctype="multipart/form-data">

                    <input type="hidden" name="uuid" value="{{$manual->uuid}}">
                    <input type="hidden" name="item_id" value="{{$manual->item_id}}">
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
                                <input maxlength="254" type="text" class="form-control" placeholder="" name="title" value="{{$manual->title}}">
                                <span class="form-text text-muted">Please enter title</span>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <span class="form-text">Upload New File</span>
                                <input id="pdf" type="file" class="form-control" placeholder="" name="file" accept=".PDF">
                                <br>
                                <a target="_blank"  href="{{config('paths.home_url') . 'manuals/' . $manual->file}}"> <i class="fa fa-file-pdf"> </i> Preview/Download existing</a>
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