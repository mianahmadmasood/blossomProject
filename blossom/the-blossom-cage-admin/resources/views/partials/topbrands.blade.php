<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div>
                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('storetopbrands')}}"
                      method="POST" method="POST" id="top_brand_banner_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="top_brands">
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label class="col-form-label">English Top Brand Banner: <span
                                            style=" color: red;">*</span></label>
                                <div class="d-flex justify-content-center p-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="btn btn-dark">
                                                <input type="file" class="file-upload_banner file-upload" data-value="1"
                                                       data-values="1" id="file-upload-banner"
                                                       accept="image/*">

                                                Upload New Photo
                                            </div>
                                            <span class="form-text text-muted">eg (H:800px X W:800px) – file size  1 to 5MB</span>
                                        </div>
                                        <span id="eng_image_message" class="form-text"
                                              style=" color: red;  display: none;"></span>

                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-3">
                            <label class="col-form-label">Perview English Brand Banner: <span
                                            style=" color: red;">*</span></label>
                                <div class="d-flex justify-content-center p-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                        @if(old('en_banner') !== null)
                                    <img id="prevBannerImage_1" style="padding-top: 10px !important;" height="120"
                                         width="150"
                                         alt="No Image"
                                         src="{{config('paths.home_url') . config('paths.medium-banners-thumb') . old('en_banner')}}"
                                    />
                                @else
                                    <div id="prevBannerImage_div1"  style="width:160px;background: #5e7976;float:left;text-align: center;">
                                        <img   style="max-width: 70px;height: auto;" width="160" alt="No Image"
                                               src="{{asset('public/theme-images/camera.png')}}">
                                    </div>
                                    <img  id="prevBannerImage_1" style="display: none;" width="160" alt="No Image"
                                          src="">
                                @endif
                                <input type="hidden" id="image_name_1" name="en_banner">
                                <input type="hidden" id="image_name_2" name="ar_banner">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            
                            
                            <div class="col-lg-3">
                                <label class="col-form-label">Arabic Top Brand Banner: <span
                                            style=" color: red;">*</span></label>
                                <div class="d-flex justify-content-center p-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="btn btn-dark">

                                                <input type="file" class="file-upload_banner file-upload" data-value="2"
                                                       data-values="2" id="file-upload-banner"
                                                       accept="image/*">

                                                Upload New Photo
                                            </div>
                                            <span class="form-text text-muted">eg (H:800px X W:800px) – file size  1 to 5MB</span>
                                        </div>
                                        <span id="ar_image_message" class="form-text"
                                              style=" color: red;  display: none;"></span>
                                    </div>
                                </div>

                            </div>



                         





                            <div class="col-lg-3">
                            <label class="col-form-label">Perview Arabic Brand Banner: <span
                                            style=" color: red;">*</span></label>
                                <div class="d-flex justify-content-center p-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                        @if(old('ar_banner') !== null)
                                    <img id="prevBannerImage_2" style="padding-top: 10px !important;" height="120"
                                         width="150"
                                         alt="No Image"
                                         src="{{config('paths.home_url') . config('paths.medium-banners-thumb') . old('ar_banner')}}"
                                    />
                                @else
                                    <div id="prevBannerImage_div2"  style="width:160px;background: #5e7976;float:left;text-align: center;">
                                        <img  style="max-width: 70px;height: auto;"  width="160" alt="No Image"
                                              src="{{asset('public/theme-images/camera.png')}}">
                                    </div>
                                    <img  id="prevBannerImage_2" style="display: none;" width="160" alt="No Image"
                                          src="">
                                @endif 
                                    
                                        </div>
                                
                                    </div>
                                </div>

                            </div>










                        </div>
                        <div class="form-group row">
                            <style>.select2-container {
                                    width: 100% !important;
                                }</style>

                            @if(!empty($brands))
                                <div class="col-lg-3" id="brand_div" >

                                    <label class="col-form-label"> Brands <span
                                                style=" color: red;">*</span></label>
                                    <select id="banner_brands"
                                            class="form-control js-example-basic-single validationClass_brands"
                                            name="brand_id">
                                        <option value="">Select Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->en_title}}</option>
                                        @endforeach
                                    </select>
                                    <span id="brand_id_message" class="form-text"
                                          style=" color: red;  display: none;"></span>

                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-8"></div>
                                <div class="col-lg-4">
                                    <button type="submit" id="filetopBrand" class="btn btn-success">Submit</button>
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
        <div class="modal-content" style=" min-width: 400px;">
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