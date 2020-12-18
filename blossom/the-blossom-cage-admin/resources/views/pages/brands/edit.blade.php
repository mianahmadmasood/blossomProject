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
                            Edit Brand Information Schema
                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right"  action="{{route('updateBrand')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">English Title: <span style=" color: red;">*</span></label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Enter brand title" name="en_title" value="{{$brand->en_title}}" maxlength="255">
                                <input type="hidden" class="form-control"  name="id" value="{{$brand->id}}">
                                <span class="form-text text-muted">Please enter brand title in English</span>
                            </div>
                            <label class="col-lg-2 col-form-label">Arabic Title:<span style=" color: red;">*</span></label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Enter brand title" name="ar_title" value="{{$brand->ar_title}}" maxlength="255">
                                <span class="form-text text-muted">Please enter brand title in Arabic</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Brand Image:</label>
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-center p-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="btn btn-dark">
                                                <input type="file" class="file-upload" id="file-upload-brand"
                                                       name="brand_picture" accept="image/*">
                                                Upload New Photo
                                            </div>
                                            <span class="form-text text-muted">eg (H:1200px X W:1200px) – file size  1 to 5MB</span>
                                        </div>

                                    </div>
                                </div>
                                <input id="image_name" type="hidden" name="image"/>
                            </div>

                            @if(empty($brand->image))
                                <label class="col-lg-2 col-form-label">Preview</label>
                                <img id="prevBrandsImage" style="padding-top: 10px !important;" height="257"
                                     width="257" alt="No Image" src="{{asset('public/theme-images/camera.png')}}"/>
                            @else
                                <label class="col-lg-2 col-form-label">Existing Warehouse Image:</label>
                                <div class="col-lg-3">
                                    <img id="prevBrandsImage"  style="padding-top: 10px !important;" height="257"
                                         width="257" alt="No Image" src="{{config('paths.home_url') . 'thumbnails/medium/brands/' . $brand->image}}">
                                </div>

                            @endif
                            <br>

                        </div>
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

                <button type="button" class="btn btn-block btn-dark" id="upload-brand-image" >
                    Crop And Upload
                </button>
            </div>
        </div>
    </div>
</div>
@endsection