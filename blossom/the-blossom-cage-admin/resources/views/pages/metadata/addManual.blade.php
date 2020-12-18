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
                            Product Manual Files
                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('storeManual')}}" method="POST" id="product_manual_files" enctype="multipart/form-data">
                    <input type="hidden" name="item_id" value="{{$uid}}">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="kt-portlet__head-label">
                            <h5 class="kt-portlet__head-title">
                                Item Manual
                            </h5>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <span class="form-text">Title English</span>
                                <input type="text" class="form-control" placeholder="" name="en_title" id="en_title" value="{{old('en_title')}}" maxlength="255">
                                <span class="form-text text-muted">Please enter title for English manual</span>
                                <span id="en_title_message" class="form-text" style=" color: red;  display: none;"></span>
                            </div>

                            <div class="col-md-4">
                                <span class="form-text">Title Arabic</span>
                                <input type="text" class="form-control" placeholder="" name="ar_title" id="ar_title" value="{{old('ar_title')}}" maxlength="255">
                                <span class="form-text text-muted">Please enter title for Arabic manual</span>
                                <span id="ar_title_message" class="form-text" style=" color: red;  display: none;"></span>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <span class="form-text">Manual File(English)</span>
                                <input id="pdf" type="file" class="form-control en_file" placeholder="" name="en_file"  value="{{old('en_file')}}" accept=".pdf" >
                                <span class="form-text text-muted">Please select pdf file for the user</span>
                                <span id="en_file_message" class="form-text" style=" color: red;  display: none;"></span>
                            </div>
                            <div class="col-md-4">
                                <span class="form-text">Manual File(Arabic)</span>
                                <input id="pdf" type="file" class="form-control ar_file" placeholder="" name="ar_file" value="{{old('ar_file')}}" accept=".pdf" >
                                <span class="form-text text-muted">Please select pdf file for the user</span>
                                <span id="ar_file_message" class="form-text" style=" color: red;  display: none;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" id="productmanualfilesSbnitBtn">Submit</button>
                                <a href="{{route('showItem', ['uid' => $uid])}}" class="btn btn-secondary">Cancel</a>

                                {{--                                <a href="javascript:void(0)" id="mycancellBtn" class="btn btn-secondary">Cancel</a>--}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Portlet-->
@endsection