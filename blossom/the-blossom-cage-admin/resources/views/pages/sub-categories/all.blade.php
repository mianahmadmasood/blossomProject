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
                    Product Sub Categories
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{route('createSubCategory')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
                        <button id="search" class="btn btn-primary btn-brand--icon" id="kt_search">
                            <span>
                                <i class="la la-search"></i>
                                <span>Search</span>
                            </span>
                        </button>
                        &nbsp;&nbsp;
                        <a href="{{route('getSubCategories')}}" class="btn btn-secondary btn-secondary--icon" id="kt_reset">
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
                <div class="tableOuter">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>Parent Title</th>
                        <th>Parent Title(Arabic)</th>
                        <th>Title</th>
                        <th>Title(Arabic)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($categories as $key => $cat)
                            <tr>
                                <td> {{$key+1}}</td>
                                <td> {{$cat->parent_category->en_title}}</td>
                                <td> {{$cat->parent_category->ar_title}}</td>
                                <td> {{$cat->en_title}}</td>
                                <td> {{$cat->ar_title}}</td>
                                <td>
                                    <a href="{{route('editSubCategory', ['uid' => $cat->uuid])}}">
                                        <i class="la la-edit">Edit</i>
                                    </a>
                                    &nbsp;  &nbsp;
                                    @if($cat->archive == 0)
                                        <a href="{{route('updateStatusSubCategory', ['uid' => $cat->uuid,'status' => 'in-active'])}}" class="alterConfirmMassageForCategory">
                                            <i class="fa fa-trash">Delete</i>
                                        </a>
                                    @else
                                        <a href="{{route('updateStatusSubCategory', ['uid' => $cat->uuid,'status' => 'active'])}}" class="alterConfirmMassageForCategoryActive">
                                            <i class="fa fa-trash">Unarchive</i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
                </div>
            {{$categories->links()}}
            @else
                <p><b> No Data Available </b></p>
            @endif
        </div>
    </div></div>
<script></script>
@endsection