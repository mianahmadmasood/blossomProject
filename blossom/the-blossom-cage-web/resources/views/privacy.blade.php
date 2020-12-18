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
                    <a href="{{route('privacy')}}">{{ __('localization.ploicy_btn')}}</a>
                </div><!--w100-->
                <div class="w100">
                    <div class="hero-content pb-5 text-center">
                        <h1 class="hero-heading">{{ __('localization.ploicy_btn')}}</h1>
                    </div>
                </div><!--w100-->
            </div>
        </div><!--row-->
        <div class="row">
            <div class="col-md-12">
                <div class="subpagez">
                    <div class="itemlistz2">
                        <h2>{{ __('localization.general')}}</h2>
                        <p>{{ __('localization.general_p1')}}</p>
                    </div>
                    <div class="itemlistz2">
                        <h2>{{ __('localization.the_collection_of_personal_data')}}</h2>
                        <p>
                            {{ __('localization.the_collection_of_personal_data_p1')}}
                        </p>
                    </div>
                    <div class="itemlistz2">
                        <h2> {{ __('localization.data_quality')}}</h2>
                        <p>{{ __('localization.data_quality_p1')}}</p>
                    </div>
                </div><!--subpagez-->
            </div>
        </div><!--row-->
    </div><!--container-->
</section><!--innerpagez-->
@endsection