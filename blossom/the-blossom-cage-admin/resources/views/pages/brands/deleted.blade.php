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
                  Archived Brands
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
                        <a href="{{route('getDeletedBrands')}}" class="btn btn-secondary btn-secondary--icon" id="kt_reset">
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
            @if ($brands->count() > 0)
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>Title</th>
                        <th>Title(Arabic)</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $key => $brand)
                    <tr>
                        <td> {{$key+1}}</td>
                        <td> {{$brand->en_title}}</td>
                        <td> {{$brand->ar_title}}</td>
                        @php 

                        $image = '';
                        if(!empty($brand->image)){
                        $image = $brand->image;
                        }else{
                        $image = 'Category_5daf2155ba6481571758421.jpg';
                        }
                        @endphp
                        <td> <img height="200" width="200" src="{{config('paths.home_url') . 'thumbnails/large/brands/' . $image}}"></td>
                        <td>
                             &nbsp;
                            @if($brand->archive == 0)
                                <a href="{{route('updateArchiveBrand', ['uid' => $brand->uuid,'status' => 'in-active'])}}" class="alterConfirmMassageForBrand">
                                    <i class="fa fa-trash">Archive</i>
                                </a>
                            @else
                                <a href="{{route('updateArchiveBrand', ['uid' => $brand->uuid,'status' => 'active'])}}" class="alterConfirmMassageForBrandActive">
                                    <i class="fa fa-trash">Unarchive</i>
                                </a>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                {{$brands->links()}}
            </table>
            <!--end: Datatable -->
            @else
            <p><b> No Data Available </b></p>
            @endif
        </div>
    </div></div>
<script></script>
@endsection