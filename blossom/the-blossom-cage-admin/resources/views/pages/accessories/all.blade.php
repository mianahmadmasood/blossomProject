@extends('layouts.main') 
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-accessorie flaticon2-list"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Product Accessories
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        &nbsp;
                        <a href="{{route('createaccessorie')}}" class="btn btn btn-primary btn-accessorie btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            New Record
                        </a>
                    </div>	
                </div>		
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="kt-form kt-form--fit kt-margin-b-20">
                <div class="row kt-margin-b-20">
                    <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                        {{ Form::text('searchTextBox',$searchText,
                                array('name' => 'search', 'id'=>'searchTextBox','class'=>'form-control kt-input','placeholder'=>'E.g: Electronics or "إلكترونيات"')) 
                        }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button id="search" class="btn btn-primary btn-accessorie--icon" id="kt_search">
                            <span>
                                <i class="la la-search"></i>
                                <span>Search</span>
                            </span>
                        </button>
                        &nbsp;&nbsp;
                        <a href="{{route('getAccessories')}}" class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <!--</form>-->
            <!--begin: Datatable -->
            @if ($accessories->count() > 0)
                <div class="tableOuter">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>Title</th>
                        <th>Title(Arabic)</th>
                        <th>Price</th>
                        <th>Image</th>
{{--                        <th>Products List</th>--}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accessories as $key => $accessorie)
                    <tr>
                        <td> {{$key+1}}</td>
                        <td> {{$accessorie->en_title}}</td>
                        <td> {{$accessorie->ar_title}}</td>
                        <td> {{$accessorie->price}}</td>
                        @php

                        $image = '';
                        if(!empty($accessorie->image)){
                        $image = $accessorie->image;
                        }else{
                        $image = 'Category_5daf2155ba6481571758421.jpg';
                        }
                        @endphp

                        @if(!empty($accessorie->image))
                            <td> <img class="imagSize" src="{{config('paths.home_url') . 'thumbnails/large/accessories/' . $image}}"></td>
                        @else
                            <td> <img class="imagSize" src="{{config('paths.home_url') . 'thumbnails/large/categories/' . $image}}"></td>
                        @endif

{{--                        <td> <a href="{{route('getCategoryItems', ['uuid' => $accessorie->uuid])}}"> <i class="fa fa-eye"> </i> View Products</a></td>--}}
                        <td>
                            <a href="{{route('editAccessorie', ['uid' => $accessorie->uuid])}}">
                                <i class="la la-edit">Edit</i>
                            </a>&nbsp;  &nbsp;
                            @if($accessorie->archive == 0)
                            <a href="{{route('updateArchiveAccessorie', ['uid' => $accessorie->uuid,'status' => 'in-active'])}}" class="alterConfirmMassageForAccessorie">
                                <i class="fa fa-trash">Delete</i>
                            </a>
                            @else
                            <a href="{{route('updateArchiveAccessorie', ['uid' => $accessorie->uuid,'status' => 'active'])}}" class="alterConfirmMassageForAccessorieActive">
                                <i class="fa fa-trash">Unarchive</i>
                            </a>
                            @endif
                            <br>
{{--                            @if($accessorie->status == 0)--}}
{{--                            <a href="{{route('updateStatusAccessorie', ['uid' => $accessorie->uuid,'status' => 'in-active'])}}">--}}
{{--                                <i class="la la-refresh">Active</i>--}}
{{--                            </a>--}}
{{--                            @else--}}
{{--                            <a href="{{route('updateStatusAccessorie', ['uid' => $accessorie->uuid,'status' => 'active'])}}">--}}
{{--                                <i class="la la-refresh">De Active</i>--}}
{{--                            </a>--}}
{{--                            @endif--}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
                {{ $accessories->appends(request()->query())->links() }}
            @else
            <p><b> No Data Available </b></p>
            @endif
        </div>
    </div></div>
<script></script>
@endsection