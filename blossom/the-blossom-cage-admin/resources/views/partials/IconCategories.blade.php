<div class="form-group row">
    <label class="col-lg-2 col-form-label">Category icon Image:</label>
    <div class="col-lg-3">
        <div class="d-flex justify-content-center p-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="btn btn-dark">
                        <input type="file" class="file-upload" id="file-upload-icon-categories"
                               name="brand_picture" accept="image/*">
                        Upload New Photo
                    </div>
                    <span class="form-text text-muted">eg (H:75px X W:75px) – file size  0 to 300kB</span>
                </div>

            </div>
        </div>
        <input id="icon_image" type="hidden" name="icon_image" value="{{old('icon_image')}}" />
    </div>

    @if(!empty($category->icon_image))
        <label class="col-lg-2 col-form-label">Existing Category Icon Image</label>
        <img id="prevIconCategoriesImage"  style="background: #cac3c3;" height="75"
             width="75" alt="No Image" src="{{config('paths.home_url') . 'thumbnails/medium/categories/' . $category->icon_image}}">

    @elseif(old('icon_image') !== null)
        <label class="col-lg-2 col-form-label">Preview</label>
        <img id="prevIconCategoriesImage" style="background: #cac3c3;" height="75"
             width="75"
             alt="No Image" src="{{config('paths.home_url') . config('paths.medium-categories-thumb') . old('icon_image')}}"
        />

    @else
        <label class="col-lg-2 col-form-label">Preview</label>
        <img id="prevIconCategoriesImage" style="background: #cac3c3;" height="75"
             width="75"
             alt="No Image" src="{{asset('public/theme-images/camera.png')}}"/>
    @endif
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

                <button type="button" class="btn btn-block btn-dark" id="upload-icon-category-image" data-myval="12">
                    Crop And Upload
                </button>
            </div>
        </div>
    </div>
</div>