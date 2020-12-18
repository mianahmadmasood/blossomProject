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
                            Product Technical Specifications 
                        </h3>
                    </div>
                </div>
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('storeItemSpecs')}}" method="POST">
                    <input type="hidden" name="item_id" value="{{$item->id}}">
                    <input type="hidden" name="uuid" value="{{$item->uuid}}">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="kt-portlet__head-label">
                            <h5 class="kt-portlet__head-title">
                                Product Specification
                            </h5>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Technical Specification(en):</label>
                            <div class="col-lg-3">
                                <textarea type="text" class="form-control" placeholder="Enter Technical Specification(en)" name="specs_en" >{{ old('specs_en') }}</textarea>
                                <span class="form-text text-muted">Please enter item technical specification in English</span>
                            </div>
                            <label class="col-lg-2 col-form-label">Technical Specification(ar):</label>
                            <div class="col-lg-3">
                                <textarea type="text" class="form-control" placeholder="Enter Technical Specification(ar)" name="specs_ar" >{{ old('specs_ar') }}</textarea>
                                <span class="form-text text-muted">Please enter item technical specification in Arabic</span>
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
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
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