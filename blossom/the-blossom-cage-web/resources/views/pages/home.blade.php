@extends('layouts.item_listing')
@section('content')
    <section class="cCategories">
        <div class="container">
            @include('partials.messages')
            <div class="row">
                <div class="aboutBox2">
                    <div class="col-md-12">
                        <div class="pageStatus" style="text-align:center!important">
                            <a href="{{route('home')}}"> {{ __('localization.h_btn')}}</a>
                            <a href="#">/</a>
                            <a href="{{route('searchItem')}}"> {{ __('localization.categories')}}</a>
                        </div>
                        <div class="w100">
                            <div class="hero-content pb-5 text-center">
                                <h1 class="hero-heading"> {{ __('localization.top_categories')}}</h1>
                            </div>
                        </div>
                        <div class="w100 topCat">
                            @foreach($response['data']['categories'] as $cat)
                                <a href="javascript:void(0)" class="serviceBox2" id="link" attr-slug="{{$cat['slug']}}">
                                    <div class="w100">
                                        @if(!empty($cat['image']))
                                            <img src="{{config('paths.large_category') .$cat['image']}}">
                                        @else
                                            <img src="{{asset('public/images/no_image.jpg')}}">
                                        @endif
                                        <h2>{{$cat['title']}}</h2>
                                    </div><!--serviceBox-->
                                </a>
                            @endforeach
                        </div><!--w100-->
                    </div><!--col-md-12-->
                </div>
            </div><!--row-->
        </div><!--container-->
    </section><!--cProducts-->
    <div class="w100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
{{--                    <div class="cfeatIn Featured">--}}
{{--                        <h3>{{ __('localization.featured_product')}}</h3>--}}
{{--                        <div class="cfList" id="listview">--}}
{{--                            <div id="owl-featured" class="owl-carousel owl-theme">--}}
{{--                                @foreach($featured_items as $item)--}}
{{--                                    <div>--}}
{{--                                        <div class="h_list">--}}
{{--                                            <a href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $item['slug']])}}">--}}
{{--                                                <div class="cfitem">--}}
{{--                                                    @if(!empty($item['image']))--}}
{{--                                                        <img src="{{config('paths.large_item') . $item['image']}}">--}}
{{--                                                    @else--}}
{{--                                                        <img--}}
{{--                                                            src="{{config('paths.large_item') . 'Category_5d78c6753f1e81568196213.jpg'}}">--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </a>--}}
{{--                                            <a class="h_head"--}}
{{--                                               href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $item['slug']])}}">--}}
{{--                                                <h4>{{$item['title']}}--}}
{{--                                                </h4>--}}
{{--                                                @if(!empty($item['sale_price']))--}}
{{--                                                    <p style="text-decoration: line-through; font-size: 12px;">{{Session::get('cur_currency')}} {{$item['price'] * Session::get('amount_per_unit') }}</p>--}}
{{--                                                    <i> {{Session::get('cur_currency')}} {{$item['sale_price'] * Session::get('amount_per_unit') }} </i>--}}
{{--                                                @else--}}
{{--                                                    <p>{{Session::get('cur_currency')}} {{$item['price'] * Session::get('amount_per_unit') }}</p>--}}
{{--                                                @endif--}}
{{--                                            </a>--}}
{{--                                            @if(Auth::check())--}}
{{--                                                @if($item['is_favorite'] === true)--}}
{{--                                                    <div class="addToFav active" id="rmToFav_home"--}}
{{--                                                         data-uuid="{{$item['uuid']}}"></div>--}}
{{--                                                @else--}}
{{--                                                    <div class="addToFav" id="addToFav_home"--}}
{{--                                                         data-uuid="{{$item['uuid']}}"></div>--}}
{{--                                                @endif--}}
{{--                                            @else--}}
{{--                                                <a class="addToFav" data-toggle="modal" data-target="#Signin_modal"></a>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}

{{--                            </div>--}}
{{--                        </div><!--cfList-->--}}
{{--                    </div><!--cfeatIn-->--}}
                    @if(!empty($brands))
                    <div class="aboutBox">
                        <div class="col-md-12">
                            <div class="w100">
                                <div class="hero-content pb-5 text-center">
                                    <h1 class="hero-heading"> {{ __('localization.our_brands')}}</h1>
                                </div>
                            </div>
                            <div class="cPartners">
                                <div id="aboutOwl" class="w100 carousel_v2 owl-carousel owl-theme">
                                    @foreach($brands as $brand)
                                        <a href="javascript:void(0)" class="serviceBox2" id="link" attr-slug="all&brands={{$brand['slug']}}">
                                            <div>
                                            @if(!empty($brand['image']))
                                                <img src="{{config('paths.large_brand') . $brand['image']}}">
                                            @else
                                                <img
                                                    src="{{config('paths.large_item') . 'Category_5d78c6753f1e81568196213.jpg'}}">
                                            @endif
                                        </div>
                                        </a>
                                    @endforeach
                                </div><!--w100-->
                            </div><!--cPartners-->
                        </div><!--col-md-12-->
                    </div><!--aboutBox2-->
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
