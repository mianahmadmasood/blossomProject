
@if(!empty($related_item))

    <section class="cfeatured-items2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h6>
                        {{ __('localization.related_products')}}
                    </h6>
                    <div class="w100 relatedProducts owl-carousel owl-theme">

                        @foreach($related_item as $item)
                       

                        <div class="">
                                        <a  href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $item['slug']])}}">
                                  
                                        <div class="fp_pImage">
											<img src="{{config('paths.small_item') . $item['image']}}">
											
                                            @if($item['discount'] > 0)
                                            @if($item['discounted_type'] != 'fixed' )

                                                    <span>-<?php echo $item['discount'] ?>%</span>
                                             
                                                @else

                                                    <span> {{Session::get('cur_currency')}}  <?php echo numberFormat($item['discount'] * Session::get('amount_per_unit'));?></span>
        
                                            @endif
                                            @endif
    
                                        </div><!--fp_pImage-->
                                        </a>
										<div class="fp_actionz">
											<div class="fp_price w100">
                                                <p>{{$item['title']}}</p>
                                                @if(!empty($item['sale_price']))
                                                    <span><small>{{Session::get('cur_currency')}} {{round($item['sale_price'] * Session::get('amount_per_unit'),2) }}</small>{{Session::get('cur_currency')}} {{round($item['sale_price'] * Session::get('amount_per_unit'),2) }}</span>
                                                @else
                                                    <span><small>{{Session::get('cur_currency')}} {{ round($item['price'] * Session::get('amount_per_unit'),2) }}</small>{{Session::get('cur_currency')}} {{ round($item['price'] * Session::get('amount_per_unit'),2) }}</span>
                                                @endif

												
											</div><!--fp_price-->
											<div class="fp_clicks">
												
                                                @if(Auth::check())
                                                    @if($item['is_favorite'] === true)

                                                        <a class="fp_whishlist addToFav active" id="addToFav_home" data-uuid="{{$item['uuid']}}" href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $item['slug']])}}">
                                                        </a>

                                                    @else
                                                        <a class="fp_whishlist addToFav" id="addToFav_home" data-uuid="{{$item['uuid']}}" href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $item['slug']])}}">
                                                        </a>

                                                    @endif
                                                @else
                                                <a class="fp_whishlist addToFav" data-toggle="modal" data-target="#Signin_modal"   href="javascript:void(0)">
                                                        </a>

                                                    <!-- <button class="addToFav" data-toggle="modal" data-target="#Signin_modal"></button> -->
                                                @endif


												<a class="fp_cart" href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $item['slug']])}}">Add to Cart</a>
												<a class="fp_search" href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $item['slug']])}}">
                                                    <img src="{{asset('public/assets/images/search-white.png')}}">
                                                </a>
											</div><!--fp_clicks-->
                                        </div><!--fp_actionz-->
                                    </div><!--fp_produtsList-->








                        @endforeach
                    </div><!--w100-->
{{--                    <div class="viewMore w100">--}}

{{--                        <a href="javascript:void(0)" id="sortByfeatured" attr-value="featured" class="dropdown-item"--}}
{{--                           type="button" style="width: auto !important;" >{{ __('localization.Viewmore')}}</a>--}}
{{--                        --}}

{{--                    </div>--}}
                </div><!--col-md-12-->
            </div><!--row-->
        </div><!--container-->
    </section><!--cfeatured-items-->

@endif
