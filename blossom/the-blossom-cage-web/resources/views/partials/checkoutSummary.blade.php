<div class="col-lg-4">
    <div class="box2 w100">
        <h6> {{ __('localization.products_information')}}</h6>
        <div class="navbar-cart-product-wrapper checkout_items">
            <!-- cart item-->
            @foreach(Session::get('items') as $item)

            <div id="parent_div" class="navbar-cart-product" style=" position: relative;">
                <div class="d-flex align-items-center">
                    <a href="{{route('itemDeatils', ['slug' => $item['slug']] )}}">
                        @if(!empty($item['color_image']))
                            <img src="{{config('paths.large_itemColor').$item['color_image']}}" class="img-fluid navbar-cart-product-image">
                        @else
                            <img src="{{$item['image']}}" class="img-fluid navbar-cart-product-image">
                        @endif
                    </a>
                    <div class="w-100">
                        <a id="removeFromBag_card" data-value="{{$item['uuid']}}" href="javascript:void(0)" class="close3 text-sm mr-2">
                            <i class="fa fa-times"></i>
                        </a>
                        <div class="pl-3">
                            @if(Session::get('locale') == 'ar')
                            <a href="{{route('itemDeatils', ['lang' => Session::get('locale'), 'slug' => $item['slug']] )}}" class="navbar-cart-product-link">{{$item['ar_title']}}</a>
                            @else
                            <a href="{{route('itemDeatils', ['lang' => Session::get('locale'), 'slug' => $item['slug']] )}}" class="navbar-cart-product-link">{{$item['en_title']}}</a>
                            @endif
                            <small class="d-block text-muted"> {{ __('localization.quantity')}}   : {{$item['quantity']}} </small>
                            <strong class="d-block text-sm">{{Session::get('cur_currency')}} {{$item['price'] * Session::get('amount_per_unit') }} </strong>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="block mb-5 Order_Summary">
            <h6 class="text-uppercase"> {{ __('localization.order_summary')}}</h6>
            <p> {{ __('localization.order_desc')}}</p>
            <div class="block-body bg-light pt-1">
                <ul class="order-summary mb-0 list-unstyled">
                    <li class="order-summary-item"><p> {{ __('localization.order_subtotal')}} </p><span id="sub_total" >{{Session::get('cur_currency')}} {{Session::get('total')}}</span></li>
                    <li class="order-summary-item"><p> {{ __('localization.shipping_handling')}}</p><span id="shipping_cost" >{{Session::get('cur_currency')}} {{Session::get('shipping_cost')}}</span></li>
                    <li class="order-summary-item"><p> {{ __('localization.vat_15')}}</p><span id="tax_amount">{{Session::get('cur_currency')}} {{Session::get('tax_amount')}}</span></li>
                    <li class="order-summary-item border-0"><p> {{ __('localization.total')}}</p><strong id="grand_total" class="order-summary-total">{{Session::get('cur_currency')}} {{Session::get('total') + Session::get('shipping_cost') + Session::get('tax_amount')}}</strong></li>
                </ul>
            </div>
        </div>
    </div><!--box2-->
</div>
