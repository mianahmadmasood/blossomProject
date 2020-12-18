@extends('layouts.main')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Edit Sub Category
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('updateSubCategory')}}" method="POST" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">English Title: <span style=" color: red;">*</span></label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Enter category title" name="en_title" value="{{$category->en_title}}">
                                <input type="hidden" class="form-control" name="id" value="{{$category->id}}" maxlength="255">
                                <span class="form-text text-muted">Please enter category title in English</span>
                            </div>
                            <label class="col-lg-2 col-form-label">Arabic Title:<span style=" color: red;">*</span></label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Enter category title" name="ar_title" value="{{$category->ar_title}}" maxlength="255">
                                <span class="form-text text-muted">Please enter category title in Arabic</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Select Parent Category</label>

                            <div class="col-lg-3" id="parent_category">
                                <select style="width: 100%;"class="js-example-basic-single" id="js-example-basic-single-sub-cat" name="parent_id">
                                    <option selected="" value="{{$category->parent_category->id}}"> {{$category->parent_category->en_title}} - {{$category->parent_category->ar_title}}</option>
                                    @foreach($categories as $cat)
                                    <option value="{{$cat->id}}"> {{$cat->en_title}} - {{$cat->ar_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Category Image:</label>
                            <div class="col-lg-3">
                                <div class="d-flex justify-content-center p-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="btn btn-dark">
                                                <input type="file" class="file-upload" id="file-upload"
                                                       name="brand_picture" accept="image/*">
                                                Upload New Photo
                                            </div>
                                            <span class="form-text text-muted">eg (H:800px X W:800px) – file size  1 to 5MB</span>
                                        </div>

                                    </div>
                                </div>
                                <input id="image_name" type="hidden" name="image"/>
                            </div>

                            @if(empty($category->image))
                                <label class="col-lg-2 col-form-label">Preview</label>
                                <img id="prevCategoriesImage" style="padding-top: 10px !important;" height="257"
                                     width="257" alt="No Image" src="{{asset('public/theme-images/camera.png')}}"/>
                            @else
                                <label class="col-lg-2 col-form-label">Existing Category Image:</label>
                                <div class="col-lg-3">
                                    <img id="prevCategoriesImage"  style="padding-top: 10px !important;" height="257"
                                         width="257" alt="No Image" src="{{config('paths.home_url') . 'thumbnails/medium/categories/' . $category->image}}">
                                </div>

                            @endif
                            <br>

                        </div>

                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-success">Update</button>
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
@if(isset($categories))
    <input type="hidden" value="{{$category->parent_category->id}}" id="parent_cat_id">
@foreach($categories as $cat)
<div class="modal" id="myModalForSubCategory{{$cat->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style=" min-width: 600px;">
            <!-- Modal Header -->
            <div class="modal-header" >
                <h4 class="modal-title">Parent Category changed</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                 This “parent Category({{$cat->en_title}})” have {{$cat->items_count}} products. If you want to change the category, First you should go to edit product page then you can change parent category one by one.!
            </div>
{{--            <div class="modal-footer">--}}
{{--                <button id="catpopcancell"> close</button>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
@endforeach
@endif

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

                <button type="button" class="btn btn-block btn-dark" id="upload-category-image" >
                    Crop And Upload
                </button>
            </div>
        </div>
    </div>
</div>

<!--end::Portlet-->
<script>

    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });

</script>
@endsection