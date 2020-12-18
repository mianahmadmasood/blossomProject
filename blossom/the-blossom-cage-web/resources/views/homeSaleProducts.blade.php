@if(!empty($response['homefeeds']['data']['top_sales']))
    <section class="w100 saleProducts">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sProductsBox w100">
                        <div class="saleLists blanks">
                            {{ __('localization.TopSaleProduct')}}
                        </div><!--saleLists-->

                        @foreach($response['homefeeds']['data']['top_sales'] as $top_sales)

                            <div class="saleLists">
                                {{--                            image--}}
                                <a href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $top_sales['slug']])}}">
                                    <img src="{{config('paths.small_item') . $top_sales['image']}}">
                                </a>
                                <div class="saleListIn w100">

                                    <a href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $top_sales['slug']])}}">
                                        @if(App::getLocale() === 'ar')
                                            <h2>{{$top_sales['ar_title']}}</h2>
                                        @else
                                            <h2>{{$top_sales['en_title']}}</h2>
                                        @endif
                                    </a>
                                    <h3> {{Session::get('cur_currency')}} {{round($top_sales['sale_price'] * Session::get('amount_per_unit') ,2)}} </h3>
                                    <p>{{Session::get('cur_currency')}} {{round( $top_sales['price'] * Session::get('amount_per_unit') ,2) }}</p>


                                    <a href="javascript:void(0)" class="" id="link"
                                       attr-slug="{{$top_sales['category_slug']}}">
                                        @if(App::getLocale() === 'ar')
                                            <span>{{$top_sales['category_ar_title']}}</span>
                                        @else
                                            <span>{{$top_sales['category_en_title']}}</span>
                                        @endif
                                    </a>
                                    <strong>

                                        @if($top_sales['discounted_type'] == 'fixed' )

                                            {{Session::get('cur_currency')}}
                                            <?php echo numberFormat($top_sales['discount'] * Session::get('amount_per_unit'));?>
                                            {{ __('localization.off')}}

                                        @else

                                            <?php echo numberFormat($top_sales['discount'] * Session::get('amount_per_unit'));?>
                                            % {{ __('localization.off')}}

                                        @endif

                                    </strong>

                                    @if(Auth::check())
                                        @if($top_sales['is_favorite'] === true)

                                            <button class="addToFav active" id="addToFav_home"
                                                    data-uuid="{{$top_sales['uuid']}}"></button>

                                        @else

                                            <button class="addToFav" id="addToFav_home"
                                                    data-uuid="{{$top_sales['uuid']}}"></button>
                                        @endif
                                    @else
                                        <button class="addToFav" data-toggle="modal"
                                                data-target="#Signin_modal"></button>
                                    @endif

                                </div><!--saleListIn-->
                            </div><!--saleLists-->
                        @endforeach
                    </div><!--sProductsBox-->
                    <div class="viewMore w100" id="mainFi">
                        <a href="javascript:void(0)" id="sortBy" attr-value="discounted" class="dropdown-item"
                           type="button" style="width: auto !important;">{{ __('localization.Viewmore')}}</a>
                    </div><!--viewMore-->
                </div><!--col-md-12-->
            </div><!--row-->

        </div><!--container-->
    </section><!--saleProducts-->
@endif
