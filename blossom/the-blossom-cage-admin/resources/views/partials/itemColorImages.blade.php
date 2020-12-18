@php
$row_id = rand();
@endphp

<div class="row" id="prevItemColorImage_{{$row_id}}">
    @if(old('images') !== null)
    @foreach(old('images') as $image)
    @php
    $image_name = explode('.', $image);
    $image_id = $image_name[0];
    @endphp
    <div id="image_div_{{$image_id}}" class="profile-img1 p-3">
        <a class="close closeItemColor" data-img="{{$image}}">×</a>
        <img  src="{{config('paths.home_url') . config('paths.medium-items-thumb') . $image}}" alt="No Image">
        <input id="image_item_{{$image_id}}" type="hidden"  name="color_image[{{$counter}}][]" value="{{$image}}">
    </div>
    @endforeach
    @endif
</div>
<div class="d-flex justify-content-center p-3">
    <div class="card text-center">
        <div class="card-body">
            <div class="btn btn-dark">
                <input type="file" class="file-upload_ME file-upload" data-value="{{$row_id}}" data-values="{{$counter}}" id="file-upload-item-color"
                       name="profile_picture" accept="image/*">
                Upload
            </div>
            <span class="form-text text-muted">file size  1 to 5MB</span>
        </div>
        <span id="c_image_message" class="form-text"
              style=" color: red;  display: none;"></span>
    </div>
</div>



<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style=" min-width: 500px;">
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

                <button type="button" class="btn btn-block btn-dark upload-item-color-image" VALUE="{{$row_id}}" id="upload-item-color-image" >
                    Crop And Upload
                </button>
            </div>
        </div>
    </div>
</div>
