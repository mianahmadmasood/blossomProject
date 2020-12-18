<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div>
                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('storeTrendyItem')}}"
                      method="POST" method="POST" id="banner_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="trendy_item">
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <style>.select2-container {
                                    width: 100% !important;
                                }</style>
                            <div class="col-lg-4">
                                <label class="col-form-label"> Categories <span
                                            style=" color: red;">*</span></label>
                                <select id="banner_categoires_for_item"
                                        class="form-control js-example-basic-single validationClass_categoires"
                                        name="categoires_for_item">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <optgroup label="{{$category->en_title}}">
                                            <option value="{{$category->id}}" data-value="topSaleItem" data-type="cat">
                                                &#8900; {{$category->en_title}}</option>
                                            @foreach($category['sub_category'] as $subcategory)
                                                <option value="{{$subcategory->id}}" data-value="topSaleItem" data-type="subCat">
                                                    &nbsp;&nbsp;&nbsp;-&nbsp;{{$subcategory->en_title}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <span id="category_id_message" class="form-text"
                                      style=" color: red;  display: none;"></span>
                            </div>
                            <div class="col-lg-4" id="items_ajax_div">
                                <label class="col-form-label"> Items <span
                                            style=" color: red;">*</span></label>
                                <select id="banner_products"
                                        class="form-control top_sale_products js-example-basic-single validationClass_products"
                                        name="item_id">
                                    <option value="">Select Item</option>
{{--                                    @foreach($items as $item)--}}
{{--                                        <option value="{{$item->id}}">{{$item->en_title}}</option>--}}
{{--                                    @endforeach--}}
                                </select>
                                <span id="item_id_message" class="form-text"
                                      style=" color: red;  display: none;"></span>
                            </div>
                            <div class="col-lg-3" id="product_show" style="display: none">

                            </div>
                        </div>
                        <span id="validation_id_message" class="form-text "
                              style=" color: red;  display: none; text-align: center;"></span>
                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-success">Submit</button>
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
