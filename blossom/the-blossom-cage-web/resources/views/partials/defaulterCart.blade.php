<?php $outStockItem =0; ?>
@foreach(Session::get('items') as $key => $item)

    @foreach(Session::get('outof_stock_items') as $o_item)
        @if($item['uuid'] == $o_item['uuid'] && $item['color_id'] == $o_item['color_id'] )
            <?php $outStockItem =$o_item['color_id']; ?>
            <div id="parent_div" class="cart-item  alert-outofstock">
                <div class="row d-flex align-items-center text-center">
                    <div class="col-5">
                        <div class="d-flex align-items-center">
                            <a href="{{route('itemDeatils', ['lang'  => Session::get('locale'), 'slug' => $item['slug']])}}">
                                @if(!empty($item['color_image']))
                                    <img src="{{config('paths.large_itemColor').$item['color_image']}}"
                                         class="cart-item-img">
                                @else
                                    <img src="{{$item['image']}}" class="cart-item-img">
                                @endif
                            </a>
                            <div class="cart-title text-left">
                                <a href="{{route('itemDeatils', ['lang'  => Session::get('locale') , 'slug' => $item['slug']])}}"
                                   class="text-uppercase text-dark">
                                    @if(Session::get('locale') == 'ar')
                                        <strong>{{$item['ar_title']}}</strong>
                                    @else
                                        <strong>{{$item['en_title']}}</strong>
                                    @endif
                                </a>
                                @if(!empty($item['color_code']))
                                    <span class="techColordiv">
                                    <i class="item active" style="background: {{$item['color_code']}};"></i>
                                    <label id="colorName">{{$item['color_name']}}   </label>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-2"><i class="col-fot-total">{{ __('localization.sub_total')}}</i> {{Session::get('cur_currency')}} {{$item['price'] * Session::get('amount_per_unit')}}
                    </div>
                    <div class="col-2">
                        <div class="d-flex align-items-center">
                            <input type="number" data-value="{{$item['color_id']}}" value="{{$item['quantity']}}"
                                   class="form-control text-center input-items" oninput="validity.valid||(value='');"
                                   min="1" step="1" data-max="{{$item['cart_quantity']}}" data-maxcolor="{{$item['color_quantity']}}">
                        </div>
                        <div style="padding-top: 10px;" class="maxValueAlter{{$item['color_id']}}"></div>
                    </div>
                    <div id="total_price_{{$item['color_id']}}" class="col-2 text-center"><i
                            class="col-fot-total">{{ __('localization.total')}}</i>{{Session::get('cur_currency')}} {{round((($item['price'] * Session::get('amount_per_unit')) * $item['quantity']),2) }}
                    </div>
                    <div class="col-1 text-center">
                        <a id="removeFromBag_card" data-value="{{$item['color_id']}} " href="javascript:void(0)"
                           class="cart-remove">
                            <i class="fa fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                @if(!empty($item['orderItemAccessories']))
                    <h6>{{ __('localization.AccessoriesList')}}</h6>
                    <?php $counter =1;?>
                    @foreach($item['orderItemAccessories'] as $orderItemAccessoire)

                        <div id="accessoriesRows{{$orderItemAccessoire['id']}}" class="row d-flex align-items-center text-center accessoriesRow w100" >
                            <div class="col-5">
                                <div class="d-flex align-items-center">

                                    <a href="javascript:void(0)" >
                                        <img
                                            src="{{config('paths.small-accessories-thumb') . $orderItemAccessoire['image']}}" style="height: 40px;width: 40px;">
                                    </a>
                                    <div class="cart-title text-left">
                                        <a href="{{route('itemDeatils', ['lang'  => Session::get('locale') , 'slug' => $item['slug']])}}"
                                           class="text-uppercase text-dark">
                                            @if(!empty($orderItemAccessoire) && $orderItemAccessoire['must_purchase'] == 1)
                                                @if(Session::get('locale') == 'ar')
                                                    <span class="accessories_qty_{{$item['color_id']}}">{{$item['quantity']}}</span> x {{$orderItemAccessoire['ar_title']}} <span style=" color: red;">*</span>
                                                @else
                                                    <span class="accessories_qty_{{$item['color_id']}}">{{$item['quantity']}}</span> x {{$orderItemAccessoire['en_title']}} <span style=" color: red;">*</span>
                                                @endif
                                            @else
                                                @if(Session::get('locale') == 'ar')
                                                    1 x {{$orderItemAccessoire['ar_title']}}
                                                @else
                                                    1 x {{$orderItemAccessoire['en_title']}}
                                                @endif
                                            @endif

                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-2 ddnon">
                                {{Session::get('cur_currency')}}  {{($orderItemAccessoire['price'] * Session::get('amount_per_unit'))}}
                            </div>
                            <div class="col-2">

                            </div>
                            <div  class="col-2 text-center">
                                <i class="col-fot-total"> {{ __('localization.total')}}</i>
                                {{Session::get('cur_currency')}}
                                @if(!empty($orderItemAccessoire) && $orderItemAccessoire['must_purchase'] == 1)
                                    <span id="total_price_accesoires_{{$item['color_id']}}_{{$counter}}" class="total_price_accesoires_{{$item['color_id']}}" data-values="{{$orderItemAccessoire['price']}}" data-value-counter="{{$counter}}">
                        {{($orderItemAccessoire['price']  * $item['quantity'])}}
                        </span>
                                @else
                                    <span >
                        {{($orderItemAccessoire['price']  * Session::get('amount_per_unit'))}}
                        </span>
                                @endif

                            </div>

                            <div class="col-1 text-right">

                                @if(!empty($orderItemAccessoire) && $orderItemAccessoire['must_purchase'] != 1)

                                    <a data-value="{{$orderItemAccessoire['id']}}" data-value-uuid="{{$item['color_id']}}" href="javascript:void(0)" class="cart-remove removeFromBag_accessoires_card">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="close-1" width="100%"
                                             height="100%" style="stroke-width: 4px;width:31px;">
                                            <path data-name="layer1" fill="none" stroke="#202020" stroke-miterlimit="10"
                                                  d="M41.999 20.002l-22 22m22 0L20 20" stroke-linejoin="round"
                                                  stroke-linecap="round" style="stroke:var(--layer1, #202020)"></path>
                                        </svg>
                                    </a>
                                @else
                                    <?php $counter++;?>

                                @endif

                            </div>

                        </div>
                    @endforeach
                    <input type="hidden" id="accesoires_counter{{$item['color_id']}}" value="{{$counter}}">
                @endif
                @if(!empty($o_item['message']) )
                    <span style=" color: red;"> {{$o_item['message']}} </span>
                @else
                    <span style=" color: red;"> {{ __('localization.max_quanity_change')}} </span>
                @endif
            </div>
        @endif
    @endforeach
    @if( $item['color_id'] != $outStockItem )
    <div id="parent_div" class="cart-item">
        <div class="row d-flex align-items-center text-center">
            <div class="col-5">
                <div style="display: none;" class="d-flex align-items-center">
                    <a href="{{route('itemDeatils', ['lang'  => Session::get('locale'), 'slug' => $item['slug']])}}">
                        @if(!empty($item['color_image']))
                            <img src="{{config('paths.small_itemColor').$item['color_image']}}" class="cart-item-img">
                        @else
                            <img src="{{$item['image']}}" class="cart-item-img">
                        @endif
                    </a>
                    <div class="cart-title text-left">
                        <a href="{{route('itemDeatils', ['lang'  => Session::get('locale') , 'slug' => $item['slug']])}}"
                           class="text-uppercase text-dark">
                            @if(Session::get('locale') == 'ar')
                                <strong>{{$item['ar_title']}}</strong>
                            @else
                                <strong>{{$item['en_title']}}</strong>
                            @endif
                        </a>
                        @if(!empty($item['color_code']))
                            <span class="techColordiv">
                            <i class="item active" style="background: {{$item['color_code']}};"></i>
                            <label id="colorName">{{$item['color_name']}}   </label>

                        </span>
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-2"><i class="col-fot-total">{{ __('localization.sub_total')}}</i> {{Session::get('cur_currency')}} {{$item['price'] * Session::get('amount_per_unit')}}
            </div>
            <div class="col-2">
                <div class="d-flex align-items-center">
                    <input type="number" data-value="{{$item['color_id']}}" value="{{$item['quantity']}}"
                           class="form-control text-center input-items" oninput="validity.valid||(value='');" min="1"
                           step="1" data-max="{{$item['cart_quantity']}}" data-maxcolor="{{$item['color_quantity']}}">
                </div>
                <div style="padding-top: 10px;" class="maxValueAlter{{$item['color_id']}}"></div>
            </div>
            <div id="total_price_{{$item['color_id']}}" class="col-2 text-center"><i
                    class="col-fot-total">{{ __('localization.total')}}</i>{{Session::get('cur_currency')}} {{round((($item['price'] * Session::get('amount_per_unit')) * $item['quantity']),2) }}
            </div>

            <div class="col-1 text-center">
                <a id="removeFromBag_card" data-value="{{$item['color_id']}} " href="javascript:void(0)"
                   class="cart-remove">
                    <i class="fa fa-trash-alt"></i>
                </a>
            </div>
        </div>
        @if(!empty($item['orderItemAccessories']))
            <h6>{{ __('localization.AccessoriesList')}}</h6>
            <?php $counter =1;?>
            @foreach($item['orderItemAccessories'] as $orderItemAccessoire)

                <div id="accessoriesRows{{$orderItemAccessoire['id']}}" class="row d-flex align-items-center text-center accessoriesRow w100" >
                    <div class="col-5">
                        <div class="d-flex align-items-center">

                            <a href="javascript:void(0)" >
                                <img
                                    src="{{config('paths.small-accessories-thumb') . $orderItemAccessoire['image']}}" style="height: 40px;width: 40px;">
                            </a>
                            <div class="cart-title text-left">
                                <a href="{{route('itemDeatils', ['lang'  => Session::get('locale') , 'slug' => $item['slug']])}}"
                                   class="text-uppercase text-dark">
                                    @if(!empty($orderItemAccessoire) && $orderItemAccessoire['must_purchase'] == 1)
                                        @if(Session::get('locale') == 'ar')
                                            <span class="accessories_qty_{{$item['color_id']}}">{{$item['quantity']}}</span> x {{$orderItemAccessoire['ar_title']}} <span style=" color: red;">*</span>
                                        @else
                                            <span class="accessories_qty_{{$item['color_id']}}">{{$item['quantity']}}</span> x {{$orderItemAccessoire['en_title']}} <span style=" color: red;">*</span>
                                        @endif
                                    @else
                                        @if(Session::get('locale') == 'ar')
                                            1 x {{$orderItemAccessoire['ar_title']}}
                                        @else
                                            1 x {{$orderItemAccessoire['en_title']}}
                                        @endif
                                    @endif

                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-2 ddnon">
                        {{Session::get('cur_currency')}}  {{($orderItemAccessoire['price'] * Session::get('amount_per_unit'))}}
                    </div>
                    <div class="col-2">

                    </div>
                    <div  class="col-2 text-center">
                        <i class="col-fot-total"> {{ __('localization.total')}}</i>
                        {{Session::get('cur_currency')}}
                        @if(!empty($orderItemAccessoire) && $orderItemAccessoire['must_purchase'] == 1)
                            <span id="total_price_accesoires_{{$item['color_id']}}_{{$counter}}" class="total_price_accesoires_{{$item['color_id']}}" data-values="{{$orderItemAccessoire['price']}}" data-value-counter="{{$counter}}">
                        {{($orderItemAccessoire['price']  * $item['quantity'])}}
                        </span>
                        @else
                            <span >
                        {{($orderItemAccessoire['price']  * Session::get('amount_per_unit'))}}
                        </span>
                        @endif

                    </div>

                    <div class="col-1 text-right">

                        @if(!empty($orderItemAccessoire) && $orderItemAccessoire['must_purchase'] != 1)

                            <a data-value="{{$orderItemAccessoire['id']}}" data-value-uuid="{{$item['color_id']}}" href="javascript:void(0)" class="cart-remove removeFromBag_accessoires_card">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="close-1" width="100%"
                                     height="100%" style="stroke-width: 4px;width:31px;">
                                    <path data-name="layer1" fill="none" stroke="#202020" stroke-miterlimit="10"
                                          d="M41.999 20.002l-22 22m22 0L20 20" stroke-linejoin="round"
                                          stroke-linecap="round" style="stroke:var(--layer1, #202020)"></path>
                                </svg>
                            </a>
                        @else
                            <?php $counter++;?>

                        @endif

                    </div>

                </div>
            @endforeach
            <input type="hidden" id="accesoires_counter{{$item['color_id']}}" value="{{$counter}}">
        @endif
    </div>
    @endif

@endforeach
