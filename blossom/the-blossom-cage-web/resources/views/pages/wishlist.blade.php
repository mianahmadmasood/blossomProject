@extends('layouts.item_listing')
@section('content')
    @inject('paths', 'App\Http\Services\Profile')
    <section class="Profilepage">
        <div class="container">
            <div class="row">
                @include('partials.pagesSideMenu')
                <div class="col-md-9">
                    @include('partials.messages')
                    <div class="Box_right">
                        <div class="cProfile">
                            <div class="MenuBox">
                                <p><i class="icon icon-user"></i> {{ __('localization.wishlist_btn')}} </p>
                                @if(Auth::check())
                                    @include('partials.mobile_menu')
                                @endif
                            </div><!--MenuBox-->
                            <div class="eHead">
                                <h3> {{ __('localization.my_wishlist')}}</h3>
                                <p> {{ __('localization.my_wishlist_desc')}}</p>
                            </div>
                            <div class="w100 mb-5 wishItems">
                                <div class="col-lg-12">
                                    <div class="cart">
                                        <div class="cart-wrapper">
                                            <div class="cart-header text-center">
                                                <div class="row">
                                                    <div class="col-5"> {{ __('localization.product')}}</div>
                                                    <div class="col-2"> {{ __('localization.price')}}</div>
                                                    <div class="col-3" style="text-align: center;"> {{ __('localization.buy')}}</div>
                                                    <div class="col-2"> {{ __('localization.action')}}</div>
                                                </div>
                                            </div>
                                            <div class="cart-body">
                                                <!-- Product-->

                                                @if(!empty($response['data']))
                                                    @foreach($response['data'] as $item)
                                                        <div class="cart-item" id="item_{{$item['item_id']}}">
                                                            <div class="row d-flex align-items-center text-center">
                                                                <div class="col-5">
                                                                    <div class="d-flex align-items-center">
                                                                        <a href="{{route('itemDeatils', ['lang' => Session::get('locale'),'slug' => $item['slug']])}}">
                                                                            @if(!empty($item['color_image']))
                                                                                <img src="{{config('paths.medium_itemColor').$item['color_image']}}" class="cart-item-img">
                                                                            @else
                                                                                <img src="{{config('paths.medium_item') .$item['image']}}" class="cart-item-img">
                                                                            @endif
                                                                        </a>
                                                                        <input type="hidden" id="slug"
                                                                               value="{{$item['slug']}}">
                                                                        <input type="hidden" id="image"
                                                                               value="{{config('paths.medium_item') .$item['image']}}">
                                                                        <div class="cart-title text-left">
                                                                            <a href="{{route('itemDeatils', ['lang' => Session::get('locale'),'slug' => $item['slug']])}}"
                                                                               class="text-uppercase text-dark"><strong
                                                                                    id="title">{{$item['title']}}</strong></a>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if(Session::has('cur_currency') && Session::get('cur_currency') == 'USD')
                                                                    <div id="price"
                                                                         data-value="{{$item['price'] * Session::get('amount_per_unit')}}"
                                                                         class="col-2 text-center">
                                                                        ${{$item['price'] * Session::get('amount_per_unit')}}</div>
                                                                @else
                                                                    <div id="price" data-value="{{$item['price']}}"
                                                                         class="col-2 text-center">{{$item['price']}} {{ __('localization.riyals')}}</div>
                                                                @endif
                                                                <div class="col-3" >
                                                                    <a style="cursor: pointer; float: none !important; " href="{{route('itemDeatils', ['lang' => Session::get('locale'),'slug' => $item['slug']])}}"
                                                                       class="btn btn-primary btn-lg float-left">
                                                                        {{ __('localization.buy')}}
                                                                    </a>
                                                                </div>
                                                                <div class="col-2 text-center crosico"><a id="removeFromList"
                                                                                                  data-itemuuid="{{$item['item_id']}}"
                                                                                                  data-uuid="{{$item['uuid']}}"
                                                                                                  class="cart-remove">
                                                                        <i class="fa fa-times"></i></a></div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="wishlist-message"> {{ __('localization.wishlist')}}</p>
                                                @endif
                                                <p id="wishlistmessage" style="display: none;"
                                                   class="wishlist-message"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!--cProfile-->
                    </div><!--Box_right-->
                </div>
            </div><!--row-->
        </div>
    </section><!--Profilepage-->
@endsection
