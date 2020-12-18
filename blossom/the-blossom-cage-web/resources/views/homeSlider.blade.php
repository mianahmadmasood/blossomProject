<section class="cSlider w100">

    <div class="owl-slider">
        <div id="chbibSlider" class="owl-carousel owl-theme">
            @if(!empty($response['homefeeds']['data']['banners']))
            
                @foreach($response['homefeeds']['data']['banners'] as $banners)
                    <div class="item">
                        @if(!empty($banners['item_slug']))
                            <a href="{{route('itemDeatils', ['lang'=> App::getLocale(), 'slug' => $banners['item_slug']])}}">
                                @if(App::getLocale() === 'ar')
                                    <img class="owl-lazy"
                                         data-src=" {{config('paths.large-banner-thumb') . $banners['ar_banner']}}"
                                         alt="">
                                @else
                                    <img class="owl-lazy"
                                         data-src=" {{config('paths.large-banner-thumb') . $banners['en_banner']}}"
                                         alt="">
                                @endif
                                <img class="owl-lazy" data-src="{{asset('public/assets/images/slide_1.jpg')}}" alt="" src="{{asset('public/assets/images/slide_1.jpg')}}" >

                            </a>
                        @elseif(!empty($banners['category_slug']))
                            <a href="javascript:void(0)" class="" id="link"
                               attr-slug="{{$banners['category_slug']}}">

                                @if(App::getLocale() === 'ar')
                                    <img class="owl-lazy"
                                         data-src=" {{config('paths.large-banner-thumb') . $banners['ar_banner']}}"
                                         alt="">
                                @else
                                    <img class="owl-lazy"
                                         data-src=" {{config('paths.large-banner-thumb') . $banners['en_banner']}}"
                                         alt="">
                                @endif
                            </a>
                        @elseif(!empty($banners['brand_slug']))

                            <a href="javascript:void(0)" id="link"
                               attr-slug="all&brands={{$banners['brand_slug']}}">
                                @if(App::getLocale() === 'ar')
                                    <img class="owl-lazy"
                                         data-src=" {{config('paths.large-banner-thumb') . $banners['ar_banner']}}"
                                         alt="">
                                @else
                                    <img class="owl-lazy"
                                         data-src=" {{config('paths.large-banner-thumb') . $banners['en_banner']}}"
                                         alt="">
                                @endif
                            </a>

                        @endif
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</section><!--cSlider-->
