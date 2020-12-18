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
                    Product Colors
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        &nbsp;
                        <a href="{{route('createcolor')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
                        <a href="{{route('getColors')}}" class="btn btn-secondary btn-secondary--icon" id="kt_reset">
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
            @if ($colors->count() > 0)
                <div class="tableOuter">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>English Name</th>
                        <th>Arabic Name</th>
                        <th>Color Code</th>
                        <th>Color Label</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($colors as $key => $color)
                    <tr>
                        <td> {{$key+1}}</td>
                        <td> {{$color->en_title}}</td>
                        <td> {{$color->ar_title}}</td>
                        <td>
                            {{ $color->color_code}}

                        </td>
                        <td>
                            <span style="border: 1px solid #ccc; background: {{ $color->color_code}} ; margin-top: 5px;width: 40px; "class="kt-badge kt-badge--dark kt-badge--inline kt-badge--pill kt-badge--rounded"></span>

                        </td>

                        <td>
                            <a href="{{route('editColorOnly', ['uid' => $color->uuid])}}">
                                <i class="la la-edit">Edit</i>
                            </a>&nbsp;  &nbsp;
                            @if($color->archive == 0)
                            <a href="{{route('updateArchiveColor', ['uid' => $color->uuid,'status' => 'in-active'])}}" class="alterConfirmMassageForColor">
                                <i class="fa fa-trash">Delete</i>
                            </a>
                            @else
                            <a href="{{route('updateArchiveColor', ['uid' => $color->uuid,'status' => 'active'])}}" class="alterConfirmMassageForColorActive">
                                <i class="fa fa-trash">Unarchive</i>
                            </a>
                            @endif
                            <br>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
                {{ $colors->appends(request()->query())->links() }}
            @else
            <p><b> No Data Available </b></p>
            @endif
        </div>
    </div></div>
<script></script>
@endsection