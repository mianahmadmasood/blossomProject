<header class="cheader">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="headerIn w100">
                    <div class="headLft">
                        <div class="dropDown">
                            <select class="selectpicker" id="currency" >
                                @if(Session::get('cur_currency') == 'USD')
                                    <option value="SAR">SAR</option>
                                    <option selected="" value="USD">USD</option>
                                @else
                                    <option selected="" value="SAR">SAR</option>
                                    <option value="USD">USD</option>
                                @endif

                            </select>
                        </div><!--dropDown-->

                        <div id="locale" class="dropDown">
                            <select class="selectpicker" id="selectpicker12" >
                                @if(App::getLocale() == 'en')
                                    <option value="en" selected="">EN</option>
                                    <option value="ar">AR</option>
                                @else
                                    <option value="en">EN</option>
                                    <option value="ar" selected="">AR</option>
                                @endif
                            </select>
                        </div><!--dropDown-->
                    </div><!--headLft-->
                    <div class="headMid">
                        <div class="clogo"><a href="{{route('home',[ 'lang' => App::getLocale()])}}">
                        <img width="50" src="{{asset('public/assets/images/logo-color.png')}}"></a>
                        </div>
                        <form autocomplete="off">
                            <div class="cSearch">
                                <input id="search-item-header" type="text" autocomplete="off"
                                       value="{{ isset($request_params['search']) ? $request_params['search']: ''}}">
                                <a id="search-item-header-btn" href="#"><img
                                        src="{{asset('public/assets/images/search-icon.png')}}"></a>

                            </div><!--cSearch-->
                        </form>

                        <ul id="menu">
                            <li class="{{ Request::route()->getName() == 'home' ? 'active' : '' }}"><a
                                    href="{{route('home' ,[ 'lang' => App::getLocale()])}}">{{ __('localization.h_btn')}}</a>
                            </li>
                            <li class="{{ Request::route()->getName() == 'searchItem' ? 'active' : '' }}">
                                <a href="{{route('searchItem' ,[ 'lang' => App::getLocale()])}}">{{ __('localization.p_btn')}}</a>


                                {{--                                @if(Route::current()->getName()  !=  'itemDeatils')--}}

                    
                                            @if(!empty($response['homefeeds']['data']) && !empty($response['homefeeds']['data']['top_sales']))
                                                        @if(!empty($response['homefeeds']['data']['top_sales']) || Session::has('homefeedsDate'))
                                                                @if(Session::has('homefeedsDate'))
                                                                    <?php $homefeedsCategories = Session::get('homefeedsDate');?>
                                                                    @else
                                                                    <?php $homefeedsCategories = isset($response['homefeeds']['data']['homefeedsCategories'])?$response['homefeeds']['data']['homefeedsCategories']:"";?>
                                                                    @endif


                                                                @if(!empty($homefeedsCategories))
                                                                <ul>
                                                                    <li>
                                                                        @foreach($homefeedsCategories as $category)
                                                                            <div class="categoryList w100">

                                                                                    <a class="head" href="{{URL::to('/'). '/' .Session::get('locale') .'/products?category='. $category['slug']}}">

                                                                                @if(Session::get('locale') == 'ar')
                                                                                        {{$category['ar_title']}}
                                                                                    @else
                                                                                        {{$category['en_title']}}
                                                                                    @endif

                                                                                    </a>

                                                                                @foreach($category['sub_categories'] as $subcategory)
                                                                                    <a href="{{URL::to('/'). '/' .Session::get('locale') .'/products?category='. $category['slug'] .'&sub_categories='.$subcategory['slug'] }}">
                                                                                        @if(Session::get('locale') == 'ar')
                                                                                            {{$subcategory['ar_title']}}
                                                                                        @else
                                                                                            {{$subcategory['en_title']}}
                                                                                        @endif
                                                                                    </a>
                                                                                @endforeach
                                                                            </div>
                                                                        @endforeach
                                                                    </li>
                                                                </ul>
                                                                @endif
                                                            @endif
                                            {{--                                @endif--}}
                                                        @endif






                            </li>
                            <li class="{{ Request::route()->getName() == 'about' ? 'active' : '' }}"><a
                                    href="{{route('about' , [ 'lang' => App::getLocale()])}}">{{ __('localization.a_btn')}}</a>
                            </li>
                            <li class="{{ Request::route()->getName() == 'contact' ? 'active' : '' }}"><a
                                    href="{{route('contact', [ 'lang' => App::getLocale()])}}">{{ __('localization.c_btn')}}</a>
                            </li>
                        </ul>
                    </div><!--headMid-->
                    <div class="headRit">
                        <div class="headlogin">
                            <!--<a href="javascript:void(0)">Log IN</a>-->
                            @if(Auth::check())
                                <div class="ProfileBox">
                                    <a class="top-user-area-avatar" href="javascript:void(0)">
                                        @if(Auth::user()->image)
                                            <img class="origin round"
                                                 src="{{ config('paths.small_profile'). Auth::user()->image}}"/>{{substr(Auth::user()->first_name, 0, 6) . '..'}}
                                            <i class="fa fa-caret-down"></i>
                                        @else
                                            <img class="origin round"
                                                 src="{{asset('public/images/user.png')}}"/>{{substr(Auth::user()->first_name, 0, 6) . '..'}}
                                            <i class="fa fa-caret-down"></i>
                                        @endif
                                    </a>
                                    <div class="dropdown profile_drop">
                                        <ul>
                                            <li><a href="{{route('myProfile', [ 'lang' => App::getLocale()])}}"><i
                                                        class="icon icon-user"></i>{{ __('localization.proffile_btn')}}
                                                </a></li>
                                            <li><a href="{{route('myOrders' ,[ 'lang' => App::getLocale()])}}"><i
                                                        class="fa fa-newspaper"></i>{{ __('localization.order_btn')}}
                                                </a></li>
                                            <li><a href="{{route('myAddress',[ 'lang' => App::getLocale()])}}"><i
                                                        class="fa fa-map-marked-alt"></i>{{ __('localization.address_btn')}}
                                                </a></li>
                                            <li><a href="{{route('myFavorites',[ 'lang' => App::getLocale()])}}"><i
                                                        class="fa fa-heart"></i>{{ __('localization.wishlist_btn')}}</a>
                                            </li>
                                            <li><a href="{{route('changePassword',[ 'lang' => App::getLocale()])}}"><i
                                                        class="fa fa-lock"></i>{{ __('localization.c_password_btn')}}
                                                </a></li>
                                            <li><a href="{{route('feedback',[ 'lang' => App::getLocale()])}}"><i
                                                        class="fa fa-comment-dots"></i>{{ __('localization.feedback_btn')}}
                                                </a></li>
                                            <li><a href="{{route('logout',[ 'lang' => App::getLocale()])}}"><i
                                                        class="fa fa-power-off"></i>{{ __('localization.logout_btn')}}
                                                </a></li>
                                        </ul>
                                    </div>
                                </div><!--ProfileBox-->
                            @else
                                <a href="javascript:void(0)" data-toggle="modal" class="modaldev modalDevSignUp"
                                   data-target="#Signin_modal">{{ __('localization.h_login_btn')}}</a>
                            @endif
                        </div><!--headlogin-->
                        <div class="headfav">
                            @if(Auth::check())
                                <a href="{{route('myFavorites')}}"><img width="21"
                                                                        src="{{asset('public/assets/images/heart-icon.png')}}"></a>
                            @else
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#Signin_modal"><img
                                        width="21" src="{{asset('public/assets/images/heart-icon.png')}}"></a>
                            @endif
                        </div>    <!--headfav-->
                        @if(Request::url() ==  Url::to('/') .'/'.App::getLocale() . '/cart' || Request::url() ==  Url::to('/') . '/'.App::getLocale() . '/checkout' )
                        @else
                            <div class="cartBox">
                                @php
                                    $items = Session::get('items');

                                    $class = '';
                                    if(!empty($items) && count($items) > 0){
                                    $class = '';
                                    }else{
                                    $class = 'dn';
                                    }
                                @endphp
                                <div id="counter"
                                     class="ccounter {{$class}}">{{!empty($items) ? count($items) : ''}}</div>
                                <img width="22" class="carticon" src="{{asset('public/assets/images/bag-icon.png')}}">
                                <div aria-labelledby="cartdetails" class="dropdown-menu dropdown-menu-right">
                                    @if(!empty(Session::get('items')))
                                        <div class="navbar-cart-product-wrapper">
                                            <?php $total = 0;
                                            ?>
                                            @foreach(Session::get('items') as $item)

                                                <?php
                                                $total = $total + $item['price'];
                                                ?>
                                                <div id="parent_div" class="navbar-cart-product">
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{route('itemDeatils', ['lang' => Session::get('locale'),'slug' => $item['slug']])}}">
                                                            @if(!empty($item['color_image']))
                                                                <img
                                                                    src="{{config('paths.large_itemColor').$item['color_image']}}"
                                                                    class="img-fluid navbar-cart-product-image">
                                                            @else
                                                                <img src="{{$item['image']}}"
                                                                     class="img-fluid navbar-cart-product-image">
                                                            @endif

                                                        </a>

                                                        <div class="w-100">
                                                            <a id="removeFromBag" data-value="{{$item['color_id']}}"
                                                               href="javascript:void(0)" class="close2 text-sm mr-2">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                            <div class="pl-3">
                                                                @if(Session::get('locale') == 'ar')
                                                                    <a href="{{route('itemDeatils', ['lang' => Session::get('locale'),'slug' => $item['slug']])}}"
                                                                       class="navbar-cart-product-link">{{$item['ar_title']}}</a>
                                                                    <small
                                                                        class="d-block text-muted">كمية:{{$item['quantity']}} </small>
                                                                @else
                                                                    <a href="{{route('itemDeatils', ['lang' => Session::get('locale'),'slug' => $item['slug']])}}"
                                                                       class="navbar-cart-product-link">{{$item['en_title']}}</a>
                                                                    <small
                                                                        class="d-block text-muted">Quantity:{{$item['quantity']}} </small>
                                                                @endif
                                                                <strong
                                                                    class="d-block text-sm">{{Session::get('cur_currency')}} {{$item['price'] * Session::get('amount_per_unit')}} </strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    @else
                                        <div id="no_items" class="navbar-cart-product-wrapper">
                                            <strong class="d-block text-sm">{{ __('localization.e_cart_btn')}} </strong>
                                        </div>
                                    @endif
                                    <div class="navbar-cart-total">
                                        <p>{{ __('localization.total')}}<span id="total"
                                                                              data-value="{{Session::get('total')}}">
                                            {{Session::get('cur_currency')}}
                                                <?php
                                                if (Session::get('total') != 0) {
                                                    echo Session::get('total');
                                                } else {
                                                    echo 0;
                                                }
                                                ?></span></p>
                                    </div>

                                    <!-- buttons-->
                                    <div class="w100">
                                        <a href="{{route('viewBag')}}"
                                           class="btn btn-link text-dark mr-3">{{ __('localization.v_cart_btn')}}
                                            <i class="fa-arrow-right fa"></i>
                                        </a>
                                    </div>
                                </div>
                            </div><!--cartBox-->
                        @endif
                        @php
                            $request_params = Request::all();
                        @endphp

                        @if(empty($request_params))
                            <div class="headsearch">
                                <a href="javascript:void(0)"><img width="18"
                                                                  src="{{asset('public/assets/images/search-icon.png')}}"></a>
                            </div><!--headsearch-->
                        @endif
                    </div><!--headRit-->
                </div><!--headerIn-->
            </div>
        </div><!--row-->
    </div><!--container-->
</header>


