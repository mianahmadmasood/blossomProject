@extends('layouts.item_listing')
@section('content')
    <section class="cCart">
        <style>
            .modal-open {
                overflow: unset!important;
            }
        </style>
        <div class="container">
            @include('partials.messages')
            <div class="row">
                <div class="col-md-12">
                    <div class="w100 pageStatus mb-3 breadcrumbs_box">
                        <a href="{{route('home')}}"> {{ __('localization.h_btn')}}</a>
                        <a href="">/</a>
                        <a href="#"> {{ __('localization.shopping_cart')}}</a>
                    </div><!--w100-->
                    <div class="w100">
                        <div class="hero-content pb-5 text-center">
                            <h1 class="hero-heading"> {{ __('localization.shopping_cart')}}</h1>
                        </div>
                    </div><!--w100-->
                </div><!--col-md-12-->
            </div><!--row-->
            <div id="main_container" class="row mb-5">

                @if(!empty(Session::get('items')))
                    <div class="col-lg-8">
                        <div class="cart">
                            <div class="cart-wrapper">
                                <div class="cart-header text-center">
                                    <div class="row">
                                        <div class="col-5"> {{ __('localization.product')}}</div>
                                        <div class="col-2"> {{ __('localization.price')}}</div>
                                        <div class="col-2">{{ __('localization.quantity')}}</div>
                                        <div class="col-2"> {{ __('localization.total')}}</div>
                                        <div class="col-1"></div>
                                    </div>
                                </div>
                                <div class="cart-body cart-fix">
                                    @if(Session::has('outof_stock_items'))
                                        @include('partials.defaulterCart')
                                    @else
                                        @include('partials.cart')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="block mb-5 Order_Summary">
                            <h6 class="text-uppercase"> {{ __('localization.order_summary')}}</h6>
                            <p> {{ __('localization.order_desc')}}</p>
                            <div class="block-body bg-light pt-1">
                                <ul class="order-summary mb-0 list-unstyled">
                                    <li class="order-summary-item"><p> {{ __('localization.order_subtotal')}} </p>
                                        <span
                                            id="sub_total">{{Session::get('cur_currency')}} {{Session::get('total')}}</span>
                                    </li>
                                    <li class="order-summary-item"><p> {{ __('localization.shipping_handling')}}</p>
                                        <span
                                            id="shipping_cost">{{Session::get('cur_currency')}}  {{ Session::get('shipping_cost')}}</span>
                                    </li>
                                    <li class="order-summary-item"><p> {{ __('localization.vat_15')}}</p><span
                                            id="tax_amount"> {{ Session::get('cur_currency') }} {{ Session::get('tax_amount') }} </span>
                                    </li>
                                    <li class="order-summary-item border-0"><p> {{ __('localization.price')}}</p>
                                        <strong id="grand_total"
                                                class="order-summary-total">{{Session::get('cur_currency')}} {{ round((Session::get('total')+Session::get('shipping_cost')+Session::get('tax_amount')) , 2)}}</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">

                    <div class="w100 checkoutbtn">
                        <a href="{{route('searchItem', ['lang'  => Session::get('locale') , '?category=all'])}} "
                           class="btn btn-link text-muted float-left">
                            <i class="fa fa-chevron-left"></i> {{ __('localization.continue_shopping')}}
                        </a>
                        @if(Auth::check())
                            <a id="checkoutPage" href="{{route('checkout')}}" class="btn btn-outline-dark float-right">
                                {{ __('localization.proceed_checkout')}}
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        @else
                            <a style="color: white;" id="checkoutPage" data-toggle="modal" data-target="#checkout-modal"
                               class="btn btn-outline-dark float-right">
                                {{ __('localization.proceed_checkout')}}
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        @endif
                    </div>

            </div>
            @else
                <div class="col-md-12" style="text-align: center; min-height: 200px;">
                    <p> {{ __('localization.empty_cart')}}, <a
                            href="{{route('home')}}"> {{ __('localization.continue_shopping')}}</a></p>
                </div>
            @endif
        </div><!--container-->
    </section><!--cCart-->
    <script>
        (function () {

            window.inputNumber = function (el) {

                var min = el.attr('min') || false;
                var max = el.attr('max') || false;

                var els = {};

                els.dec = el.prev();
                els.inc = el.next();

                el.each(function () {
                    init($(this));
                });

                function init(el) {

                    els.dec.on('click', decrement);
                    els.inc.on('click', increment);

                    function decrement() {
                        var value = el[0].value;
                        value--;
                        if (!min || value >= min) {
                            el[0].value = value;
                        }
                    }

                    function increment() {
                        var value = el[0].value;
                        value++;
                        if (!max || value <= max) {
                            el[0].value = value++;
                        }
                    }
                }
            }
        })();

        inputNumber($('.input-number'));
    </script>
@endsection
