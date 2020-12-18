@extends('layouts.main')
@section('content')
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Update Product </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="#" class="kt-subheader__breadcrumbs-link">
                    Product Images    
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="#" class="kt-subheader__breadcrumbs-link">
                    Add Image
                </a>

            </div>

        </div>
    </div>

    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="row">
            <div class="col-md-8">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Product Information Schema
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('storeImage')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-center p-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <div class="btn btn-dark">
                                                    <input type="file" class="file-upload" id="file-upload-item"
                                                           name="profile_picture" accept="image/*">
                                                    Upload New Photo
                                                </div>
                                                <span class="form-text text-muted">eg (H:1200px X W:1200px) – file size  1 to 5MB</span>
                                            </div>

                                        </div>
                                    </div>                      
                                    <input type="hidden" name="item_uuid" value="{{$uid}}"/>
                                    <input id="image_name" type="hidden" name="image" />
                                </div>
                            </div>
                            <div class="form-group row">    
                                <label class="col-lg-2 col-form-label">Preview</label>
                                <img id="prev" style="padding-top: 10px !important;" height="257" width="257" alt="No Image" src="{{asset('public/theme-images/camera.png')}}" />
                            </div>
                            <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                                <div class="kt-form__actions">
                                    <div class="col-md-3" ></div>
                                    <div class="col-md-3" ></div>
                                    <div class="col-md-3" ></div>
                                    <div class="col-md-3 float-right">
                                        <button type="submit" class="btn btn-success" >Add</button>
                                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!--end::Form-->
            </div>
        </div>
    </div>
</div>


<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style=" min-width: 500px;">
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

                <button type="button" class="btn btn-block btn-dark" id="upload" > 
                    Crop And Upload
                </button>
            </div>
        </div>
    </div>
</div>
@endsection