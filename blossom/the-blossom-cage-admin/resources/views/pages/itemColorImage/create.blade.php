@extends('layouts.main')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{route('editItem', ['uid' => $id])}}" class="kt-subheader__breadcrumbs-link">
                        Saved Item
                    </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        Add Variants
                    </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        Add Meta Data
                    </a>

                </div>

            </div>
        </div>

        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Item Variant Information Schema
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form id="variant_form" class="kt-form kt-form--fit kt-form--label-right"
                              action="{{route('storeVariantsData')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="item_id" value="{{$id}}">
                            <div class="kt-portlet__body">
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <span class="form-text">Weight <span style=" color: red;">*</span></span>
                                        <input id="wieght" type="text" class="form-control" placeholder="" name="weight"
                                               value="{{old('weight')}}" maxlength="7">
                                        <span class="form-text text-muted">Please enter weight as integer or two decimal numeric value</span>
                                        <span id="w_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="form-text">Weight Unit <span style=" color: red;">*</span></span>
                                        <select id="wieght_unit" style="    width: 100%;"
                                                class="js-example-basic-single" id="weight_unit" name="weight_unit">
                                            <option value="kg-كيلوغرام"> Kilogram - كيلوغرام</option>
                                            <option value="g-غرام"> gram - غرام</option>
                                        </select>
                                        <span id="wu_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="form-text">length</span>
                                        <input id="lenght" type="text" class="form-control" placeholder="" name="lenght"
                                               value="{{old('lenght')}}" maxlength="7">
                                        <span class="form-text text-muted">Please enter length as integer or two decimal numeric value</span>
                                        <span id="li_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="form-text">Width</span>
                                        <input id="width" type="text" class="form-control" placeholder="" name="width"
                                               value="{{old('width')}}" maxlength="7">
                                        <span class="form-text text-muted">Please enter width as integer or two decimal numeric value</span>
                                        <span id="wi_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="form-text">Height</span>
                                        <input id="height" type="text" class="form-control" placeholder="" name="height"
                                               value="{{old('height')}}" maxlength="7">
                                        <span class="form-text text-muted">Please enter height as integer or two decimal numeric value</span>
                                        <span id="hi_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="form-text">Orientation Unit</span>
                                        <select id="orientation_unit" style=" width: 100%;"
                                                class="js-example-basic-single" id="orientation_unit"
                                                name="orientation_unit">
                                            <option value="">Select Unit</option>
                                            <option value="m-متر"> m - متر</option>
                                            <option value="cm-سم"> cm - سم</option>
                                        </select>
                                        <span id="ou_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <span class="form-text"> Power </span>
                                        <input type="hidden"  name="unit_of_power[label_en]" value="Power" >
                                        <input type="hidden"  name="unit_of_power[label_ar]" value="الطاقة" >
                                        <input id="unit_of_power_value" type="number" class="form-control" minlength="0" placeholder="Power value"  name="unit_of_power[value]" maxlength="45">
                                        <span class="form-text text-muted">Please enter power Value</span>
                                        <span id="pv_message" class="form-text" style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="form-text"> Units</span>
                                        <select id="unit_of_power" style=" width: 100%;" class="js-example-basic-single" id="orientation_unit" name="unit_of_power[unit]">
                                            <option value="">Select Unit</option>
                                            <option value="watt-واط"> watt - واط</option>
                                            <option value="horsepower-قوة حصان"> horsepower - قوة حصان</option>
                                        </select>
                                        <span id="pu_message" class="form-text" style=" color: red;  display: none;"></span>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

                    <button type="button" class="btn btn-block btn-dark" id="upload-item-color-image" >
                        Crop And Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>

        $('#orientation_unit').select2();
        $('#weight_unit').select2();

    </script>
@endsection