@extends('layouts.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-list"></i>
                </span>
                    <h3 class="kt-portlet__head-title">
                        Top Categories For Home Page
                    </h3>
                </div>
            </div>
            <?php $total_lenght = 4 ;?>
            @for($i= 1 ; $i<= $total_lenght ; $i++ )
                <?php $catgorytype='top_categories_'.$i ; ?>
                @include('partials.topCategoriesForm')
                @include('partials.topCategorieslist')
            @endfor
        </div></div>
    <!-- Bootstrap & Core Scripts -->
    <script src="{{asset('public/js/sorting/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/js/sorting/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/js/homeBannersForOrderPositioning.js')}}"></script>
@endsection