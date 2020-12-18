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
        </div>

        @include('partials.banners')

        <div class="kt-portlet__body">
            <!--</form>-->
            <!--begin: Datatable -->
            @if ($banners->count() > 0)
                <div class="tableOuter">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>

                        <th>Banner</th>
                        <th>Banner(Arabic)</th>
                        <th>Link this Banner to</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="row_position">
                    @foreach($banners as $key => $banner)

                    <tr id="{{$banner->id}}">
                        @php

                            $image = '';
                            if(!empty($banner->en_banner)){
                            $image = $banner->en_banner;
                            }else{
                            $image = 'Category_5daf2155ba6481571758421.jpg';
                            }
                        @endphp

                        @if(!empty($banner->en_banner))
                            <td> <img height="60" width="150" src="{{config('paths.home_url') . 'thumbnails/large/banners/' . $image}}"></td>
                        @else
                            <td> <img height="60" width="150" src="{{config('paths.home_url') . 'thumbnails/large/categories/' . $image}}"></td>
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
                            <td> <img height="60" width="150" src="{{config('paths.home_url') . 'thumbnails/large/banners/' . $image_ar}}"></td>
                        @else
                            <td> <img height="60" width="150" src="{{config('paths.home_url') . 'thumbnails/large/categories/' . $image_ar}}"></td>
                        @endif

                        <td width="100%">
                            @if(!empty($banner->brand_id))
                                 <strong>Brand :</strong>
                                <?php
                                $Bannerdata = \App\Brands::where('id', $banner->brand_id)->first();
                                ?>
                                {{$Bannerdata->en_title}}
                                <br>
                            @endif

                            @if(!empty($banner->categories_id))
                                <strong>Category :</strong>
                                <?php
                                $Categorydata = \App\Category::where('id', $banner->categories_id)->first();
                                ?>
                                {{$Categorydata->en_title}}
                                <br>
                            @endif

                            @if(!empty($banner->sub_categories_id))
                                <strong>Sub Category :</strong>
                                <?php
                                $Categorydata = \App\Category::where('id', $banner->sub_categories_id)->first();
                                ?>
                                {{$Categorydata->en_title}}
                                <br>
                            @endif

                            @if(!empty($banner->item_id))
                                <strong>Product :</strong>
                                <?php
                                $Itemdata = \App\Item::where('id', $banner->item_id)->first();
                                ?>
                                {{$Itemdata->en_title}}
                            @endif

                        </td>

                        <td>
                            @if($banner->archive == 0)
                            <a href="{{route('updateArchiveBanner', ['uid' => $banner->uuid,'status' => 'in-active','type' => 'banners'])}}" class="alterConfirmMassageForbanner">
                                <i class="fa fa-trash">Delete</i>
                            </a>
                            @else
                            <a href="{{route('updateArchiveBanner', ['uid' => $banner->uuid,'status' => 'active','type' => 'banners'])}}" class="alterConfirmMassageForbannerActive">
                                <i class="fa fa-trash">Unarchive</i>
                            </a>
                            @endif
                            <br>
                                @if($banner->status == 0)
                            <a href="{{route('updateStatusBanner', ['uid' => $banner->uuid,'status' => 'in-active','type' => 'banners'])}}" >
                                <i class="la la-trash">Deactive</i>
                            </a>
                            @else
                            <a href="{{route('updateStatusBanner', ['uid' => $banner->uuid,'status' => 'active','type' => 'banners'])}}" >
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
                    {{--                {{ $banners->appends(request()->query())->links() }}--}}
            @endif
        </div>
    </div></div>
<!-- Bootstrap & Core Scripts -->
<script src="{{asset('public/js/sorting/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('public/js/sorting/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/js/homeBannersForOrderPositioning.js')}}"></script>
@endsection