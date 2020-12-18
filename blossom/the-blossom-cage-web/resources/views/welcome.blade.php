@extends('layouts.item_listing')
@section('content')
    <section class="w100 alterMassageShow">
        <div class="container">
    @include('partials.messages')
        </div>
    </section>
    <div class="chbibBox">
    @include('homeSlider')
    
    @if(!empty($response['homefeeds']['data']['trendy_item']))
    <section class="w100 saleProducts">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
							<div class="cb_heading w100 text-center">
								<h2>Trendy Products</h2>
								<p>There are many variations of passages of lorem ipsum available.</p>
							</div>
							<div class="w100 text-center">
								<div class="TrendyProducts">
                                @if(!empty($response['homefeeds']['data']['trendy_item'][0]))
									<div class="tproductCol1">
                                    <a  href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $response['homefeeds']['data']['trendy_item'][0]['slug']])}}">
                                              
										<div class="tpinner">
											<img src="{{config('paths.medium_item') . $response['homefeeds']['data']['trendy_item'][0]['image']}}">
											<div class="tpTxt">
												<p>{{$response['homefeeds']['data']['trendy_item'][0]['title']}}</p>
												<span>
                                                {{Session::get('cur_currency')}} {{ round($response['homefeeds']['data']['trendy_item'][0]['price'] * Session::get('amount_per_unit'),2) }}
                                              
                                                </span>
												<div class="line"></div>
											</div><!--tpTxt-->
                                        </div>
                                    </a>
									</div><!--tproductCol-->
                                    @endif
                                    @if(!empty($response['homefeeds']['data']['trendy_item'][3]))
									<div class="tproductCol4">
                                        <a  href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $response['homefeeds']['data']['trendy_item'][3]['slug']])}}">
                                              
                                        <div class="tpinner">
                                            <img src="{{config('paths.medium_item') . $response['homefeeds']['data']['trendy_item'][3]['image']}}">
										
											<div class="tpTxt">
                                            <p>{{$response['homefeeds']['data']['trendy_item'][3]['title']}}</p>
												<span>
                                                {{Session::get('cur_currency')}} {{ round($response['homefeeds']['data']['trendy_item'][3]['price'] * Session::get('amount_per_unit'),2) }}
                                              
                                                </span>
												<div class="line"></div>
											</div><!--tpTxt-->
                                        </div>
                                        </a>
									</div><!--tproductCol-->
                                    @endif
                                    <div class="tproductCol2">
									    @if(!empty($response['homefeeds']['data']['trendy_item'][1]))
                                        <a  href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $response['homefeeds']['data']['trendy_item'][1]['slug']])}}">
                                              
                                        <div class="tpinner2">
										    <img  class="float-right"  src="{{config('paths.medium_item') . $response['homefeeds']['data']['trendy_item'][1]['image']}}">
										
                                            <div class="tpTxt">
                                            <p>{{$response['homefeeds']['data']['trendy_item'][1]['title']}}</p>
												<span>
                                                {{Session::get('cur_currency')}} {{ round($response['homefeeds']['data']['trendy_item'][1]['price'] * Session::get('amount_per_unit'),2) }}
                                              
                                               </span>
											
												<div class="line"></div>
											</div><!--tpTxt-->
                                        </div>
                                        </a>
                                        @endif
                                        @if(!empty($response['homefeeds']['data']['trendy_item'][2]))
                                    
                                        <a  href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $response['homefeeds']['data']['trendy_item'][2]['slug']])}}">
                                              
										<div class="tpinner3">
											<img  class="float-left"  src="{{config('paths.medium_item') . $response['homefeeds']['data']['trendy_item'][2]['image']}}">
										
                                            <div class="tpTxt">
                                            <p>{{$response['homefeeds']['data']['trendy_item'][2]['title']}}</p>
												<span>
                                            
                                                {{Session::get('cur_currency')}} {{ round($response['homefeeds']['data']['trendy_item'][2]['price'] * Session::get('amount_per_unit'),2) }}
                                                </span>
										
												<div class="line"></div>
											</div><!--tpTxt-->
                                        </div>
                                        </a>
                                        @endif
									</div><!--tproductCol-->
								</div><!--TrendyProducts-->
							</div>	
                        </div><!--col-md-12-->
                    </div><!--row-->
                </div><!--container-->
    </section><!--saleProducts-->
    
    @endif
    
    
    
    <section class="w100 saleProducts">
        <div class="container">
            @if(!empty($response['data']['items']))
            <div class="row">
                <div class="col-md-12">
                    <div class="cb_heading w100 text-center">
								<h2>Our Featured Products</h2>
								<p>There are many variations of passages of lorem ipsum available.</p>
							</div>
                    <div class="fp_Box w100">
                            <div class="fp_buttons">
									<button class="filter" data-filter="all">All</button>
									<button class="sort" data-sort="random">Featured</button>
									<button class="sort" data-sort="random">Popular</button>
									<button class="sort" data-sort="random">Sale</button>
									<button class="sort" data-sort="random">Best Rated</button>								
                                </div><!--fp_buttons-->	
                                <div id="mixitup" class="mixitup w100">
                                 
                            @foreach($response['data']['items'] as $item)



                            <div class="fp_produtsList mix category-1 category-2">
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
									</div>

                                @endforeach
                            </div>
                    </div><!--w100-->


                </div><!--col-md-12-->
                
                <div class="w100 text-center" id="mainFi2">
                    <a href="javascript:void(0)" class="fpviewbutton"  type="button" id="sortByfeatured" attr-value="featured">View All product</a>
                </div>
            </div><!--row-->
            @endif
        </div><!--container-->
    </section><!--cfeatured-items-->
    </div>

@endsection
