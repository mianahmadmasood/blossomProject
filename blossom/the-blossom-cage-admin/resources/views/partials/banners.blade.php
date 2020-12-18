<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-lg-12">

            <!--begin::Portlet-->
            <div>
                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('storebanner')}}"
                      method="POST" method="POST" id="banner_form" enctype="multipart/form-data">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label class="col-form-label">English Banner: <span
                                            style=" color: red;">*</span></label>
                                <div class="d-flex justify-content-center p-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="btn btn-dark">

                                               <input type="file" class="file-upload_banner file-upload" data-value="1"
                                                       data-values="1" id="file-upload-banner" accept="image/*">


                                              <!-- <input type="file" class="file-upload" data-value="1"
                                                      data-values="1" id="upload-banner-image-en"
                                                       accept="image/*"> -->

                                                Upload New Photo
                                            </div>
                                            <span class="form-text text-muted">eg (H:575px  X W:1440px) – file size  1 to 2MB</span>
                                        </div>
                                        <span id="eng_image_message" class="form-text"
                                              style=" color: red;  display: none;"></span>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <label class="col-form-label">Perview English Banner: <span
                                            style=" color: red;">*</span></label>
                                <div class="d-flex justify-content-center p-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            @if(old('en_banner') != null)

                                                <img id="prevBannerImage_1"    width="160"

                                                     alt="No Image"
                                                     src="{{config('paths.home_url') . config('paths.medium-banner-thumb') . old('en_banner')}}"
                                                />
                                            @else
                                                <div id="prevBannerImage_div1"  style="  width:160px;background: #5e7976;float:left;text-align: center;">
                                                    <img   style="max-width: 70px;height: auto;" width="160" alt="No Image"
                                                           src="{{asset('public/theme-images/camera.png')}}">
                                                </div>
                                                <img  id="prevBannerImage_1" style="  display: none;"  width="160" alt="No Image"
                                                      src="">
                                            @endif
                                            <input type="hidden" id="image_name_1" name="en_banner" value="{{old('en_banner')}}">
                                            <input type="hidden" id="image_name_2" name="ar_banner" value="{{old('ar_banner')}}">

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-3">
                                <label class="col-form-label">Arabic Banner: <span
                                            style=" color: red;">*</span></label>
                                <div class="d-flex justify-content-center p-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="btn btn-dark">

                                                <input type="file" class="file-upload_banner file-upload" data-value="2"
                                                       data-values="2" id="file-upload-banner" accept="image/*">

                                                <!-- <input type="file" class="file-upload upload-bannerimage" data-value="2"
                                                       data-values="2" id="upload-banner-image-ar"
                                                       accept="image/*"> -->

                                                Upload New Photo
                                            </div>
                                            <span class="form-text text-muted">eg (H:575px X W: 1440px) – file size  1 to 2MB</span>
                                        </div>
                                        <span id="ar_image_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3">
                                <label class="col-form-label">Perview Arabic Banner: <span
                                            style=" color: red;">*</span></label>
                                <div class="d-flex justify-content-center p-3">
                                    <div class="card text-center">
                                        <div class="card-body">


                                            @if(old('ar_banner') != null)
                                                <img id="prevBannerImage_2" width="160"
                                                     alt="No Image"
                                                     src="{{config('paths.home_url') . config('paths.medium-banner-thumb') . old('ar_banner')}}"
                                                />
                                            @else
                                                <div id="prevBannerImage_div2"  style="width:160px;background: #5e7976;float:left;text-align: center;">
                                                    <img  style="max-width: 70px;height: auto;" width="160" alt="No Image"
                                                          src="{{asset('public/theme-images/camera.png')}}">
                                                </div>
                                                <img  id="prevBannerImage_2" style="display: none;"  width="160" alt="No Image"
                                                      src="">
                                            @endif



                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label class="col-form-label">Link this Banner to: <span
                                            style=" color: red;">*</span></label>
                                <select id="type_to_link" class="form-control js-example-basic-single"
                                        name="type_to_link">


                                        <option value="">Select Type</option>
                                        <option value="brands" @if(old('brand_id')) selected @endif>Brands</option>
                                        <option value="categoires" @if(old('categories_id')) selected @endif>Categoires</option>
                                        <option value="products" @if(old('item_id')) selected @endif>Products</option>


                                </select>
                                <span id="type_to_link_message" class="form-text"
                                      style=" color: red;  display: none;"></span>
                            </div>
                            <style>.select2-container {
                                    width: 100% !important;
                                }</style>

                            @if(!empty($brands) || old('brand_id') )
                                <div class="col-lg-3" id="brand_div" @if(old('brand_id'))  style="display: block" @else style="display: none" @endif>

                                    <label class="col-form-label"> Brands <span
                                                style=" color: red;">*</span></label>
                                    <select id="banner_brands"
                                            class="form-control js-example-basic-single validationClass_brands"
                                            name="brand_id">
                                        <option value="">Select Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" @if(old('brand_id') == $brand->id ) selected @endif >{{$brand->en_title}}</option>
                                        @endforeach
                                    </select>
                                    <span id="brand_id_message" class="form-text"
                                          style=" color: red;  display: none;"></span>

                                </div>
                            @endif
                            @if(old('item_id') == null)
                            @if(!empty($categories) || old('categories_id'))
                                <div class="col-lg-3" id="categoires_div" @if(old('categories_id'))  style="display: block"  @else(old('item_id')) style="display: none" @endif >

                                    <label class="col-form-label"> Categories <span
                                                style=" color: red;">*</span></label>
                                    <select id="banner_categoires"
                                            class="form-control js-example-basic-single validationClass_categoires"
                                            name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <optgroup label="{{$category->en_title}}">
                                                <option value="{{$category->id}}" >
                                                    &#8900; {{$category->en_title}}</option>
                                                @foreach($category['sub_category'] as $subcategory)
                                                    <option value="{{$category->id}}-{{$subcategory->id}}" @if(old('categories_id') == $category->id || old('sub_categories_id') == $subcategory->id) selected @endif  >&nbsp;&nbsp;&nbsp;-&nbsp;{{$subcategory->en_title}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <span id="category_id_message" class="form-text"
                                          style=" color: red;  display: none;"></span>

                                </div>
                            @endif
                            @endif

                                @if(!empty($items) || old('item_id') )
                                <div class="col-lg-9" id="items_div" @if(old('item_id'))  style="display: block;float: left" @else style="display: none;float: left" @endif >
                                    <div class="col-lg-4" style="float: left">
                                        <label class="col-form-label"> Categories <span
                                                    style=" color: red;">*</span></label>
                                        <select id="banner_categoires_for_item"
                                                class="form-control js-example-basic-single validationClass_categoires"
                                                name="banner_categoires_for_item">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <optgroup label="{{$category->en_title}}">
                                                    <option value="{{$category->id}}" data-value="banners" data-type="cat">
                                                        &#8900; {{$category->en_title}}</option>
                                                    @foreach($category['sub_category'] as $subcategory)
                                                        <option value="{{$subcategory->id}}" @if(old('categories_id') == $subcategory->id || old('sub_categories_id') == $subcategory->id) selected @endif data-value="banners" data-type="subCat">
                                                            &nbsp;&nbsp;&nbsp;-&nbsp;{{$subcategory->en_title}}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>

                                        <span id="category_id_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                    <div class="col-lg-4" id="items_ajax_div" @if(old('item_id'))  style="display: block;float: left" @else style="display: none;float: left" @endif>
                                        <label class="col-form-label"> Items <span
                                                    style=" color: red;">*</span></label>
                                        <select id="banner_products"
                                                class="form-control js-example-basic-single validationClass_products"
                                                name="item_id">
                                            <option value="">Select Item</option>
                                            @foreach($items as $item)
                                                <option value="{{$item->id}}" @if(old('item_id') == $item->id ) selected @endif >{{$item->en_title}}</option>
                                            @endforeach
                                        </select>
                                        <span id="item_id_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <span id="validation_id_message" class="form-text "
                              style=" color: red;  display: none; text-align: center;margin-right: 280px;"></span>
                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-4">
                                    <button type="submit" id="fileBanner" class="btn btn-success">Submit</button>
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

<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style=" min-width: 550px;">
            <!-- Modal Header -->
            <div class="modal-header" style="padding: 5px">
                <h4 class="modal-title">Crop Image And Upload</h4>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="resizer"></div>

                <span style="cursor: pointer;" class="btn rotate float-lef" data-deg="90">
                    <i class="fas fa-undo"></i></span>
                <span style="cursor: pointer;" class="btn rotate float-right" data-deg="-90">
                    <i class="fas fa-redo"></i></span>

                <button type="button" class="btn btn-block btn-dark upload-banner-image" VALUE="1"
                        id="upload-banner-image">
                    Crop And Upload
                </button>
            </div>
        </div>
    </div>
</div>
