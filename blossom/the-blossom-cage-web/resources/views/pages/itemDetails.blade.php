@extends('layouts.item_listing')
@section('content')
    @if(!empty($item))
        <style> .modal-open {
                height: auto !important;
            }
        </style>

        <section class="product_detail">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @include('partials.messages')
                        <div class="pDetail">
                            <div class="pdet_lft">
                                <div class="owlBox1">
                                    <div id="owl-1" class="owl-carousel owl-theme">
                                        @foreach($item['images'] as $image)
                                            <div
                                                class="item zoom-image @if(!empty($itemcolorNameforedit) && $itemcolorNameforedit == $row['color']) owl-item active @endif ">
                                                <img src="{{config('paths.medium_item') . $image}}" data-original-image="{{config('paths.large_item') . $image}}" alt="" class="product-photo">
                                            </div>
                                        @endforeach
                                        @if(!empty($item['ItemsColors']))
                                            @foreach($item['ItemsColors'] as $imageColor)
                                                @foreach($imageColor['color_images'] as $rowimagepath)
                                                    @if(!empty($rowimagepath))

                                                        <div
                                                            class="item zoom-image  ">
                                                            <img src="{{config('paths.medium_itemColor') . $rowimagepath}}" data-original-image="{{config('paths.large_itemColor') . $rowimagepath}}" alt="" class="product-photo">
                                                        </div>

                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </div>
                                    <div id="owl-2" class="owl-carousel owl-theme">
                                        @foreach($item['images'] as $image)
                                            <div class="item">
                                                <img src="{{config('paths.small_item') . $image}}" alt="" class="image">
                                            </div>
                                        @endforeach

                                        @if(!empty($item['ItemsColors']))
                                            @foreach($item['ItemsColors'] as $imageColor)
                                                @foreach($imageColor['color_images'] as $rowimagepath)
                                                    @if(!empty($rowimagepath))
                                                        <div class="item">
                                                            <img
                                                                src="{{config('paths.small_itemColor') . $rowimagepath}}"
                                                                alt="" class="image">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </div>
                                </div><!--owlBox1-->
                            </div><!--pdet_lft-->
                            <div class="pdet_rit">
                                <div class="pageStatus">
                                    <a href="{{route('home')}}"> {{ __('localization.h_btn')}}</a>
                                    <a href="#">/</a>
                                    <a href="{{route('searchItem')}}"> {{ __('localization.p_btn')}}</a>
                                    <a href="#">/</a>
                                    <a href="{{URL::to('/'). '/' .Session::get('locale') .'/products?category='. $item['category_slug']}}"> {{$item['category_title']}}</a>
                                    <a href="#">/</a>
                                    <a href="#">{{$item['title']}}</a>
                                </div><!--pageStatus-->
                                <h3>{{$item['title']}} </h3>
                                <p style="white-space: pre-wrap;">{{ $item['info'] }} </p>
                                <div class="techDetail w100">
                                    <div class="dimensions">
                                        @if(!empty($item['brand']))
                                            <span><small> {{ __('localization.brand')}} </small> {{$item['brand']}}</span>
                                        @endif
                                        @if(!empty($item['weight']))
                                            <span><small> {{ __('localization.weight')}} </small> {{$item['weight']}} ( {{$item['weight_unit']}})</span>
                                        @endif
                                        @if(!empty($item['lenght']))
                                            <span><small> {{ __('localization.lenght')}} </small> {{$item['lenght']}} ( {{$item['orientation_unit']}})</span>
                                        @endif
                                        @if( !empty($item['width']))
                                            <span><small> {{ __('localization.width')}} </small> {{$item['width']}} ( {{$item['orientation_unit']}})</span>
                                        @endif
                                        @if(!empty($item['height']))
                                            <span><small> {{ __('localization.height')}} </small> {{$item['height']}} ({{$item['orientation_unit']}})</span>
                                        @endif
                                        @if(!empty($item['unit_attributes']) && !empty($item['unit_attributes'][0]['value']) && !empty($item['unit_attributes'][0]['unit']))
                                            <span><small> {{ __('localization.unitofpower')}} </small> {{$item['unit_attributes'][0]['value']}} ( {{ ($item['unit_attributes'][0]['unit'])}})</span>
                                        @endif
                                    </div>
                                </div>


                                @if(!empty($item['ItemsColors']))
                                    <div class="techColor">
                                        <span style="text-transform: capitalize;"><small
                                                style="margin: 0px 4px 0 0;">{{ __('localization.cl_btn')}}</small> (<label
                                                id="colorName">{{$item['ItemsColors'][0]['color']}}</label>)</span>
                                        <div id="owl-3" class="owl-carousel owl-theme">
                                            <?php $count = 0; $indxCounter = 0; ?>
                                            @foreach($item['images'] as $image)
                                                <div class="item itemcolorActive" style="display: none">
                                                </div>
                                                <?php $indxCounter++;  ?>
                                            @endforeach
                                            @foreach($item['ItemsColors'] as $key=> $row)
                                                <?php $count++;
                                                $itemcolorNameforedit = Session::get('itemcolorNameforedit');
                                                ?>

                                                <i class="item itemcolorActive @if(!empty($itemcolorNameforedit) && $itemcolorNameforedit == $row['color']) active @endif"
                                                   data-value="{{$count}}"
                                                   data-qty="{{$row['color_quantity']}}"
                                                   data-image-qty="{{count($row['color_images'])}}"
                                                   data-image-qty-counter="{{ $indxCounter}}"
                                                   style="background: {{$row['color_code']}}; ">
                                                    @if(empty($row['color_quantity']) && $row['color_quantity'] == 0)

                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"
                                                             id="close-1" width="100%" height="100%">
                                                            <path data-name="layer1" fill="none" stroke="#fff"
                                                                  stroke-miterlimit="10"
                                                                  d="M41.999 20.002l-22 22m22 0L20 20"
                                                                  stroke-linejoin="round" stroke-linecap="round"
                                                                  style="stroke:var(--layer1, #fff); stroke-width: 3px;"></path>
                                                        </svg>

                                                    @endif

                                                </i>

                                                <?php  $indxCounter = $indxCounter + count($row['color_images']);?>

                                                <input type="hidden" id="color_id_{{$count}}" value="{{$row['id']}}">
                                                <input type="hidden" id="color_name_{{$count}}"
                                                       value="{{$row['color']}}">
                                                <input type="hidden" id="color_item_id_{{$count}}"
                                                       value="{{$row['item_id']}}">
                                                <input type="hidden" id="color_item_variant_id_{{$count}}"
                                                       value="{{$row['item_variant_id']}}">
                                                <input type="hidden" id="color_quantity_{{$count}}"
                                                       value="{{$row['color_quantity']}}">
                                                <input type="hidden" id="color_code_{{$count}}"
                                                       value="{{$row['color_code']}}">
                                                @if(!empty($row['color_images'][0]))
                                                    <input type="hidden" id="color_image_{{$count}}"
                                                           value="{{$row['color_images'][0]}}">
                                                @endif

                                            @endforeach
                                        </div>
                                        <span id="itemcolorAdderrormassage"
                                              style="color: red;font-size: 12px; display: none;"><b>{{ __('localization.pleaseselectaitemcolor')}}</b></span>
                                    </div>
                                @endif
                            <!--techColor-->

                                @if(!empty($item['itemAccessories']))
                                    <div class="w100 accessories">
                                        <span><small>{{ __('localization.accessories')}}:</small></span>
                                        @foreach($item['itemAccessories'] as $itemAccessorie)
                                            <a href="javascript:void(0)"
                                               class="accessoriesSelected  @if($itemAccessorie['must_purchase'] == '1')selected selecteds @endif"
                                               @if($itemAccessorie['must_purchase'] == '1') style="pointer-events: none;"
                                               @endif data-value="{{$itemAccessorie['id']}}-{{$itemAccessorie['en_title']}}-{{$itemAccessorie['ar_title']}}-{{$itemAccessorie['price']}}-{{$itemAccessorie['image']}}-{{$itemAccessorie['must_purchase']}}">
                                                <img
                                                    src="{{config('paths.small-accessories-thumb') . $itemAccessorie['image']}}">
                                                @if($itemAccessorie['must_purchase'] == '1')
                                                    <i class="aaCheck ok">
                                                        <img src="{{asset('public/assets/images/bigCheck-green.png')}}"></i>
                                                    {{--                                                    <i class=" selected ACcheck ok">--}}
                                                    {{--                                                                                                                <img src="{{asset('public/assets/images/ok.png')}}"></i>--}}
                                                @else

                                                    <i class=" selected ACcheck ok">
                                                        <img src="{{asset('public/assets/images/cUncheck-green.png')}}"></i>
                                                    {{--                                                    <i class=" selected ACcheck ok">--}}
                                                    {{--                                                    <img  src="{{asset('public/assets/images/cUncheck.png')}}"></i>--}}

                                                    {{--                                                    <i class="aaCheck ok">--}}
                                                    {{--                                                        <input type="checkbox" name="checkboxG4" id="checkboxG6" class="css-checkbox" />--}}
                                                    {{--                                                        <label for="checkboxG6" class="css-label radGroup1"></label>--}}
                                                    {{--                                                    </i>--}}

                                                @endif
                                                <strong>{{Session::get('cur_currency')}} {{ numberFormat( $itemAccessorie['price'])}}</strong>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="pAdded">
                                    @if(!empty($item['ItemsColors']))
                                    <div id="firstbuttonValue">
                                        <?php $itemcolorqty = 0; ?>

                                        @foreach($item['ItemsColors'] as $row)
                                            <?php
                                            $itemcolorqty += $row ['color_quantity']
                                            ?>
                                        @endforeach
                                        @if($itemcolorqty === 0)
                                            <a class="BagAdded"
                                               style=" background: red !important;">{{ __('localization.prduct_outof_stock_btn')}}</a>
                                        @else

                                            <a hreflang="javascript:void(0)" id="addToBag"
                                               class="BagAdded addToBagValue " style="cursor: pointer;"
                                               data-uid="{{$item['uuid']}}" data-category="{{$item['category_slug']}}">
                                                <i id="loader-btn" class="dn"><img
                                                        src="{{asset('/public/images/ajax-loader.gif')}}" alt=""/> </i>
                                                <i id="check" class="fa fa-check dn"></i>
                                                {{ __('localization.add_to_cart')}}
                                            </a>

                                            {{--                                        @include('partials.cartBtn')--}}
                                        @endif

                                    </div>
                                    @endif
                                    <div id="outStockbuttonValue" style="display: none">
                                        <a class="BagAdded"
                                           style=" background: red !important;">{{ __('localization.prduct_outof_stock_btn')}}</a>
                                    </div>
                                    <div id="addtocartbuttonValue" style="display: none">


                                        <a hreflang="javascript:void(0)" id="addToBag" class="BagAdded addToBagValue "
                                           style="cursor: pointer;"

                                           data-uid="{{$item['uuid']}}" data-category="{{$item['category_slug']}}">
                                            <i id="loader-btn" class="dn"><img
                                                    src="{{asset('/public/images/ajax-loader.gif')}}" alt=""/> </i>
                                            <i id="check" class="fa fa-check dn"></i>
                                            {{ __('localization.add_to_cart')}}
                                        </a>

                                    </div>

                                    @if(Auth::check())
                                        @if($item['is_favorite'] === true)
                                            <a class="favorited" id="rmFav" data-uuid="{{$item['uuid']}}"
                                               href="javascript:void(0)"></a>
                                            <a class="favAdded" id="addToFav" data-uuid="{{$item['uuid']}}"
                                               style=" display:  none;"></a>
                                        @else
                                            <a class="favAdded" id="addToFav" data-uuid="{{$item['uuid']}}"
                                               href="javascript:void(0)"></a>
                                            <a class="favorited" id="rmFav" data-uuid="{{$item['uuid']}}"
                                               style=" display: none;"></a>
                                        @endif
                                    @else
                                        <a data-toggle="modal" data-target="#Signin_modal" data-uuid="{{$item['uuid']}}"
                                           class="favAdded" href="javascript:void(0)"></a>
                                    @endif

                                    <div class="priceBox salePrice">
                                        @if(!empty($item['sale_price']))
                                            <h6
                                                class="price psale">{{Session::get('cur_currency')}} {{numberFormat($item['price'] * Session::get('amount_per_unit'))}}</h6>
                                            <h6 class="priceBox" id="price"
                                                data-value="{{$item['sale_price']}}">{{Session::get('cur_currency')}} {{numberFormat($item['sale_price'] * Session::get('amount_per_unit'))}}</h6>
                                        @else
                                            <h6 id="price"
                                                data-value="{{$item['price']}}">{{Session::get('cur_currency')}} {{numberFormat($item['price'] * Session::get('amount_per_unit'))}}</h6>
                                        @endif
                                    </div>

                                    <div class="ordererrormassage"></div>


                                    <input type="hidden" id="slug" value="{{$item['slug']}}">
                                    <input type="hidden" id="image"
                                           value="{{config('paths.small_item') . $item['images'][0]}}">
                                    <input type="hidden" id="uuid" value="{{$item['uuid']}}">
                                    <input type="hidden" id="title" value="{{$item['title']}}">
                                    <input type="hidden" id="ar_title" value="{{$item['ar_title']}}">
                                    <input type="hidden" id="en_title" value="{{$item['en_title']}}">
                                    <input type="hidden" id="weight" value="{{$item['weight']}}">
                                    <input type="hidden" id="weight_unit" value="{{$item['weight_unit']}}">
                                    <input type="hidden" id="lenght" value="{{$item['lenght']}}">
                                    <input type="hidden" id="height" value="{{$item['height']}}">
                                    <input type="hidden" id="width" value="{{$item['width']}}">
                                    <input type="hidden" id="orientation_unit" value="{{$item['orientation_unit']}}">
                                    <input type="hidden" id="cart_quantity" value="{{$item['cart_quantity']}}">
                                    <input type="hidden" id="undiscounted_price" value="{{$item['price']}}">
                                </div><!--pAdded-->

                            </div><!--pdet_rit-->
                        </div><!--pDetail-->
                    </div><!--col-md-12-->
                    <div class="col-md-12">
                        <div class="ptabz">
                            <div id="exTab2">
                                <ul class="nav nav-tabs">
                                    <li><a class="active show" href="#1"
                                           data-toggle="tab"> {{ __('localization.info')}}</a></li>
                                    @if(!empty($item['techspecs']) || !empty($item['specs']))
                                        <li><a href="#2"
                                               data-toggle="tab"> {{ __('localization.technical_specs')}}</a>
                                        </li>
                                    @endif
                                    @if(!empty($item['video_url']))
                                        <li><a class="" href="#3"
                                               data-toggle="tab"> {{ __('localization.v_btn')}}</a></li>
                                    @endif
                                    @if(!empty($item['manual']))
                                        <li><a href="#4" data-toggle="tab"> {{ __('localization.m_btn')}}</a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="1">
                                        <p style="white-space: pre-wrap;">{{ $item['short_info'] }} </p>
                                    </div>
                                    <div class="tab-pane" id="2">
                                        @if(!empty($item['techspecs']) &&  $item['techspecs'] != null)

                                            <div
                                                style="font-size: 13px;color: #505050;float: left;width: 100%;margin: 8px 0 23px;line-height: 22px;padding: 20px 24px 20px;text-align: left;background: #fff;box-shadow: 0px 0px 6px 0px rgba(0,0,0,0.1);min-height: 200px;">

                                                @foreach($item['techspecs'] as $row)
                                                    <strong class="itemSpecDtailStrong">
                                                        {{ucfirst($row['specs'])}} :
                                                    </strong>
                                                    <span class="itemSpecDtailSpec">
                                                {{ucfirst($row['value'])}}  @if(!empty($row['unit']))
                                                            ( {{$row['unit']}} ) @endif
                                                </span>
{{--                                                    <span class="itemSpecDtailSpec">--}}
{{--                                                {{ucfirst($row['value'])}} {{ ucfirst($row['desp_unit'])}}  @if(!empty($row['unit']))--}}
{{--                                                            ( {{$row['unit']}} ) @endif--}}
{{--                                                </span>--}}

                                                @endforeach
                                            </div>
                                        @else
                                            @if($item['specs'] != null)
                                                <p> {{$item['specs']}} </p>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="tab-pane" id="3">
                                        @if(!empty($item['video_url']))
                                            <div class="videoBox">
                                                <iframe id="video" width="100%" height="400px"
                                                        src="{{$item['video_url']}}" frameborder="0"
                                                        allowfullscreen></iframe>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="tab-pane" id="4">
                                        @if(!empty($item['manual']))
                                            <div class="pdf_info">
                                                <img src="{{asset('/public/images/pdf_file.png')}}">
                                                <a target="_blank"
                                                   href="https://d4q3rypwox3wu.cloudfront.net/manuals/{{$item['manual']}}"
                                                   download>
                                                    <h4>Tap to download</h4>
                                                    <span>{{$item['manual_title']}}.pdf</span>
                                                </a>
                                            </div>
                                        @endif

                                    </div>
                                </div><!--tab-content-->
                            </div>
                        </div><!--ptabz-->
                    </div><!--row-->
                </div><!--row-->
            </div><!--container-->
        </section><!--product_detail-->

        @include('partials.relatedItem')

    @endif
@endsection


