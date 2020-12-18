

<div class="cProduct_lft">
    <h3>{{ __('localization.filter')}}</h3>
    <div class="MenuIcon" id="menuIconButton"></div>
    <div class="FilterBox" id="filterBoxDev">

        <div class="close-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="close-1" width="100%" height="100%">
                <path data-name="layer1" fill="none" stroke="#202020" stroke-miterlimit="10"
                      d="M41.999 20.002l-22 22m22 0L20 20" stroke-linejoin="round" stroke-linecap="round"
                      style="stroke:var(--layer1, #202020)"></path>
            </svg>
        </div>

        <div class="accordion w100 indicator-plus-before round-indicator" id="accordionH" aria-multiselectable="true">
        <!--<form method="GET" action="{{route('searchItem')}}">-->

            <div class="card">
                {{--                <h3> {{ __('localization.category')}}</h3>--}}
                @foreach($data['categories'] as $key=> $cat)
                    <div class="card-row">
                        <div class="card-header" href="#collapse{{$key+1}}" data-toggle="collapse" aria-expanded="false"
                             aria-controls="collapse1">
                            {{ucwords(strtolower($cat['title']))}}
                            <small class="linered"></small>
                        </div>
                        <div class="collapse @if($key+1 == 1) show @endif " id="collapse{{$key+1}}" collapsed>
                            <div class="card-body w100">
                                @foreach($cat['sub_categories'] as $s_cat)
                                    <div class="checkboxfilter">
                                        <?php
                                        $flag = '';

                                        if (!empty($data['selected_categories'])) {

                                            if (in_array($s_cat['slug'], $data['selected_categories'])) {
                                                $flag = 'checked';
                                            }
                                        }
                                        ?>
                                        <input type="checkbox" name="categories[]" id="checkboxG<?= $s_cat['uuid'] ?>"
                                               class="css-checkbox category categories @if( $flag =='checked') checkedCategory @endif " value="{{$s_cat['slug']}}" <?= $flag ?> />

                                            <label for="checkboxG<?= $s_cat['uuid'] ?>"
                                               class="css-label radGroup1  @if( $flag =='checked') checkboxfilterchecked  @endif  ">{{ucwords(strtolower($s_cat['title']))}}</label>

                                    </div><!--rdcheck-->

                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach


                <div class="card-row">
                    <div class="card-header" href="#collapse04" data-toggle="collapse" aria-expanded="false"
                         aria-controls="collapse1">
                         {{ __('localization.brand')}}
                        <small class="linered"></small>
                    </div>
                    <div class="collapse show" id="collapse04" collapsed>
                        <div class="card-body w100">
                            <div class="brandList w100">

                                @foreach($data['brands'] as $key=> $brand)

                                    <?php
                                    $flag = '';
                                    if (!empty($data['selected_brands'])) {
                                        if (in_array($brand['slug'], $data['selected_brands'])) {
                                            $flag = 'active';
                                        }
                                    }
                                    ?>

                                    <a href="javascript:void(0)" class="brandfilter <?= $flag ?>" data-value="{{$brand['slug']}}">
                                    @if(!empty($brand['image']))
                                        <img src="{{config('paths.large_brand') . $brand['image']}}">
                                    @else
                                        <img
                                            src="{{config('paths.large_item') . 'Category_5d78c6753f1e81568196213.jpg'}}">
                                    @endif
                                    </a>
                                @endforeach
                            </div><!--brandList-->
                        </div>
                    </div>
                </div>

                <div class="card-row">
                    <div class="card-header" href="#collapse05" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                        {{ __('localization.price')}}
                        <small class="linered"></small>
                    </div>
                    <div class="collapse show" id="collapse05" collapsed>
                        <div class="card-body w100">
                            <div class="priceMinMax w100">
                                <?php
                                if(!empty($data['price'])){
                                $priceMax = explode(',',$data['price']);

                                }

                                ?>
                                    <textarea style="resize: none; "  name="priceMin"  id="priceMin"    autocomplete="false" placeholder="{{ __('localization.min')}}">{{ !empty($priceMax[0]) ? $priceMax[0] : ''}}</textarea>
{{--                                <input  type="text" name="priceMin"  id="priceMin"   value="{{ !empty($priceMax[0]) ? $priceMax[0] : '0'}}" autocomplete="false" >--}}
                                <span>-</span>
                                    <textarea style="resize: none; height: 30px;width: 52px;"   name="priceMax"  id="priceMax"   autocomplete="false" placeholder="{{ __('localization.max')}}">{{ !empty($priceMax[1]) ? $priceMax[1] : ''}}</textarea>
                            </div><!--priceMinMax-->
                        </div>
                    </div>
                </div><!--card-row-->



{{--                <div class="applyReset  w100">--}}
{{--                    <button id="submitBtn" type="submit" class="Reset"> {{ __('localization.apply_filter')}}</button>--}}
{{--                    <a href="{{ URL::to('/'). '/' . Session::get('locale') .'/' . 'products' . '?category=all' }}"--}}
{{--                       class="Reset"> {{ __('localization.reset_filter')}}</a>--}}
{{--                </div><!--w100-->--}}

                <div class="applyReset w100">
                    <a class="active" href="javascript:void(0)" id="submitBtn" type="submit" >{{ __('localization.apply_filter')}}</a>
                    <a href="{{ URL::to('/'). '/' . Session::get('locale') .'/' . 'products' . '?category=all' }}">{{ __('localization.reset_filter')}}</a>
                </div><!--applyReset-->


            </div><!--card-->
            <!--</form>-->
        </div>

    </div><!--FilterBox-->

</div><!--cProduct_lft-->
