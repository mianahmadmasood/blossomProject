@extends('layouts.item_listing')
@section('content')

    <section class="cProducts">
        <?php $request_params = Request::all(); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    @include('partials.messages')
                    @include('components.side_menu')

                    <div class="cProduct_rite">

                        <div class="pageStatus mrg0 ">

                            <a href="{{route('home')}}"> {{ __('localization.h_btn')}}</a>
                            <a href="#">/</a>
                            <a href="{{route('searchItem')}}"> {{ __('localization.categories')}}</a>
                            <a href="#">/</a>
                            @if(isset($request_params['category']) && $request_params['category'] == 'all')
                                <a href="javascript:void(0)">{{ __('localization.all')}}</a>
                            @else
                                <a href="javascript:void(0)">{{$data['selected_category']}}</a>
                            @endif
                        </div>
                        @include('partials.messages')

                        <div class="searchBox">
                            <form autocomplete="off">
                                <input id="search-item" type="text" autocomplete="off"
                                       value="{{ isset($request_params['search']) ? $request_params['search']: ''}}">
                                <a id="search-item-btn"><img width="18"
                                                             src="{{URL::asset('public/assets/images/search-icon.png')}}"></a>
                            </form>

                        </div><!--searchBox-->
                        @if(!empty($data['items']))
                            <div class="w100">
                        <span class=" @if(App::getLocale() == 'ar') float-right @else searchR @endif">
                            @if(!empty($data['items'])) <?php $resultsearch = $data['count']; echo number_format($resultsearch) . " "; ?> {{ __('localization.results')}}@endif
                        </span>
                                <div class="cf1">
                                    <div class="dropdown">
                                        <button id="heading_button" class="btn btn-secondary dropdown-toggle"
                                                type="button" id="dropdownMenu2" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            @if(!empty($request_params['sort_by']))
                                                @if($request_params['sort_by'] == 'mostRecent')
                                                    {{ __('localization.sort_by')}}  {{ __('localization.mostRecent')}}
                                                @elseif($request_params['sort_by'] == 'Hightolow')
                                                    {{ __('localization.sort_by')}} {{ __('localization.price')}}
                                                    <span
                                                    >
                                                        ({{ __('localization.hightolow')}})</span>
                                                @elseif($request_params['sort_by'] == 'Lowtohigh')
                                                    {{ __('localization.sort_by')}}   {{ __('localization.price')}}
                                                    <span
                                                    >
                                                        ({{ __('localization.lowtohigh')}})</span>
                                                @elseif($request_params['sort_by'] == 'featured')
                                                    {{ __('localization.sort_by')}}  {{ __('localization.featured')}}
                                                @elseif($request_params['sort_by'] == 'discounted')
                                                    {{ __('localization.sort_by')}}   {{ __('localization.discounted')}}
                                                @else
                                                    {{ __('localization.sort_by')}}
                                                @endif
                                            @else
                                                {{ __('localization.sort_by')}}
                                            @endif

                                        </button>
                                        <div id="mainFi" class="dropdown-menu dropdownforfilter"
                                             aria-labelledby="dropdownMenu2">

                                            <button id="sortBy" attr-value="mostRecent" class="dropdown-item"
                                                    type="button"> {{ __('localization.mostRecent')}}</button>
                                            <button id="sortBy" attr-value="Hightolow" class="dropdown-item"
                                                    type="button">{{ __('localization.price')}} <span
                                                    style="font-size: 10px">
                                                    ({{ __('localization.hightolow')}})</span></button>
                                            <button id="sortBy" attr-value="Lowtohigh" class="dropdown-item"
                                                    type="button">{{ __('localization.price')}} <span
                                                    style="font-size: 10px">
                                                    ({{ __('localization.lowtohigh')}})</span></button>
                                            <button id="sortBy" attr-value="featured" class="dropdown-item"
                                                    type="button"> {{ __('localization.featured')}} </button>
                                            <button id="sortBy" attr-value="discounted" class="dropdown-item"
                                                    type="button"> {{ __('localization.discounted')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="FilteredBox w100">
                            <div class="w100">
                                @if(!empty($data['items']))
                                    @foreach($data['items'] as $item)
                                    <div class="fp_produtsList">
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
                            </div><!--productList-->
                        </div><!--productList-->


                        <?php
                        $totaldata = $data['count'];
                        $limit = $data['count'] / 24;

                        if ($limit > !1) {
                            $limit = ceil($limit);
                        }

                        $url = URL::current();

                        $params = Request::except('page_no');
                        $request_params = Request::all();

                        if (!empty($params)) {
                            $url = $url . '?' . urldecode(http_build_query($params));
                        }
                        if (!empty($params)) {
                            $url = $url . '&';
                        } else {
                            $url = $url . '?';
                        }
                        ?>

                        <?php

                        $page_no = !empty($request_params['page_no']) ? (int)$request_params['page_no'] : 1;
                        $total_records_per_page = 3;
                        $offset = ($page_no - 1) * $total_records_per_page;
                        $previous_page = $page_no - 1;
                        $next_page = $page_no + 1;
                        $adjacents = "2";
                        $total_records = $totaldata / 24;
                        $total_no_of_pages = ceil($total_records);
                        $second_last = $total_no_of_pages - 1; // total page minus 1

                        ?>

                        <div class="load_pagination">
                            <a <?php if ($page_no <= 1) {
                                echo "class='disabled'";
                            }  if($page_no > 1){ ?>  href="{{$url}}page_no={{$previous_page}}" <?php  } ?> >{{ __('localization.prev')}}</a>

                            <?php
                            if ($total_no_of_pages <= 10){
                            for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                            if ($counter == $page_no) {
                            ?>
                            <a id='pagination' class='active'
                               href="{{$url}}page_no={{$counter}}">{{$counter}}</a>

                            <?php
                            }else{
                            ?>
                            <a id='pagination' href="{{$url}}page_no={{$counter}}">{{$counter}}</a>
                            <?php
                            }
                            }
                            }
                            elseif($total_no_of_pages > 10){

                            if($page_no <= 4) {
                            for ($counter = 1; $counter < 8; $counter++){
                            if ($counter == $page_no) {
                            ?>
                            <a id='pagination' class='active'
                               href="{{$url}}page_no={{$counter}}">{{$counter}}</a>
                            <?php
                            }else{
                            ?>
                            <a id='pagination' href="{{$url}}page_no={{$counter}}">{{$counter}}</a>
                            <?php
                            }
                            }
                            ?>
                            <span onclick='return false;'>...</span>
                            <a id='pagination' href="{{$url}}page_no={{$second_last}}">{{$second_last}}</a>
                            <a id='pagination' href="{{$url}}page_no={{$total_no_of_pages}}">{{$total_no_of_pages}}</a>
                            <?php
                            }

                            elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                            ?>
                            <a id='pagination' href="{{$url}}page_no=1">1</a>
                            <a id='pagination' href="{{$url}}page_no=2">2</a>
                            <span onclick='return false;'>...</span>

                            <?php
                            for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                            if ($counter == $page_no) {
                            ?>
                            <a id='pagination' class='active'
                               href="{{$url}}page_no={{$counter}}">{{$counter}}</a>

                            <?php
                            }else{
                            ?>
                            <a id='pagination' href="{{$url}}page_no={{$counter}}">{{$counter}}</a>
                            <?php
                            }
                            }
                            ?>
                            <span onclick='return false;'>...</span>
                            <a id='pagination' href="{{$url}}page_no={{$second_last}}">{{$second_last}}</a>
                            <a id='pagination' href="{{$url}}page_no={{$total_no_of_pages}}">{{$total_no_of_pages}}</a>
                            <?php
                            }

                            else {
                            ?>
                            <a id='pagination' href="{{$url}}page_no=1">1</a>
                            <a id='pagination' href="{{$url}}page_no=2">2</a>
                            <span onclick='return false;'>...</span>

                            <?php
                            for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                if ($counter == $page_no) {
                                    echo "<a id='pagination'  class='active' href=" . $url . 'page_no=' . $counter . " >$counter</a>";
                                } else {
                                    echo "<a id='pagination'  href=" . $url . 'page_no=' . $counter . ">$counter</a>";
                                }
                            }
                            }
                            }
                            ?>
                            <a
                                <?php if($page_no < $total_no_of_pages) { ?> href="{{$url}}page_no={{$next_page}}" <?php } ?>>
                                {{ __('localization.next')}}</a>
                        </div>

                        @else
                            {{ __('localization.no_product')}}
                        @endif


                    </div><!--cProduct_rite-->
                </div><!--col-md-6-->
            </div><!--row-->
        </div><!--container-->
    </section><!--cProducts-->
@endsection
