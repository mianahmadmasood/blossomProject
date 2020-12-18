@extends('layouts.main')
@section('content')
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding: .65rem 30px .65rem 1rem!important;
    }
</style>
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"> Add Product </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="#" class="kt-subheader__breadcrumbs-link">
                    Add Variants                    </a>
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
                                Product Information Schema
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form id="item_form" class="kt-form kt-form--fit kt-form--label-right" action="{{route('storeItem')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Item Code#:<span style=" color: red;">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" maxlength="7" pattern="[0-9]+(\.[0-9][0-9]?)?" class="form-control" placeholder="Enter item code, max length of code should be 7" name="item_code" id="item_code" value = "{{ old('item_code') }}"  >
                                    <span class="form-text text-muted">Please enter item code(e.g 20028 or 20028.1 ).</span>
                                </div>
                                <label class="col-lg-2 col-form-label">Model #: <span style=" color: red;">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" maxlength="45" class="form-control" placeholder="Enter item model" name="model" id="model" value = "{{ old('model') }}">
                                    <span class="form-text text-muted">Please enter item model</span>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">English Title: <span style=" color: red;">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="Enter item title in English" name="en_title" id="en_title" value = "{{ old('en_title') }}" maxlength="255">
                                    <span class="form-text text-muted">Please enter category title in English</span>
                                </div>
                                <label class="col-lg-2 col-form-label">Arabic Title:<span style=" color: red;">*</span></label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="Enter item title  in Arabic" name="ar_title" id="ar_title" value = "{{ old('ar_title') }}" maxlength="255">
                                    <span class="form-text text-muted">Please enter category title in Arabic</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Short English Description: <span style=" color: red;">*</span></label>
                                <div class="col-lg-4">
                                    <textarea type="text" class="form-control editor1" placeholder="Enter Short English Description"  name="en_short_description" id="en_short_description" >{{ old('en_short_description') }}</textarea>

                                    <span class="form-text text-muted">Please enter item short description in English</span>
                                </div>
                                <label class="col-lg-2 col-form-label">Short Arabic Description:<span style=" color: red;">*</span></label>
                                <div class="col-lg-4">
                                    <textarea type="text" class="form-control" placeholder="Enter Short Arabic Description" name="ar_short_description" id="ar_short_description" >{{ old('ar_short_description') }}</textarea>
                                    <span class="form-text text-muted">Please enter item description in Arabic</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">English Description: <span style=" color: red;">*</span></label>
                                <div class="col-lg-4">
                                    <textarea type="text" class="form-control" placeholder="Enter item description in English" name="en_description" id="en_description" >{{ old('en_description') }}</textarea>
                                    <span class="form-text text-muted">Please enter item description in English</span>
                                </div>
                                <label class="col-lg-2 col-form-label">Arabic Description:<span style=" color: red;">*</span></label>
                                <div class="col-lg-4">
                                    <textarea type="text" class="form-control" placeholder="Enter item description in Arabic" name="ar_description" id="ar_description" >{{ old('ar_description') }}</textarea>
                                    <span class="form-text text-muted">Please enter item description in Arabic</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Select Parent Category<span style=" color: red;">*</span></label>
                                <div class=" col-lg-4">
                                    <select style=" width: 100%;"class="js-example-basic-single" id="js-example-basic-single" name="category_id">
                                        <option value="">Select Parent Category:</option>
                                        @foreach($categories as $cat)
                                        @if( $cat->id == old('category_id'))
                                        <option value="{{$cat->id}}"  selected> {{$cat->en_title}} - {{$cat->ar_title}}</option>
                                        @else
                                        <option value="{{$cat->id}}" > {{$cat->en_title}} - {{$cat->ar_title}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                               
                                <label class="col-lg-2 col-form-label">Select Sub Category<span style=" color: red;">*</span>:</label>
                                <div class=" col-lg-4">
                                    <select style="width: 100%;" class="js-example-basic-single2" id="js-example-basic-single2" name="sub_category_id">
                                        <option value="">Select Sub Category</option>
                                        @if(old('sub_category_id'))
                                        @foreach($categories_sub as $catSub)
                                        @if( $catSub->id == old('sub_category_id'))
                                        <option value="{{$catSub->id}}"  selected> {{$catSub->en_title}} - {{$catSub->ar_title}}</option>
                                        @elseif($catSub->parent_id == old('category_id'))
                                        <option value="{{$catSub->id}}" > {{$catSub->en_title}} - {{$catSub->ar_title}}</option>
                                        @endif
                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Select Brands<span style=" color: red;">*</span></label>
                                <div class=" col-lg-4">
                                    <select required style=" width: 100%;"class="js-example-basic-single-brands" id="js-example-basic-single-brands" name="brand_id">
                                        <option value="">Select Brands:</option>
                                        @foreach($brands as $brand)
                                        @if( $brand->id == old('brand_id'))
                                        <option value="{{$brand->id}}"  selected> {{$brand->en_title}} - {{$brand->ar_title}}</option>
                                        @else
                                        <option value="{{$brand->id}}" > {{$brand->en_title}} - {{$brand->ar_title}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-lg-2 col-form-label">Quantity allowed for Cart:<span style=" color: red;">*</span></label>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control" placeholder="quantity allowed for cart" name="cart_quantity" id="cart_quantity" value = "{{ old('cart_quantity') }}" oninput="validity.valid||(value='');"min="1" step="1"  pattern="^[0-9]"  onKeyPress="if (this.value.length == 4)
                                                return false;" >
                                    <span class="form-text text-muted">How many products from quantity a user can add in its cart one time</span>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Price:<span style=" color: red;">*</span></label>
                                <div class="col-lg-4">
                                    <input type="number" class="form-control" placeholder="Enter product price" name="price" id="price" value = "{{ old('price') }}" oninput="validity.valid||(value='');" min="1" step="any"  onKeyPress="if (this.value.length == 9)
                                                return false;"  >
                                    <span class="form-text text-muted">Please enter product price</span>
                                </div>
                                <label class="col-lg-2 col-form-label">Sale Price Discount/ Percentage </label>
                                <div class="col-lg-2">
                                    <input type="number" class="form-control" placeholder="Enter product sale price" name="sale_price" id="sale_price" value = "{{ old('sale_price') }}" oninput="validity.valid||(value='');" min="1" step="any"  onKeyPress="if (this.value.length == 9)
                                                return false;" >
                                    <span class="form-text text-muted">Please enter product sale price</span>
                                    <span id="sale_price_message" class="form-text"
                                          style=" color: red;  display: none;"></span>
                                </div>
                                <div class=" col-lg-2">
                                    <select  style=" width: 100%;"class="js-example-basic-single-discounted_type" id="discounted_type" name="discounted_type">
                                        <option value="" >Select Discounted Type:</option>
                                        <option value="fixed" @if(old('discounted_type') == 'fixed') selected @endif>fixed</option>
                                        <option value="percentage" @if(old('discounted_type') == 'percentage') selected @endif >percentage</option>
                                    </select>
                                    <span id="discounted_type_message" class="form-text"
                                          style=" color: red;  display: none;"></span>
                                </div>

                            </div>
                            <div class="form-group row">

{{--                                <label class="col-lg-2 col-form-label">Quantity(Total Products In-Stock):<span style=" color: red;">*</span></label>--}}
{{--                                <div class="col-lg-4">--}}
{{--                                    <input type="number" class="form-control" placeholder="Enter product quantity" name="quantity" value = "{{ old('quantity') }}" oninput="validity.valid||(value='');" min="1" step="1"  pattern="^[0-9]"  onKeyPress="if (this.value.length == 4)--}}
{{--                                                return false;" >--}}
{{--                                    <span class="form-text text-muted">Enter product quantity available in the stock</span>--}}
{{--                                </div>--}}
{{--                                <label class="col-lg-2 col-form-label">Quantity allowed for Cart:<span style=" color: red;">*</span></label>--}}
{{--                                <div class="col-lg-4">--}}
{{--                                    <input type="number" class="form-control" placeholder="quantity allowed for cart" name="cart_quantity" value = "{{ old('cart_quantity') }}" oninput="validity.valid||(value='');"min="1" step="1"  pattern="^[0-9]"  onKeyPress="if (this.value.length == 4)--}}
{{--                                                return false;" >--}}
{{--                                    <span class="form-text text-muted">How many products from quantity a user can add in its cart one time</span>--}}
{{--                                </div>--}}
                            </div>
                            @include('partials.itemImages')


                            <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                                <div class="row">
                                    <div class="col-md-3" ></div>
                                    <div class="col-md-3" ></div>
                                    <div class="col-md-3" ></div>
                                    <div class="col-md-3 float-right">

                                        <button id="submit_con" type="" class="btn btn-success" >Submit & Continue</button>
                                        <a href="{{route('dashboard')}}" class="btn btn-secondary">Cancel</a>
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
</div>

{{--<script src="{{asset('public/ckeditor/ckeditor.js')}}"></script>--}}
{{--<script>--}}
{{--    CKEDITOR.replace( 'ar_short_description' , {contentsLangDirection: 'rtl',});--}}
{{--    CKEDITOR.replace( 'en_short_description' );--}}
{{--    CKEDITOR.replace( 'en_description' );--}}
{{--    CKEDITOR.replace( 'ar_description' , {contentsLangDirection: 'rtl',});--}}
{{--    CKEDITOR.replace( 'specs_en' );--}}
{{--    CKEDITOR.replace( 'specs_ar' , {contentsLangDirection: 'rtl',});--}}
{{--</script>--}}

@endsection