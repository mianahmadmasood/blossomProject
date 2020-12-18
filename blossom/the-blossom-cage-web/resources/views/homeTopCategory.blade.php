@if(!empty($response['homefeeds']['data']['top_categories_1']) || !empty($response['homefeeds']['data']['top_categories_2']) || !empty($response['homefeeds']['data']['top_categories_3']) || !empty($response['homefeeds']['data']['top_categories_4']) || !empty($response['homefeeds']['data']['top_brands']) || !empty($response['homefeeds']['data']['falshDeals']) )
    <section class="cInfoBox">
        <div class="overlayer"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cInfoIn w100">
                        @if(!empty($response['homefeeds']['data']['top_categories_1']) || !empty($response['homefeeds']['data']['top_categories_2']) || !empty($response['homefeeds']['data']['top_categories_3']) || !empty($response['homefeeds']['data']['top_categories_4']) )
                            <div class="cTop_category">
                                <h4><img
                                        src="{{asset('public/assets/images/icon_16.png')}}">{{ __('localization.TopCategories')}}
                                </h4>
                                <div class="w100">
                                    @if(!empty($response['homefeeds']['data']['top_categories_1']))
                                        <div class="cIList">

                                            @if(App::getLocale() === 'ar')
                                                <a href="{{URL::to('/'). '/' .Session::get('locale') .'/products?category='. $response['homefeeds']['data']['top_categories_1'][0]['category_slug']}}">

                                                <h5>{{$response['homefeeds']['data']['top_categories_1'][0]['category_ar_title']}}</h5>
                                                </a>
                                            @else
                                                <a href="{{URL::to('/'). '/' .Session::get('locale') .'/products?category='. $response['homefeeds']['data']['top_categories_1'][0]['category_slug']}}">
                                                <h5>{{$response['homefeeds']['data']['top_categories_1'][0]['category_en_title']}}</h5>
                                                </a>
                                            @endif


                                            <div class="dealsOuter0 topCategoriez owl-carousel owl-theme">

                                                @foreach($response['homefeeds']['data']['top_categories_1'] as $top_sales)
                                                    <div>
                                                        <div class="dealsList">

                                                            <a href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $top_sales['item_slug']])}}">
                                                                <img
                                                                    src="{{config('paths.small_item') . $top_sales['item_image']}}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach


                                            </div><!--dealsOuter-->
                                        </div><!--cIList-->
                                    @endif
                                    @if(!empty($response['homefeeds']['data']['top_categories_2']))
                                        <div class="cIList">
                                            @if(App::getLocale() === 'ar')
                                                <a href="{{URL::to('/'). '/' .Session::get('locale') .'/products?category='. $response['homefeeds']['data']['top_categories_2'][0]['category_slug']}}">
                                                    <h5>{{$response['homefeeds']['data']['top_categories_2'][0]['category_ar_title']}}</h5>
                                                </a>
                                            @else
                                                <a href="{{URL::to('/'). '/' .Session::get('locale') .'/products?category='. $response['homefeeds']['data']['top_categories_2'][0]['category_slug']}}">
                                                    <h5>{{$response['homefeeds']['data']['top_categories_2'][0]['category_en_title']}}</h5>
                                                </a>
                                            @endif
                                            <div class="dealsOuter0 topCategoriez owl-carousel owl-theme">

                                                @foreach($response['homefeeds']['data']['top_categories_2'] as $top_sales)
                                                    <div>
                                                        <div class="dealsList">
                                                            <a href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $top_sales['item_slug']])}}">
                                                                <img
                                                                    src="{{config('paths.small_item') . $top_sales['item_image']}}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div><!--dealsOuter-->
                                        </div><!--cIList-->
                                    @endif
                                </div>

                                <div class="w100">
                                    @if(!empty($response['homefeeds']['data']['top_categories_3']))
                                        <div class="cIList">
                                            @if(App::getLocale() === 'ar')
                                                <a href="{{URL::to('/'). '/' .Session::get('locale') .'/products?category='. $response['homefeeds']['data']['top_categories_3'][0]['category_slug']}}">

                                                <h5>{{$response['homefeeds']['data']['top_categories_3'][0]['category_ar_title']}}</h5>
                                                </a>
                                            @else
                                                <a href="{{URL::to('/'). '/' .Session::get('locale') .'/products?category='. $response['homefeeds']['data']['top_categories_3'][0]['category_slug']}}">

                                                <h5>{{$response['homefeeds']['data']['top_categories_3'][0]['category_en_title']}}</h5>
                                                </a>
                                            @endif
                                            <div class="dealsOuter0 topCategoriez owl-carousel owl-theme">

                                                @foreach($response['homefeeds']['data']['top_categories_3'] as $top_sales)
                                                    <div>
                                                        <div class="dealsList">
                                                            <a href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $top_sales['item_slug']])}}">
                                                                <img
                                                                    src="{{config('paths.small_item') . $top_sales['item_image']}}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div><!--dealsOuter-->

                                        </div><!--cIList-->
                                    @endif
                                    @if(!empty($response['homefeeds']['data']['top_categories_4']))
                                        <div class="cIList">
                                            @if(App::getLocale() === 'ar')
                                                <a href="{{URL::to('/'). '/' .Session::get('locale') .'/products?category='. $response['homefeeds']['data']['top_categories_4'][0]['category_slug']}}">

                                                <h5>{{$response['homefeeds']['data']['top_categories_4'][0]['category_ar_title']}}</h5>
                                                </a>
                                            @else
                                                <a href="{{URL::to('/'). '/' .Session::get('locale') .'/products?category='. $response['homefeeds']['data']['top_categories_4'][0]['category_slug']}}">
                                                <h5>{{$response['homefeeds']['data']['top_categories_4'][0]['category_en_title']}}</h5>
                                                </a>
                                            @endif
                                            <div class="dealsOuter0 topCategoriez owl-carousel owl-theme">

                                                @foreach($response['homefeeds']['data']['top_categories_4'] as $top_sales)
                                                    <div>
                                                        <div class="dealsList">
                                                            <a href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $top_sales['item_slug']])}}">
                                                                <img
                                                                    src="{{config('paths.small_item') . $top_sales['item_image']}}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div><!--dealsOuter-->
                                        </div><!--cIList-->
                                    @endif
                                </div>
                            </div><!--cTop_category-->
                        @endif
                        @if(!empty($response['homefeeds']['data']['top_brands']) || !empty($response['homefeeds']['data']['falshDeals']))
                            <div class="cTop_brands">
                                @if(!empty($response['homefeeds']['data']['top_brands']))
                                    <h4><img
                                            src="{{asset('public/assets/images/icon_17.png')}}">{{ __('localization.FEATUREDBRANDS')}}
                                    </h4>
                                    <div class="w100">

                                        <div>

                                            @foreach($response['homefeeds']['data']['top_brands'] as $top_brands)
                                                <div class="brandz">

                                                    <a href="javascript:void(0)" id="link"
                                                       attr-slug="all&brands={{$top_brands['slug']}}">
                                                        @if(App::getLocale() == 'ar')
                                                        <img src="{{config('paths.small-banner-thumb') . $top_brands['ar_banner']}}">
                                                            @else
                                                            <img src="{{config('paths.small-banner-thumb') . $top_brands['en_banner']}}">

                                                        @endif
                                                    </a>
                                                </div><!--brandz-->
                                            @endforeach
                                        </div>

                                    </div>
                                @endif

                                @if(!empty($response['homefeeds']['data']['falshDeals']))
                                    <div class="w100">
                                        <div class="cIList2 w100">
                                            <h5>{{ __('localization.FlashDeals')}}</h5>
                                            <div class="dealsOuter owl-carousel owl-theme" id="flashDeals">


                                                @foreach($response['homefeeds']['data']['falshDeals'] as $falshDeals)
                                                    <div>
                                                        <div class="dealsList">
                                                            <a href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $falshDeals['item_slug']])}}">
                                                                <img
                                                                    src="{{config('paths.small_item') . $falshDeals['item_image']}}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div><!--dealsOuter-->
                                        </div>
                                    </div><!--cTop_brands-->
                                @endif
                            </div><!--cInfoIn-->
                        @endif
                    </div><!--col-md-12-->
                </div><!--row-->
            </div><!--container-->
        </div><!--container-->
    </section><!--cInfoBox-->
@endif

