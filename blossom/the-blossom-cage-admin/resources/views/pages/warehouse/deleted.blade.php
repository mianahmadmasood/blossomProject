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
                  Archived Product Categories
                </h3>
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
                        <button id="search" class="btn btn-primary btn-brand--icon" id="kt_search">
                            <span>
                                <i class="la la-search"></i>
                                <span>Search</span>
                            </span>
                        </button>
                        &nbsp;&nbsp;
                        <a href="{{route('getArchivedCategories')}}" class="btn btn-secondary btn-secondary--icon" id="kt_reset">
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
            @if ($categories->count() > 0)
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>Title</th>
                        <th>Title(Arabic)</th>
                        <th>Image</th>
                        <th>Products List</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $cat)
                    <tr>
                        <td> {{$key+1}}</td>
                        <td> {{$cat->en_title}}</td>
                        <td> {{$cat->ar_title}}</td>
                        @php 

                        $image = '';
                        if(!empty($cat->image)){
                        $image = $cat->image;
                        }else{
                        $image = 'Category_5daf2155ba6481571758421.jpg';
                        }
                        @endphp
                        <td> <img height="200" width="200" src="{{config('paths.home_url') . 'thumbnails/large/categories/' . $image}}"></td>
                        <td> <a href="{{route('getCategoryItems', ['uuid' => $cat->uuid])}}"> <i class="fa fa-eye"> </i> View Products</a></td>
                        <td>
                            <a href="{{route('editCategory', ['uid' => $cat->uuid])}}">
                                <i class="la la-edit">Edit</i>
                            </a>&nbsp;  &nbsp;
                            @if($cat->archive == 0)
                            <a href="{{route('updateStatusCategory', ['uid' => $cat->uuid,'status' => 'in-active'])}}">
                                <i class="la la-refresh">Deactivate</i>
                            </a>
                            @else
                            <a href="{{route('updateStatusCategory', ['uid' => $cat->uuid,'status' => 'active'])}}" class="alterConfirmMassageForWarehouseActive">
                                <i class="la la-refresh">Activate</i>
                            </a>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                {{$categories->links()}}
            </table>
            <!--end: Datatable -->
            @else
            <p><b> No Data Available </b></p>
            @endif
        </div>
    </div></div>
<script></script>
@endsection