@extends('layouts.item_listing')
@section('content')
    @inject('paths', 'App\Http\Services\Profile')
    <section class="Profilepage">
        <?php   $priceAccessoiresMust = 0;
        $priceAccessoires = 0;
        ?>


        <div class="container">
            <div class="pageStatus mrg0 breadcrumbs_box" >
                <a href="{{route('home')}}"> {{ __('localization.h_btn')}}</a>
                <a href="#">/</a>
                @if($response['data']['transaction_status'] == 'pending' || $response['data']['transaction_status'] == 'rejected' && Session::has('old_order_id') )
                    <a href="{{route('checkout')}}"> {{ __('localization.checkout')}}</a>
                @else
                    <a href="#"> {{ __('localization.my_orders')}}</a>
                @endif
                @if($response['data']['transaction_status'] == 'pending' || $response['data']['transaction_status'] == 'rejected' && Session::has('old_order_id') )
                    <a href="#">/</a>
                    <a href="#"> {{ __('localization.pay_now')}}</a>
                @endif

            </div>
            <div class="row w100">
                @if($response['data']['transaction_status'] != 'pending' || $response['data']['transaction_status'] != 'rejected' && $response['data']['cod'] != 0)

                    @if(Auth::check() )
                        @include('partials.pagesSideMenu')
                        <div class="col-md-9">
                            @include('partials.messages')
                            @endif
                            @else

                                <div class="col-md-12">
                                    @include('partials.messages')
                                    @endif
                                    <div class="Box_right">

                                        @if($response['data']['transaction_status'] != 'pending' || $response['data']['transaction_status'] != 'rejected' && $response['data']['cod'] != 0)
                                            <div class="MenuBox">
                                                <p><i class="icon icon-user"></i> {{ __('localization.my_orders')}} </p>
                                                @if(Auth::check())
                                                    @include('partials.mobile_menu')
                                                @endif
                                            </div><!--MenuBox-->
                                        @endif
                                        <div class="cProfile">
                                            <div class="box1 OrdersBox">
                                                <div class="Order_detail">
                                                    <div class="ddetail">
                                                        <h6>{{ __('localization.order')}}
                                                            <small>#{{$response['data']['order_id']}}</small></h6>
                                                        <div class="ddlist">
                                                            <h4> {{ __('localization.order_information')}}</h4>
                                                            <div class="w100">
                                                                <p> {{ __('localization.order_number')}}</p>
                                                                <span> #{{$response['data']['order_id']}}</span>
                                                            </div>
                                                            <div class="w100">
                                                                <p> {{ __('localization.sale_time')}}</p>
                                                                <span> {{date('Y-m-d', strtotime($response['data']['date']))}}</span>
                                                            </div>
                                                            @if($response['data']['status_id'] !== 1)
                                                                <div class="w100">
                                                                    <p> {{ __('localization.order_status')}}</p>
                                                                    @if($response['data']['transaction_status'] == 'rejected')
                                                                        <span
                                                                            class="red"> {{ __('localization.payment_rejected')}}</span>
                                                                    @elseif($response['data']['status_id'] == 2)
                                                                        <span
                                                                            class="green"> {{ __('localization.processing')}}</span>
                                                                    @elseif($response['data']['status_id'] == 3)
                                                                        <span
                                                                            class="green"> {{ __('localization.dispatched')}}</span>
                                                                    @elseif($response['data']['status_id'] == 4)
                                                                        <span
                                                                            class="green">  {{ __('localization.delivered')}}</span>
                                                                    @elseif($response['data']['status_id'] == 5)
                                                                        <span
                                                                            class="red" style=" color: red;font-weight: 600;">  {{ __('localization.canceled')}}</span>
                                                                @elseif($response['data ']['status_id'] == 6)
                                                                        <span
                                                                            class="red" style=" color: red;font-weight: 600;">  {{ __('localization.rejected')}}</span>
                                                                    @endif
                                                                </div>
                                                                @else
                                                                <div class="w100">

                                                                    @if($response['data']['transaction_status'] == 'rejected')
                                                                        <p> {{ __('localization.order_status')}}</p>
                                                                        <span
                                                                            class="red" style=" color: red;">  {{ __('localization.rejected')}}</span>
                                                                    @endif
                                                                    @if($response['data']['transaction_status'] != 'pending')
                                                                            <p> {{ __('localization.order_status')}}</p>
                                                                    <span
                                                                        class="green">  {{ __('localization.received')}}</span>
                                                                        @endif
                                                                </div>

                                                            @endif
                                                        </div>
                                                        <div class="ddlist">
                                                            <h4> {{ __('localization.customer_information')}}</h4>
                                                            <div class="w100">
                                                                <p> {{ __('localization.customer_name')}}</p>
                                                                <span> {{$response['data']['recipient_first_name']}}  {{$response['data']['recipient_last_name']}}</span>
                                                            </div>
                                                            <div class="w100">
                                                                <p> {{ __('localization.customer_email')}}</p>
                                                                <span> {{$response['data']['recipient_email']}} </span>
                                                            </div>
                                                            <div class="w100">
                                                                <p> {{ __('localization.customer_phone')}}</p>
                                                                <span
                                                                    style="direction: ltr!important;"> {{$response['data']['recipient_phone_no']}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="w100">
                                                            <div class="ddlist">
                                                                <h4> {{ __('localization.payment_information')}}</h4>
                                                                <div class="w100">
                                                                    <p> {{ __('localization.payment_method')}}</p>
                                                                    <span>{{!empty($response['data']['cod']) == 0 ? 'Paytabs' : 'COD'}}</span>
                                                                </div>
                                                                <div class="w100">
                                                                    <p> {{ __('localization.order_currency')}}</p>
                                                                    <span>  {{$response['data']['order_currency']}}</span>
                                                                </div>
                                                                @if($response['data']['transaction_status'] == 'rejected')
                                                                    <div class="w100">
                                                                        <p>{{ __('localization.payment_status')}}</p>
                                                                        <span
                                                                            style=" color: red;"> {{$response['data']['message']}} </span>
                                                                    </div>
                                                                @endif

                                                            </div>
                                                            <div class="ddlist">
                                                                <h4> {{ __('localization.shipping_information')}}</h4>
                                                                <div class="w100">
                                                                    <p> {{ __('localization.shipping_service')}}</p>
                                                                    <span> SMSA</span>
                                                                </div>
                                                                <div class="w100">
                                                                    <p> {{ __('localization.chipping_cost')}}</p>
                                                                    <span> {{$response['data']['order_currency']}} {{$response['data']['converted_shipping_amount']}}</span>
                                                                </div>
                                                                <div class="w100">
                                                                    <p> {{ __('localization.shipping_address')}}</p>
                                                                    <span>

                                                                     @if(!empty($response['data']['shipping_first_name']) || !empty($response['data']['shipping_last_name']))
                                                                            {{!empty($response['data']['shipping_first_name'])?  $response['data']['shipping_first_name']: '' }}
                                                                            {{!empty($response['data']['shipping_last_name'])?  $response['data']['shipping_last_name']: '' }}
                                                                            <br>
                                                                        @endif
                                                                         @if(!empty($response['data']['shipping_email']) )
                                                                         {{$response['data']['shipping_email'] }}
                                                                         <br>
                                                                         @endif
                                                                        {{!empty($response['data']['shipping_phone_no'])?  $response['data']['shipping_phone_no']: '' }}
                                                                        {{$response['data']['shipping_address']}},{{$response['data']['shipping_address']}}, {{$response['data']['shipping_city']}}, {{$response['data']['shipping_state']}}, <br>{{$response['data']['shipping_zipcode']}}, {{$response['data']['shipping_country']}}</span>
                                                                </div>
                                                                <div class="w100">
                                                                    <p> {{ __('localization.billing_address')}}</p>
                                                                    <span>
                                                                    @if(!empty($response['data']['billing_first_name']) || !empty($response['data']['billing_last_name']))
                                                                            {{!empty($response['data']['billing_first_name'])?  $response['data']['billing_first_name']: '' }}
                                                                            {{!empty($response['data']['billing_last_name'])?  $response['data']['billing_last_name']: '' }}
                                                                            <br>
                                                                        @endif
                                                                        @if(!empty($response['data']['billing_email']) )
                                                                            {{$response['data']['billing_email'] }}
                                                                            <br>
                                                                        @endif
                                                                        {{!empty($response['data']['billing_phone_no'])?  $response['data']['billing_phone_no']: '' }}
                                                                        {{$response['data']['billing_address']}}, {{$response['data']['billing_city']}},
                                                                    {{$response['data']['billing_state']}}, <br>{{$response['data']['billing_zipcode']}},
                                                                    {{$response['data']['billing_country']}}
                                                                </span>
                                                                </div>

                                                            </div>
                                                        </div><!--w100-->
                                                        <div class="w100 citemz">
                                                            <h4> {{ __('localization.purchased_items')}}</h4>
                                                            @php $total =  0; @endphp

                                                            <div class="w100">
                                                                <div class="cart-wrapper">
                                                                    <div class="cart-header text-center">
                                                                        <div class="row">
                                                                            <div
                                                                                class="col-5"> {{ __('localization.product')}}</div>
                                                                            <div
                                                                                class="col-2"> {{ __('localization.price')}}</div>
                                                                            <div
                                                                                class="col-2">{{ __('localization.quantity')}}</div>
                                                                            <div
                                                                                class="col-2"> {{ __('localization.total')}}</div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="cart-body cart-fix">
                                                                        @foreach($response['data']['items'] as $item)

                                                                            <div id="parent_div" class="cart-item">
                                                                                <div
                                                                                    class="row d-flex align-items-center text-center">
                                                                                    <div class="col-5">
                                                                                        <div style="display: none;"
                                                                                             class="d-flex align-items-center">
                                                                                            <a href="{{route('itemDeatils', ['lang'  => Session::get('locale'), 'slug' => $item['slug']])}}">
                                                                                                @if(!empty($item['color_image']))
                                                                                                    <img
                                                                                                        src="{{config('paths.small_itemColor').$item['color_image']}}"
                                                                                                        class="cart-item-img">
                                                                                                @else
                                                                                                    <img
                                                                                                        src="{{config('paths.small_item').$item['image']}}"
                                                                                                        class="cart-item-img">
                                                                                                @endif

                                                                                            </a>
                                                                                            <div
                                                                                                class="cart-title text-left">

                                                                                                <strong>{{$item['title']}}</strong>

                                                                                                @if(!empty($item['color_code']))
                                                                                                    <span
                                                                                                        class="techColordiv">
                                                                                                    <i class="item active"
                                                                                                       style="background: {{$item['color_code']}};"></i>
                                                                                                    <label
                                                                                                        id="colorName">{{$item['color_name']}}</label>
                                                                                                </span>
                                                                                                @endif

                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-2">
                                                                                        <i class="col-fot-total">{{ __('localization.sub_total')}}</i>
                                                                                        {{$response['data']['order_currency']}} {{$item['converted_price']  }}
                                                                                    </div>
                                                                                    <div class="col-2">
                                                                                        <i class="col-fot-total">{{ __('localization.quantity')}}</i>
                                                                                        {{$item['quantity']}}
                                                                                    </div>
                                                                                    <div id="total_price_209"
                                                                                         class="col-2 text-center"><i
                                                                                            class="col-fot-total">{{ __('localization.total')}}</i>
                                                                                        {{$response['data']['order_currency']}} {{$item['converted_price'] * $item['quantity']}}
                                                                                    </div>


                                                                                </div>
                                                                                @if(!empty($item['orderItemAccessories']))
                                                                                    <h6 style="padding: 8px 5px 8px 5%;">{{ __('localization.AccessoriesList')}}</h6>
                                                                                    @foreach($item['orderItemAccessories'] as $orderItemAccessoire)
                                                                                        <div id="accessoriesRows"
                                                                                             class="row d-flex align-items-center text-center accessoriesRow w100">
                                                                                            <div class="col-5">
                                                                                                <div
                                                                                                    class="d-flex align-items-center">

                                                                                                    <a href="javascript:void(0)">
                                                                                                        <img
                                                                                                            src="{{config('paths.small-accessories-thumb') . $orderItemAccessoire['image']}}"
                                                                                                            style="height: 40px;width: 40px;">
                                                                                                    </a>
                                                                                                    <div
                                                                                                        class="cart-title text-left">
                                                                                                        <a href="{{route('itemDeatils', ['lang'  => Session::get('locale') , 'slug' => $item['slug']])}}"
                                                                                                           class="text-uppercase text-dark">
                                                                                                            @if(!empty($orderItemAccessoire) && $orderItemAccessoire['must_purchase'] == 1)
                                                                                                                @if(Session::get('locale') == 'ar')
                                                                                                                    {{$item['quantity']}}
                                                                                                                    x {{$orderItemAccessoire['ar_title']}}
                                                                                                                    <b style=" color: red;">*</b>
                                                                                                                @else
                                                                                                                    {{$item['quantity']}}
                                                                                                                    x {{$orderItemAccessoire['en_title']}}
                                                                                                                    <b style=" color: red;">*</b>
                                                                                                                @endif
                                                                                                            @else
                                                                                                                @if(Session::get('locale') == 'ar')
                                                                                                                    1
                                                                                                                    x {{$orderItemAccessoire['ar_title']}}
                                                                                                                @else
                                                                                                                    1
                                                                                                                    x {{$orderItemAccessoire['en_title']}}
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
                                                                                            <div
                                                                                                class="col-2 text-center">
                                                                                                <i class="col-fot-total"> {{ __('localization.total')}}</i>
                                                                                                {{Session::get('cur_currency')}} {{($orderItemAccessoire['price']  * $orderItemAccessoire['quantity'])}}
                                                                                            </div>

                                                                                            <div
                                                                                                class="col-1 text-right">

                                                                                            </div>

                                                                                        </div>
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style="display:none" class="orderItems">
                                                                <div class="oimg">
                                                                    @if(!empty($item['color_image']))
                                                                        <img
                                                                            src="{{config('paths.small_itemColor').$item['color_image']}}"
                                                                            class="cart-item-img">
                                                                    @else
                                                                        <img
                                                                            src="{{config('paths.small_item') .$item['image']}}">
                                                                    @endif
                                                                </div>
                                                                <div class="oInfo">
                                                                    <strong>{{$item['title']}}</strong>
                                                                    @if(!empty($item['color_code']))
                                                                        <span class="techColordiv">
                                                                        <i class="item active"
                                                                           style="background: {{$item['color_code']}};"></i>
                                                                        <label
                                                                            id="colorName">{{$item['color_name']}}</label>
                                                                    </span>
                                                                    @endif
                                                                    @if(!empty($item['orderItemAccessories']))
                                                                        <?php   $priceAccessoiresMust = 0;
                                                                        $priceAccessoires = 0;
                                                                        ?>
                                                                        @foreach($item['orderItemAccessories'] as $orderItemAccessoire)
                                                                            <?php
                                                                            if (!empty($orderItemAccessoire['must_purchase']) && $orderItemAccessoire['must_purchase'] == 1) {
                                                                                $priceAccessoiresMust = $priceAccessoiresMust + $item['quantity'] * ($orderItemAccessoire['price'] * Session::get('amount_per_unit'));
                                                                            } else {
                                                                                $priceAccessoires = $priceAccessoires + 1 * ($orderItemAccessoire['price'] * Session::get('amount_per_unit'));
                                                                            }
                                                                            ?>
                                                                            <div class="w100 accessories mrg0">
                                                                                <a href="#"
                                                                                   style="height: 40px;width: 40px;"><img
                                                                                        src="{{config('paths.small-accessories-thumb') . $orderItemAccessoire['image']}}">

                                                                                </a>
                                                                                <p>@if(Session::get('locale') == 'ar')
                                                                                        {{$orderItemAccessoire['ar_title']}}
                                                                                    @else
                                                                                        {{$orderItemAccessoire['en_title']}}
                                                                                    @endif
                                                                                    <small>
                                                                                        {{ __('localization.price')}}
                                                                                        : {{$response['data']['order_currency']}} {{$orderItemAccessoire['price']}}
                                                                                    </small>
                                                                                </p>

                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div><!--oInfo-->
                                                                <div class="oInfo">
                                                                    <span> {{$response['data']['order_currency']}} {{$item['converted_price']  }} X {{$item['quantity']}}</span>
                                                                </div><!--oInfo-->
                                                                <div class="oInfo">
                                                                    <span> {{$response['data']['order_currency']}} {{$item['converted_price'] * $item['quantity']}}</span>
                                                                    @php $total = $total + ($item['converted_price'] * $item['quantity']) + $priceAccessoiresMust + $priceAccessoires; @endphp
                                                                </div><!--oInfo-->

                                                            </div><!--orderItems-->

                                                        </div>
                                                    </div><!--w100-->
                                                    <div class="ddetail mrg0">

                                                    </div><!--w100-->
                                                </div>
                                                <div class="oSummary">
                                                    <div class="block mb-3 Order_Summary">
                                                        <div class="block-body pt-1">
                                                            <ul class="order-summary mb-0 list-unstyled">
                                                                <li class="order-summary-item">
                                                                    <p> {{ __('localization.order_subtotal')}} </p>
                                                                    <span> {{$response['data']['order_currency']}} {{$total}}</span>
                                                                </li>
                                                                <li class="order-summary-item">
                                                                    <p> {{ __('localization.shipping_handling')}}</p>
                                                                    <span> {{$response['data']['order_currency']}} {{$response['data']['converted_shipping_amount']}}</span>
                                                                </li>
                                                                <li class="order-summary-item">
                                                                    <p> {{ __('localization.vat_15')}}</p>
                                                                    <span>{{$response['data']['order_currency']}} {{$response['data']['converted_tax_amount'] }}</span>
                                                                </li>
                                                                <li class="order-summary-item border-0">
                                                                    <p> {{ __('localization.total')}}</p><strong
                                                                        class="order-summary-total"> {{$response['data']['order_currency']}} {{$response['data']['converted_total_amount'] }}</strong>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div><!--oSummary-->
                                                @if($response['data']['transaction_status'] == 'pending' || $response['data']['transaction_status'] == 'rejected' && $response['data']['cod'] == 0)
                                                    <div class="row" style="padding-top: 10px; padding-left: 10px;">
                                                        <div class="col-md-12">
                                                            @include('partials.payment')
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div><!--cProfile-->
                                    </div><!--Box_right-->
                                </div>
                        </div><!--row-->
            </div>
        </div>
    </section><!--Profilepage-->

@endsection
