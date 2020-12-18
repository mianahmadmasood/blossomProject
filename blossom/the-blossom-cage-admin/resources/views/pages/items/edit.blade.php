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
                                    Item Information Schema
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form id="item_edit_form"  class="kt-form kt-form--fit kt-form--label-right" action="{{route('updateItem')}}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="kt-portlet__body">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Item Code#:<span
                                                style=" color: red;">*</span></label>
                                    <div class="col-lg-4">
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="text" maxlength="7" pattern="[0-9]+(\.[0-9][0-9]?)?"
                                               class="form-control" placeholder="Enter item code" name="item_code"
                                               value="{{ $item->item_code }}">
                                        <span class="form-text text-muted">Please enter item code</span>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Model #: <span style=" color: red;">*</span></label>
                                    <div class="col-lg-4">
                                        <input type="text" maxlength="45" class="form-control"
                                               placeholder="Enter item model" name="model" value="{{ $item->model}}">
                                        <span class="form-text text-muted">Please enter item model</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">English Title: <span
                                                style=" color: red;">*</span></label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" placeholder="Enter item title"
                                               name="en_title" value="{{ $item->en_title }}">
                                        <span class="form-text text-muted">Please enter category title in English</span>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Arabic Title:<span
                                                style=" color: red;">*</span></label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" placeholder="Enter item title"
                                               name="ar_title" value="{{ $item->ar_title }}">
                                        <span class="form-text text-muted">Please enter category title in Arabic</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Short English Description: <span
                                                style=" color: red;">*</span></label>
                                    <div class="col-lg-8">
                                        <textarea rows="4" cols="50" type="text" class="form-control"
                                                  name="en_short_description"> {{ $item->en_short_description }}</textarea>
                                        <span class="form-text text-muted">Please enter item short description in English</span>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Short Arabic Description:<span
                                                style=" color: red;">*</span></label>
                                    <div class="col-lg-8">
                                        <textarea rows="4" cols="50" type="text" class="form-control"
                                                  name="ar_short_description">{{ $item->ar_short_description }}</textarea>
                                        <span class="form-text text-muted">Please enter item description in Arabic</span>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">English Description: <span
                                                style=" color: red;">*</span></label>
                                    <div class="col-lg-8">
                                        <textarea rows="4" cols="50" type="text" class="form-control"
                                                  placeholder="Enter item description"
                                                  name="en_description"> {{ $item->en_description }}</textarea>
                                        <span class="form-text text-muted">Please enter item description in English</span>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Arabic Description:<span
                                                style=" color: red;">*</span></label>
                                    <div class="col-lg-8">
                                        <textarea rows="4" cols="50" type="text" class="form-control"
                                                  placeholder="Enter description title"
                                                  name="ar_description">{{ $item->ar_description }}</textarea>
                                        <span class="form-text text-muted">Please enter item description in Arabic</span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Select Parent Category:<span
                                                style=" color: red;">*</span></label></label>
                                    <div class=" col-lg-3">
                                        <select id="cat_sl" style="width: 100%;" class="js-example-basic-single"
                                                id="js-example-basic-single" name="category_id">
                                            @if($item->category->archive == 1)
                                                <option value="" selected=""> Please Select Category</option>
                                            @endif
                                            @foreach($categories as $cat)
                                                @php
                                                    if ($cat->id == $item->category->id) {
                                                    $slected = 'selected';
                                                    } else {
                                                    $slected = '';
                                                    }
                                                @endphp
                                                <option value="{{$cat->id}}" <?php echo $slected; ?>> {{$cat->en_title}}
                                                    - {{$cat->ar_title}}</option>
                                            @endforeach
                                        </select>
                                        @if($item->category->archive == 1)
                                            <span class="form-text " style=" color: red;"> "{{$item->category->en_title}}-{{$item->category->en_title}} is disabled."</span>
                                        @endif
                                    </div>
                                    <label class="col-lg-2 col-form-label">Select Sub Category:<span
                                                style=" color: red;">*</span></label></label>
                                    <div class=" col-lg-3">
                                        <select style="    width: 100%;" class="js-example-basic-single2"
                                                id="js-example-basic-single2" name="sub_category_id">
                                            <option value="" > Select Sub Category</option>
                                        @foreach($categoriesSub as $subcat)
                                                @if($item->sub_category_id == $subcat->id )
                                                    <option value="{{$subcat->id}}" selected > {{$subcat->en_title}}
                                                        - {{$subcat->ar_title}}</option>
                                                @else
                                                    <option value="{{$subcat->id}}"> {{$subcat->en_title}}
                                                        - {{$subcat->ar_title}}</option>
                                                @endif
                                            @endforeach

                                            {{--                                        @if($item->category->archive == 1)--}}
                                            {{--                                        <option value="" selected=""> Please Select Category</option>--}}
                                            {{--                                        @else--}}
                                            {{--                                        <option value="{{$item->sub_category->id}}">{{$item->sub_category->en_title}} - {{$item->sub_category->ar_title}}</option>--}}
                                            {{--                                        @endif--}}
                                        </select>
                                        @if($item->category->archive == 1)
                                            <span class="form-text " style=" color: red;"> "{{$item->sub_category->en_title}}-{{$item->sub_category->en_title}} is disabled."</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Select Brands<span style=" color: red;">*</span></label>
                                    <div class=" col-lg-3">
                                        <select required style=" width: 100%;" class="js-example-basic-single-brands"
                                                id="js-example-basic-single-brands" name="brand_id">
                                            <option value="">Select Brands:</option>
                                            @foreach($brands as $brand)
                                                @if( $brand->id == $item->brand_id)
                                                    <option value="{{$brand->id}}" selected> {{$brand->en_title}}
                                                        - {{$brand->ar_title}}</option>
                                                @else
                                                    <option value="{{$brand->id}}"> {{$brand->en_title}}
                                                        - {{$brand->ar_title}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Cart Quantity:<span
                                                style=" color: red;">*</span></label>
                                    <div class="col-lg-3">
                                        <input type="number" class="form-control" placeholder="Enter item quantity"
                                               name="cart_quantity"
                                               value="{{ $item->cart_quantity}}"
                                               oninput="validity.valid||(value='');" min="1" step="1" pattern="^[0-9]"
                                               onKeyPress="if (this.value.length == 4)
                                                return false;">
                                        <span class="form-text text-muted">Please enter item quantity</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Price:<span
                                                style=" color: red;">*</span></label>
                                    <div class="col-lg-3">
                                        <input type="number" class="form-control" placeholder="Enter item price"
                                               name="price" value="{{ $item->price}}"
                                               oninput="validity.valid||(value='');" min="1" step="any" onKeyPress="if (this.value.length == 9)
                                                return false;">
                                        <span class="form-text text-muted">Please enter item quantity</span>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Sale Price Discount / Percentage</label>
                                    <div class="col-lg-2">
                                        <input type="number" class="form-control" placeholder="Enter item sale price"
                                               name="sale_price" id="sale_price" value="{{  $item->discount > 0 ?number_format($item->discount, 2):''}}"
                                               oninput="validity.valid||(value='');" min="1" step="any" onKeyPress="if (this.value.length == 9)
                                                return false;">
                                        <span class="form-text text-muted">Please enter item quantity</span>

                                        <span id="sale_price_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class=" col-lg-2">
                                        <select  style=" width: 100%;"class="js-example-basic-single-discounted_type" id="discounted_type" name="discounted_type">
                                            <option value="" >Select Discounted Type:</option>
                                            <option value="fixed" @if(old('discounted_type') == 'fixed' || $item->discounted_type == 'fixed' ) selected @endif>fixed</option>
                                            <option value="percentage" @if(old('discounted_type') == 'percentage' || $item->discounted_type == 'percentage') selected @endif >percentage</option>

                                        </select>
                                        <span id="discounted_type_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>

{{--                                    <label class="col-lg-2 col-form-label">Quantity:<span style=" color: red;">*</span></label>--}}
{{--                                    <div class="col-lg-3">--}}
{{--                                        <input type="number" class="form-control" placeholder="Enter item quantity"--}}
{{--                                               name="quantity"--}}
{{--                                               value="{{ $item->quantity}}"--}}
{{--                                               oninput="validity.valid||(value='');" min="0" step="1" pattern="^[0-9]"--}}
{{--                                               onKeyPress="if (this.value.length == 4)--}}
{{--                                                return false;">--}}
{{--                                        <span class="form-text text-muted">Please enter item quantity</span>--}}
{{--                                    </div>--}}
                                </div>
                                
                            </div>
                            <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                            <button type="submit" id="submit_edit_product" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </div>
                                <span id="sale_price_message" class="form-text"
                                          style=" color: red;  display: none;"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection