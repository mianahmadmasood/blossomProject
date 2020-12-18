@extends('layouts.item_listing')
@section('content')
<section class="innerpagez">
    <div class="container">
        @include('partials.messages')
        <div class="row">
            <div class="col-md-12">
                <div class="w100 pageStatus mb-3">
                    <a href="{{route('home')}}">{{ __('localization.h_btn')}}</a>
                    <a href="">/</a>
                    <a href="{{route('privacy')}}">{{ __('localization.store_btn')}}</a>
                </div><!--w100-->
                <div class="w100">
                    <div class="hero-content pb-5 text-center">
                        <h1 class="hero-heading">{{ __('localization.store_heading')}}</h1>
                    </div>
                </div><!--w100-->
            </div>
        </div><!--row-->
        <div class="row">
            <div class="col-md-12">
                <div class="subpagez">
                    <div class="itemlistz2">
                        <h2>{{ __('localization.chbib_environmental_care_warehouse')}}</h2>
                        <p>{{ __('localization.near_al_hammami_petrol')}}</p>
                    </div>
{{--                    <div class="itemlistz2">--}}
{{--                        <h2>{{ __('localization.spares')}}</h2>--}}
{{--                        <p>{{ __('localization.spares_p1')}}</p>--}}
{{--                    </div>--}}
                </div><!--subpagez-->
            </div>
        </div><!--row-->
    </div><!--container-->
</section><!--innerpagez-->
@endsection
