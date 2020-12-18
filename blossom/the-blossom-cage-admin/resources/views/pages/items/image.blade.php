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
                    Update Product
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
                    <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('updateImage')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Image:<span style=" color: red;">*</span></label>
                                <div class="col-md-6">
                                    <input id="imgInp" type="file"  name="image" accept="image/*"  />
                                    <input type="hidden" name="uuid" value="{{$image->uuid}}"/>
                                    <input type="hidden" name="item_uuid" value="{{$image->item->uuid}}"/>
                                </div>
                            </div>
                            <div class="form-group row">    
                                <label class="col-lg-2 col-form-label">Preview</label>
                                <img id="prev" style="padding-top: 10px !important;"height="100" width="100" src="{{ config('paths.home_url') . 'items/' . $image->image}}" alt="No Image" />
                            </div>
                        </div>
                        <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                            <div class="kt-form__actions">
                                <div class="col-md-6" ></div>
                                <div class="col-md-6" >
                                    <button type="submit" class="btn btn-success" >Update</button>
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