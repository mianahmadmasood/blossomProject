@extends('layouts.main')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                         Saved Item

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
                              action="{{route('updateItemColor')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="add">
                            <input type="hidden" name="editVariantId" value="{{$itemColors->item_variant_id}}">
                            <input type="hidden" name="itemColorsId" value="{{$itemColors->id}}">
                            <div class="kt-portlet__body">
                                <div class="form-group row row_1">
                                    <div class="col-md-3">
                                        <span class="form-text">Color</span>
                                        <select id="item_color"  class="form-control itemcolorDropdwon" @if(!empty($itemColors->color_id)) disabled @endif name="item_color_id" >
                                            <option value="">Select Color</option>
                                            @foreach($colors as $color)
                                                <option style="color: {{ $color->color_code}} ;"  value="{{$color->id}}" @if($itemColors->color_id == $color->id ) selected @endif data-value="{{$color->en_title}} - {{$color->ar_title}}">
                                                    {{$color->en_title}} - {{$color->ar_title}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="form-text text-muted">Please Select Color</span>
                                        <span id="cn_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="form-text">Quantity</span>
                                        <input type="number" class="form-control" id="color_qty" placeholder="Enter product color quantity" name="color_qty" value = "{{$itemColors->color_quantity}}" oninput="validity.valid||(value='');" min="1" step="1"  pattern="^[0-9]"  onKeyPress="if (this.value.length == 4)
                                                return false;" >

                                        <span class="form-text text-muted">Please enter Item Quantity</span>
                                        <span id="ciq_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>

                                    @if(!empty($itemColorImage) && $itemColorImage !== null)
                                        @foreach($itemColorImage as $image)
                                            <div id="image_div_{{$image->image}}" class="profile-img1 p-3 description_text_item_color">
                                                <a class="close closeItemColor" data-img="{{$image->image}}" style="cursor: pointer;">×</a>
                                                <img  src="{{config('paths.home_url') . config('paths.medium-itemColor-thumb') . $image->image}}" alt="No Image">
                                                <input id="image_item_{{$image->id}}" type="hidden" name="images[]" value="{{$image->image}}">
                                            </div>

                                        @endforeach
                                    @endif

                                    @include('partials.edititemColorImages')
                                    <input type="hidden" id="counter" value="2">
                                </div>

                                <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                                    <div class="kt-form__actions">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3 ">
                                                <button id="submit_form_add_color" type="submit" class="btn btn-success">Submit
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
<script>
    $('#orientation_unit').select2();
    $('#weight_unit').select2();
</script>
@endsection