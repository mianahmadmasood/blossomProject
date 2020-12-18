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
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('updateItemSpecs')}}" method="POST">
                    <input type="hidden" name="uuid" value="{{$specs->uuid}}">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="kt-portlet__head-label">
                            <h5 class="kt-portlet__head-title">
                                Product Specification
                            </h5>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <textarea class="form-control"  rows="6" name="specifications" >  {{$specs->specifications}}</textarea>
                                <span class="form-text text-muted">Please enter specification</span>
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
                                    <a href="{{route('showItem', ['uid' => $specs->item->uuid])}}" class="btn btn-secondary">Cancel</a>
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