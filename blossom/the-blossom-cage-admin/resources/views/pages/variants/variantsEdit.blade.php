@extends('layouts.main')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    <i class=" fa fa-edit"></i>Edit Variant Data
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form id="updateVariant" class="kt-form kt-form--fit kt-form--label-right"
                              action="{{route('updateVariant')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="item_id" value="{{$variant->item_id}}">
                            <input type="hidden" name="variant_id" value="{{$variant->id}}">
                            <input type="hidden" name="size_id" value="{{$variant->size->id}}">
                            <input type="hidden" name="color_id"
                                   value="{{!empty($variant->color->id) ? $variant->color->id : NULL}}">
                            <?php
                            $item_data = \App\Item::where('id', $variant->item_id)->first();
                            ?>
                            <div class="kt-portlet__body">
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <span class="form-text">Weight<span style=" color: red;">*</span></span>
                                        <input id="wieght" type="number" class="form-control" placeholder=""
                                               name="weight" value="{{$variant->size->weight}}" maxlength="7">
                                        <span class="form-text text-muted">Please enter weight as integer or two decimal numeric value</span>
                                        <span id="w_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="form-text">Weight Unit<span style=" color: red;">*</span></span>
                                        <select id="wieght_unit" style="    width: 100%;"
                                                class="js-example-basic-single2" name="weight_unit">
                                            <option value="kg-كيلوغرام"
                                                    @if(isset($variant->size->weight_unit) && $variant->size->weight_unit == 'kg') selected @endif >
                                                Kilogram - كيلوغرام
                                            </option>
                                            <option value="g-غرام"
                                                    @if(isset($variant->size->weight_unit) && $variant->size->weight_unit == 'g') selected @endif >
                                                gram - غرام
                                            </option>
                                        </select>
                                        <span id="wu_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="form-text">length</span>
                                        <input id="lenght" type="text" class="form-control" placeholder="" name="lenght"
                                               value="{{$variant->size->lenght}}" maxlength="7">
                                        <span class="form-text text-muted">Please enter length as integer or two decimal numeric value</span>
                                        <span id="li_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="form-text">Width</span>
                                        <input id="width" type="number" class="form-control" placeholder="" name="width"
                                               value="{{$variant->size->width}}" maxlength="7">
                                        <span class="form-text text-muted">Please enter width as integer or two decimal numeric value</span>
                                        <span id="wi_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="form-text">Height</span>
                                        <input id="height" type="number" class="form-control" placeholder=""
                                               name="height" value="{{$variant->size->height}}" maxlength="7">
                                        <span class="form-text text-muted">Please enter height as integer or two decimal numeric value</span>
                                        <span id="hi_message" class="form-text"
                                              style=" color: red;  display: none;"></span>

                                    </div>

                                    <div class="col-md-2">
                                        <span class="form-text">Orientation Unit</span>
                                        <select id="orientation_unit" style="    width: 100%;"
                                                class="js-example-basic-single" id="orientation_unit"
                                                name="orientation_unit">
                                            <option value="">Select Unit</option>
                                            <option value="m-متر"
                                                    @if(isset($variant->size->orientation_unit) && $variant->size->orientation_unit == 'm') selected @endif >
                                                m - متر
                                            </option>
                                            <option value="cm-سم"
                                                    @if(isset($variant->size->orientation_unit) && $variant->size->orientation_unit == 'cm') selected @endif >
                                                cm - سم
                                            </option>
                                            <option value="mm-مم" @if(isset($variant->size->orientation_unit) && $variant->size->orientation_unit == 'mm') selected @endif> mm - مم</option>
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
                                        <input type="hidden" name="unit_of_power[label_en]"
                                               value="{{isset($otherunit->label_en)?$otherunit->label_en:"Power"}}">
                                        <input type="hidden" name="unit_of_power[otherunit_id]"
                                               value="{{isset($otherunit->id)?$otherunit->id:"0"}}">
                                        <input type="hidden" name="unit_of_power[label_ar]"
                                               value="{{isset($otherunit->label_ar)?$otherunit->label_ar:"الطاقة"}}">
                                        <input id="unit_of_power_value" type="number" minlength="0" class="form-control"
                                               placeholder="Power value" name="unit_of_power[value]"
                                               value="{{isset($otherunit->value_en)?$otherunit->value_en:""}}"
                                               maxlength="45">
                                        <span class="form-text text-muted">Please enter power Value</span>
                                        <span id="pv_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="form-text"> Units</span>
                                        <select id="unit_of_power" style=" width: 100%;" class="js-example-basic-single"
                                                id="orientation_unit" name="unit_of_power[unit]">
                                            <option value="">Select Unit</option>
                                            <option value="watt-واط"
                                                    @if(isset($otherunit->unit_en) && $otherunit->unit_en == 'watt' ) selected @endif>
                                                watt - واط
                                            </option>
                                            <option value="horsepower-قوة حصان"
                                                    @if(isset($otherunit->unit_en) && $otherunit->unit_en == 'horsepower' ) selected @endif>
                                                horsepower - قوة حصان
                                            </option>
                                        </select>
                                        <span id="pu_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>

                                </div>
                            </div>


                            <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                                <div class="kt-portlet kt-portlet--mobile">
                                    <div class="kt-portlet__head kt-portlet__head--lg">
                                        <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-paint-brush"></i>
                </span>
                                            <h3 class="kt-portlet__head-title">
                                                Colors Information
                                            </h3>

                                        </div>

                                        <div class="kt-portlet__head-toolbar">
                                            <a href="{{route('addcolor', ['uid' => $variant->uuid])}}"
                                               class="btn btn-label-brand btn-bold btn-sm">
                                                Add Color
                                            </a>
                                        </div>
                                    </div>

                                    <div class="kt-portlet__body">
                                        <table class="table table-striped- table-bordered table-hover table-checkable"
                                               id="kt_table_1">
                                            <thead>
                                            <tr>

                                                <th>Color Name(en)</th>
                                                <th>Color Code</th>
                                                <th>Color Quantity</th>
                                                <th>Images</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            @foreach($itemColorImage as $key=>$rowitemColor)
{{--                                                {{dd($rowitemColor)}}--}}
                                                <tr>
                                                    <td> {{$rowitemColor['en_color_name']}}</td>
                                                    <td>
                                                        <span style="border: 1px solid #ccc; background: {{$rowitemColor['color_code']}} ; margin-top: 5px;width: 40px;"
                                                              class="kt-badge kt-badge--dark kt-badge--inline kt-badge--pill kt-badge--rounded"></span>
                                                    </td>
                                                    <td> {{$rowitemColor['color_quantity']}}</td>
                                                    <td>

                                                        @if(!empty($rowitemColor['colorItemsImages']) && $rowitemColor['colorItemsImages'] !== null)

                                                            @foreach($rowitemColor['colorItemsImages'] as $image)
                                                                <img src="{{config('paths.home_url') . config('paths.medium-itemColor-thumb') . $image->image}}"
                                                                     alt="No Image"
                                                                     style="width: 80px;height: 80px;margin: 5px;">
                                                            @endforeach

                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route('editColor', ['uid' => $rowitemColor['uuid']])}}"
                                                           class="btn btn-label-brand btn-bold btn-sm">
                                                            Edit
                                                        </a>

                                                        @if(count($itemColorImage) != 1)

                                                            @if($rowitemColor['archive'] == 0)
                                                                <a href="{{route('updateArchiveItemColor', ['uid' => $rowitemColor['uuid'],'item_id' => $variant->item_id,'status' => 'in-active'])}}"
                                                                   class="alterConfirmMassageForItemColorActive">
                                                                    <i class="fa fa-trash">Delete</i>
                                                                </a>
                                                            @else
                                                                <a href="{{route('updateArchiveItemColor', ['uid' =>  $rowitemColor['uuid'],'item_id' => $variant->item_id,'status' => 'active'])}}"
                                                                   class="alterConfirmMassageForItemColorActive">
                                                                    <i class="fa fa-trash">Unarchive</i>
                                                                </a>
                                                            @endif
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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
                                            <button id="storeUpdateVariant" type="button" class="btn btn-success">
                                                Update
                                            </button>
                                            <a href="{{route('showItem', ['uid' => $item_data->uuid])}}" class="btn btn-secondary">Cancel</a>
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
    <script>
        $('#orientation_unit').select2();
        $('#weight_unit').select2();
    </script>
@endsection