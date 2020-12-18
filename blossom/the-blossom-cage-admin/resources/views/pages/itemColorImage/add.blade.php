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
                                    Item Color Information Schema
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form id="variant_form" class="kt-form kt-form--fit kt-form--label-right"
                              action="{{route('storeItemColorData')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="item_id" value="{{$itemVariant->item_id}}">
                            <input type="hidden" name="item_variant_id" value="{{$itemVariant->id}}">
                            <input type="hidden" name="item_variant_uuid" value="{{$itemVariant->uuid}}">

                            <input type="hidden" name="type" value="add">
                            <div class="kt-portlet__body">
                                <div class="form-group row row_1">
                                    <div class="col-md-3">
                                        <span class="form-text">Color</span>
                                        <select id="item_color"  class="form-control itemcolorDropdwon"  name="color[1][item_color]" >
                                            <option value="">Select Color</option>
                                            @foreach($colors as $color)
                                                <option style="color: {{ $color->color_code}} ;"  value="{{$color->id}}" data-values="{{ $color->color_code}}" data-value="{{$color->en_title}} - {{$color->ar_title}}">
                                                    {{$color->en_title}} - {{$color->ar_title}}
                                                </option>
                                            @endforeach
                                        </select>

                                        <span class="form-text text-muted">Please Select Color</span>

                                        <span id="cn_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-1" id="colorShow" style="display: none" ></div>

                                    <div class="col-md-3">
                                        <span class="form-text">Quantity</span>
                                        <input type="number" class="form-control" id="color_qty" placeholder="Enter product color quantity" name="color[1][color_qty]" value = "{{ old('color[1][color_qty]') }}" oninput="validity.valid||(value='');" min="1" step="1"  pattern="^[0-9]"  onKeyPress="if (this.value.length == 4)
                                                return false;" >
                                        <span class="form-text text-muted">Please enter product color quantity</span>
                                        <span id="ciq_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    @include('partials.edititemColorImages')
                                    <input type="hidden" id="counter" value="2">
                                </div>

{{--                                <div class="form-group row">--}}
{{--                                    <div class="col-lg-2">--}}
{{--                                        <button id="submit_item_color_add" type="button" class="btn btn-success">Add more--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div id="rowAppendedItemColor">
                                </div>

                                <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                                    <div class="kt-form__actions">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3 ">
                                                <button id="submit_form_add_color"  type="submit" class="btn btn-success">Submit
                                                </button>
                                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                            </div>
                                        </div>
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