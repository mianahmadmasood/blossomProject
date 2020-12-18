@extends('layouts.item_listing')
@section('content')

<section class="Aboutpage">
    <div class="container">
        @include('partials.messages')
        <div class="row">
            <div class="aboutbanner">
                <div class="overlayIn"></div><!--overlayIn-->
                <div class="w100">
                    <div class="hero-content pb-5 text-center">
                        <h1 class="hero-heading"> {{ __('localization.about_us')}}</h1>
                        <p> {{ __('localization.general_p1')}}</p>
                    </div>
                </div><!--w100-->
            </div><!--aboutbanner-->
            <div class="aboutBox">
                <div class="col-md-12">
                    <div class="w100">
                        <div class="hero-content pb-5 text-center">
                            <h1 class="hero-heading"> {{ __('localization.about_us')}}</h1>
                        </div>
                    </div>
                    <p>{{ __('localization.the_collection_of_personal_data_p1')}}</p>
                    <!-- <div class="w100 aboutUs-design">
                    <h4> {{ __('localization.Mission')}}</h4>
                    <p>{{ __('localization.Mission1')}}</p>

                    <h4> {{ __('localization.Vision')}}</h4>
                    <p>{{ __('localization.Vision1')}}</p>

                    <h4> {{ __('localization.CoreValues')}}</h4>
                    <ul class="w100 listitemz">
                            <li class="w100">
                                {{ __('localization.CoreValues1')}}
                            </li>
                            <li class="w100">
                                {{ __('localization.CoreValues2')}}
                            </li>
                            <li class="w100">
                                {{ __('localization.CoreValues3')}}
                            </li>
                            <li class="w100">
                                {{ __('localization.CoreValues4')}}
                            </li>
                        </ul>
                    </div> -->



                    <!-- <img src="{{asset('public/assets/images/stock_2.jpg')}}">
                    <a  href="javascript:void(0)" style="cursor: default;" class="callNow"> <i class="fa fa-mobile-alt"></i> {{ __('localization.call_us')}}</a>
              -->
                </div><!--col-md-12-->
            </div><!--aboutBox2-->


        

            <div class="aboutBox2">
                <div class="col-md-12">
                    <div class="w100">
                        <div class="hero-content pb-5 text-center">
                            <h1 class="hero-heading"> {{ __('localization.our_services')}}</h1>
                        </div>
                    </div>
                    <div class="w100">
                        <div class="serviceBox">
                            <img src="{{asset('public/assets/images/icon_1.png')}}">
                            <h2> {{ __('localization.consulting')}}</h2>
                            <p> {{ __('localization.consulting_desc')}}</p>
                        </div><!--serviceBox-->
                        <div class="serviceBox">
                            <img src="{{asset('public/assets/images/icon_10.png')}}">
                            <h2> {{ __('localization.training')}}</h2>
                            <p>{{ __('localization.training_desc')}}</p>
                        </div><!--serviceBox-->
                        <div class="serviceBox">
                            <img src="{{asset('public/assets/images/icon_15.png')}}">
                            <h2>{{ __('localization.modern_workflow')}}</h2>
                            <p>consulting {{ __('localization.modern_workflow_desc')}}</p>
                        </div><!--serviceBox-->
                        <div class="serviceBox">
                            <img src="{{asset('public/assets/images/icon_3.png')}}">
                            <h2> {{ __('localization.after_sales')}}</h2>
                            <p> {{ __('localization.after_sales_desc')}}</p>
                        </div><!--serviceBox-->
                        <div class="serviceBox">
                            <img src="{{asset('public/assets/images/icon_4.png')}}">
                            <h2> {{ __('localization.top_statistics')}}</h2>
                            <p> {{ __('localization.top_statistics_desc')}}</p>
                        </div><!--serviceBox-->
                        <div class="serviceBox">
                            <img src="{{asset('public/assets/images/icon_5.png')}}">
                            <h2> {{ __('localization.after_sales')}}</h2>
                            <p> {{ __('localization.after_sales_desc')}}</p>
                        </div><!--serviceBox-->
                    </div><!--w100-->
                </div><!--col-md-12-->
            </div><!--aboutBox2-->
            <div class="aboutBox">
                <div class="col-md-12">
                    <div class="w100">
                        <div class="hero-content pb-5 text-center">
                            <h1 class="hero-heading"> {{ __('localization.our_partners')}}</h1>
                        </div>
                    </div>
                    <p>{{ __('localization.our_partners_desc')}}</p>
                    <div class="cPartners">
                        <div id="aboutOwl" class="w100 carousel_v2 owl-carousel owl-theme">
                            <div><img src="{{asset('public/assets/images/brand_1.jpg')}}"></div>
                            <div><img src="{{asset('public/assets/images/brand_2.jpg')}}"></div>
                            <div><img src="{{asset('public/assets/images/brand_3.jpg')}}"></div>
                            <div><img src="{{asset('public/assets/images/brand_4.jpg')}}"></div>
                            <div><img src="{{asset('public/assets/images/brand_5.jpg')}}"></div>
                            <div><img src="{{asset('public/assets/images/brand_6.jpg')}}"></div>
                            <div><img src="{{asset('public/assets/images/brand_7.jpg')}}"></div>
                            <div><img src="{{asset('public/assets/images/brand_8.jpg')}}"></div>
                            <div><img src="{{asset('public/assets/images/brand_9.jpg')}}"></div>
                            <div><img src="{{asset('public/assets/images/brand_10.jpg')}}"></div>
                            <div><img src="{{asset('public/assets/images/brand_11.jpg')}}"></div>
                        </div><!--w100-->
                    </div><!--cPartners-->
                    <p> {{ __('localization.our_partners_1')}}</p>
                </div><!--col-md-12-->
            </div><!--aboutBox2-->
            <div class="aboutBox2">
                <div class="col-md-12">
                    <div class="w100">
                        <div class="hero-content pb-5 text-center">
                            <h1 class="hero-heading"> {{ __('localization.featured_product')}}</h1>
                        </div>
                    </div>
                    <div class="w100">
                        @foreach($featured_items as $item)
                        <div class="serviceBox2">
                            <a class="pad0" href="{{route('itemDeatils', ['lang'=> App::getLocale(),'slug' => $item['slug']])}}">
                                <img src="{{config('paths.large_item') . $item['image']}}">
                            </a>
                            <a href="{{route('itemDeatils', ['lang'=> App::getLocale(),'slug' => $item['slug']])}}">
                                <h2> {{ $item['title']}}</h2>
                            </a>
                        </div><!--serviceBox-->
                        @endforeach
                        <div class="w100 mt-5">
                            <a href="{{route('home')}}" class="btn btn-primary btn-lg">{{ __('localization.view_all_featured_products')}}</a>
                        </div>
                    </div><!--col-md-12-->
                </div><!--aboutBox2-->
            </div><!--row-->
        </div>
    </div>
</section><!--Aboutpage-->
@endsection
