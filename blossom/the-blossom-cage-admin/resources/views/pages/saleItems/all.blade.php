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
                    Home Banners
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
{{--                    <div class="kt-portlet__head-actions">--}}
{{--                        <a href="{{route('createbanner')}}" class="btn btn-primary btn-elevate btn-icon-sm">--}}
{{--                            <i class="la la-plus"></i>--}}
{{--                            New Record--}}
{{--                        </a>--}}
{{--                    </div>	--}}
                </div>		
            </div>
        </div>

        @include('partials.banners')

        <div class="kt-portlet__body">
            <div class="kt-form kt-form--fit kt-margin-b-20">
                <div class="row">
                    <div class="col-lg-12">

                     </div>
                </div>
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <button id="search" class="btn btn-primary btn-banner--icon" id="kt_search">--}}
{{--                            <span>--}}
{{--                                <i class="la la-search"></i>--}}
{{--                                <span>Search</span>--}}
{{--                            </span>--}}
{{--                        </button>--}}
{{--                        &nbsp;&nbsp;--}}
{{--                        <a href="{{route('getCategories')}}" class="btn btn-secondary btn-secondary--icon" id="kt_reset">--}}
{{--                            <span>--}}
{{--                                <i class="la la-close"></i>--}}
{{--                                <span>Reset</span>--}}
{{--                            </span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <!--</form>-->
            <!--begin: Datatable -->
            @if ($banners->count() > 0)
                <div class="tableOuter">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>Banner</th>
                        <th>Banner(Arabic)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="row_position">
                    @foreach($banners as $key => $banner)
                    <tr id="{{$banner->id}}">
                        <td> {{$key+1}}</td>
                        @php

                            $image = '';
                            if(!empty($banner->en_banner)){
                            $image = $banner->en_banner;
                            }else{
                            $image = 'Category_5daf2155ba6481571758421.jpg';
                            }
                        @endphp

                        @if(!empty($banner->en_banner))
                            <td> <img height="200" width="200" src="{{config('paths.home_url') . 'thumbnails/large/banners/' . $image}}"></td>
                        @else
                            <td> <img height="200" width="200" src="{{config('paths.home_url') . 'thumbnails/large/categories/' . $image}}"></td>
                        @endif
                        @php
                            $image_ar = '';
                            if(!empty($banner->ar_banner)){
                            $image_ar = $banner->ar_banner;
                            }else{
                            $image_ar = 'Category_5daf2155ba6481571758421.jpg';
                            }
                        @endphp

                        @if(!empty($banner->ar_banner))
                            <td> <img height="200" width="200" src="{{config('paths.home_url') . 'thumbnails/large/banners/' . $image_ar}}"></td>
                        @else
                            <td> <img height="200" width="200" src="{{config('paths.home_url') . 'thumbnails/large/categories/' . $image_ar}}"></td>
                        @endif

                        <td>
                            @if($banner->archive == 0)
                            <a href="{{route('updateArchiveBanner', ['uid' => $banner->uuid,'status' => 'in-active'])}}" class="alterConfirmMassageForbanner">
                                <i class="fa fa-trash">Delete</i>
                            </a>
                            @else
                            <a href="{{route('updateArchiveBanner', ['uid' => $banner->uuid,'status' => 'active'])}}" class="alterConfirmMassageForbannerActive">
                                <i class="fa fa-trash">Unarchive</i>
                            </a>
                            @endif
                            <br>
                                @if($banner->status == 0)
                            <a href="{{route('updateStatusBanner', ['uid' => $banner->uuid,'status' => 'in-active'])}}" >
                                <i class="la la-trash">Deactive</i>
                            </a>
                            @else
                            <a href="{{route('updateStatusBanner', ['uid' => $banner->uuid,'status' => 'active'])}}" >
                                <i class="la la-trash">Active</i>
                            </a>
                            @endif
                            <br>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
                {{ $banners->appends(request()->query())->links() }}
            @endif
        </div>
    </div></div>
<!-- Bootstrap & Core Scripts -->
<script src="{{asset('public/js/sorting/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('public/js/sorting/jquery-ui.min.js')}}"></script>
<script>
    jQuery(document).ready(function ($) {
        $(".row_position").sortable({
            delay: 150,
            stop: function () {
                var selectedData = new Array();
                $('.row_position>tr').each(function () {
                    selectedData.push($(this).attr("id"));
                });
                updateOrder(selectedData);
            }
        });
        function updateOrder(data) {
            console.log(data);
            $.ajax({
                type: "post",
                url: baseUrl + "banners/position",
                data: {_token: token, position: data},
                success: function (result) {
                    if (result.success === true) {
                    } else {
                        $.alert({
                            title: 'Aww!',
                            content: 'Internal server error.',
                        });
                    }
                },
                error: function () {
                    $.alert({
                        title: 'Aww!',
                        content: 'Internal server error.',
                    });
                }
            });

        }
    });
    </script>

@endsection