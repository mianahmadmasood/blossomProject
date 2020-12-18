<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet__head-label line">
        <h6 class="kt-portlet__head-title">
            Top Categories For Home Page Block {{$i}}
        </h6>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div>
                <!--begin::Form-->
                <?php
                $routeName = "storetopCategories_" . $i;
                $top_categories = null;
                if ('top_categories_1' == "top_categories_" . $i) {
                    $top_categories = $top_categories_1;
                } else if ('top_categories_2' == "top_categories_" . $i) {
                    $top_categories = $top_categories_2;
                } else
                    if ('top_categories_3' == "top_categories_" . $i) {
                        $top_categories = $top_categories_3;
                    } else
                        if ('top_categories_4' == "top_categories_" . $i) {
                            $top_categories = $top_categories_4;
                        }
                ?>
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route($routeName)}}"
                      method="POST" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="top_categories_{{$i}}">
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <style>.select2-container {
                                    width: 100% !important;
                                }</style>
                            <div class="col-lg-4">
                                <label class="col-form-label"> Categories <span
                                            style=" color: red;">*</span></label>
                                @if(!empty($top_categories[0]) && $top_categories[0]->type == "top_categories_".$i )
                                    <input type="hidden" name="banner_categoires_for_item"
                                           value="{{$top_categories[0]->categories_id}}"/>
                                    <select id="banner_categoires_for_subcatgories_{{$i}}"
                                            class="form-control js-example-basic-single  validationClass_categoires altermassage_topcategories"
                                            name="banner_categoires_for_item" disabled>
                                        <option value="">{{$top_categories[0]['category']->en_title}}</option>

                                    </select>
                                    <p style="color: red">If you want to change category, You have to remove listed products.</p>

                                @else
                                    <select id="banner_categoires_for_subcatgories_{{$i}}"
                                            class="form-control js-example-basic-single  validationClass_categoires"
                                            name="banner_categoires_for_item">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                                <option value="{{$category->id}}" data-type="subCat">
                                                    {{$category->en_title}}
                                                </option>

                                        @endforeach
                                    </select>

                                @endif

                                <span id="category_id_message" class="form-text"
                                      style=" color: red;  display: none;"></span>
                            </div>

                            <div class="col-lg-4">
                                <label class="col-form-label"> Sub Categories <span
                                            style=" color: red;">*</span></label>
                                @if(!empty($top_categories[0]) && $top_categories[0]->type == "top_categories_".$i )
                                    <select id="banner_categoires_for_item_{{$i}}"
                                            class="form-control js-example-basic-single  validationClass_categoires"
                                            name="banner_subCategoires_for_item">
                                        <option value="">Select Sub Category </option>
                                        @foreach($categories as $category)
                                                @foreach($category['sub_category'] as $subcategory)
                                                    @if($top_categories[0]->categories_id === $subcategory->parent_id )
                                                    <option value="{{$subcategory->id}}" data-value="topSaleItem" data-type="subCat">
                                                        &nbsp;&nbsp;&nbsp;-&nbsp;{{$subcategory->en_title}}</option>
                                                    @endif
                                                @endforeach
                                        @endforeach
                                    </select>
                                    @else

                                    <select id="banner_categoires_for_item_{{$i}}"
                                            class="form-control js-example-basic-single  validationClass_categoires"
                                            name="banner_subCategoires_for_item">
                                        <option value="">Select Sub Category </option>
                                    </select>

                                @endif

                                <span id="category_id_message" class="form-text"
                                      style=" color: red;  display: none;"></span>
                            </div>

                            <div class="col-lg-4" id="items_ajax_div_{{$i}}">
                                <label class="col-form-label"> Items <span
                                            style=" color: red;">*</span></label>
                                @if(!empty($top_categories[0]) && $top_categories[0]->type == "top_categories_".$i  )
                                <select id="banner_products_{{$i}}"
                                        class="form-control top_sale_products js-example-basic-single validationClass_products"
                                        name="item_id">
                                    <option value="">Select Item</option>
{{--                                    @foreach($items as $item)--}}
{{--                                        @if(!empty($top_categories[0]) && $top_categories[0]->type == "top_categories_".$i && !empty($top_categories[0]->categories_id) && $top_categories[0]->categories_id == $item->category_id )--}}
{{--                                            <option value="{{$item->id}}-{{$banners[0]->categories_id}}-{{$banners[0]->sub_categories_id}}">{{$item->en_title}}</option>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
                                </select>
                                    @else
                                    <select id="banner_products_{{$i}}"
                                            class="form-control top_sale_products js-example-basic-single validationClass_products"
                                            name="item_id">
                                        <option value="">Select Item</option>
                                    </select>
                                @endif

                                <span id="item_id_message" class="form-text"
                                      style=" color: red;  display: none;"></span>
                            </div>

                        </div>
                        <span id="validation_id_message" class="form-text "
                              style=" color: red;  display: none; text-align: center;"></span>
                        <div class="col-lg-3" id="product_show_{{$i}}" style="display: none">

                        </div>
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