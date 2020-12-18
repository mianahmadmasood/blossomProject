<div class="form-group row row_{{$counter}}">
    <div class="col-md-3">
        <span class="form-text">Color</span>
        <select id="item_color{{$counter}}"  class=" form-control item_color js-example-basic-single itemcolorDropdwon itemcolorDropdwon_{{$counter}}"  name="color[{{$counter}}][item_color]" >
            <option value="" data-values1="{{$counter}}">Select Color</option>
            @foreach($colors as $color)
                <option style="color: {{ $color->color_code}} ;"  value="{{$color->id}}" data-values="{{ $color->color_code}}" data-values1="{{$counter}}" data-value="{{$color->en_title}} - {{$color->ar_title}}">
                    {{$color->en_title}} - {{$color->ar_title}}
                </option>
            @endforeach
        </select>

        <span class="form-text text-muted">Please Select Color</span>

        <span id="cn_message" class="form-text"
              style=" color: red;  display: none;"></span>
    </div>
    <div class="col-md-1" id="colorShow_{{$counter}}" style="display: none" ></div>


    <div class="col-md-3">
        <span class="form-text">Quantity</span>
        <input id="color_qty" type="number" class="form-control itemcolorQuantity_{{$counter}}" placeholder=""
               name="color[{{$counter}}][color_qty]" oninput="validity.valid||(value='');" min="1" step="1"  pattern="^[0-9]"  onKeyPress="if (this.value.length == 4)
                                                return false;" >
        <span class="form-text text-muted">Please enter Item Quantity</span>
        <span id="ciq_message" class="form-text"
              style=" color: red;  display: none;"></span>
    </div>
    @include('partials.itemColorImages')
{{--    @if($counter != 1)--}}
{{--    <div class="col-lg-1">--}}
{{--        <span  class="remove_itemColor_row"  data-value="1" style=" margin-top: 5%;margin-left: 35%;cursor: pointer;"> X </span>--}}
{{--    </div>--}}
{{--    @endif--}}
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
<script src="{{asset('public/js/cropper.js')}}"></script>