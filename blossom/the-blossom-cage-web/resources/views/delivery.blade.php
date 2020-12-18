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
                    <a href="{{route('delivery')}}">{{ __('localization.delivery_btn')}}</a>
                </div><!--w100-->
                <div class="w100">
                    <div class="hero-content pb-5 text-center">
                        <h1 class="hero-heading">{{ __('localization.delivery_btn')}}</h1>
                    </div>
                </div><!--w100-->
            </div>
        </div><!--row-->
        <div class="row">
            <div class="col-md-12">
                <div class="subpagez">
                    <div class="itemlistz2">
                        <h2>{{ __('localization.delivery_service')}}</h2>
                        <p>{{ __('localization.delivery_service_p1')}}</p>
                        <p>{{ __('localization.delivery_service_p2')}}</p>
                    </div>
                    <div class="itemlistz2">
                        <h2>{{ __('localization.service')}}</h2>
                        <p>{{ __('localization.service_p1')}}</p>
                    </div>
                    <div class="itemlistz2">
                        <h2>{{ __('localization.worldwide_delivery')}}</h2>
                        <p>{{ __('localization.worldwide_delivery_p1')}}</p>
                    </div>
                </div><!--subpagez-->
            </div>
        </div><!--row-->
    </div><!--container-->
</section><!--innerpagez-->
@endsection