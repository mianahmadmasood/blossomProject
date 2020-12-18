@extends('layouts.main') 
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="alert alert-light alert-elevate" role="alert">
        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
        <div class="alert-text">
            The record you are entering here, will be displayed on the web application and mobile application. Please enter the data carefully.
        </div>
    </div>

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-list"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                   Deleted Product Listing
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="kt-form kt-form--fit kt-margin-b-20">
                <div class="row kt-margin-b-20">
                    <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                        {{ Form::text('searchTextBox',$searchText,
                                array('name' => 'search', 'id'=>'searchTextBox','class'=>'form-control kt-input','placeholder'=>'E.g: Vaccum')) 
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
                        @if(strpos(request()->url(), 'approved'))
                        <a href="{{route('allItem')}}" class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                        </a>
                        @elseif(strpos(request()->url(), 'pending'))
                        <a href="{{route('allPendingItem')}}" class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <!--</form>-->
            <!--begin: Datatable -->
            @if ($items->count() > 0)
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Completion Ratio</th>
                        <th>Code</th>
                        <th>Model</th>
                        <th>Title(EN)</th>
                        <th>Title(AR)</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                        @foreach($items as $key=> $item)

                            <tr>
                                @if($item->is_approved !== 1)
                                    @php
                                        $complete = 60;

                                        if ($item->sizes) {
                                        $complete = $complete + 10;
                                        }
                                        if ($item->colors) {
                                        $complete = $complete + 10;
                                        }if ($item->vidoes) {

                                        $complete = $complete + 10;
                                        }
                                        if ($item->manual) {

                                        $complete = $complete + 10;
                                        }
                                    @endphp
                                @endif
                                <td> {{ isset($complete) ? $complete : 100}} %</td>
                                <td> {{$item->item_code}}</td>
                                <td> {{$item->model}}</td>
                                <td> {{$item->en_title}}</td>
                                <td> {{$item->ar_title}}</td>
                                <td>
                                    @if($item->is_featured == 1)
                                        <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Featured</span>
                                        <br>
                                    @endif
                                    <a style="text-decoration: underline;" href="{{route('removed', ['key' => 'reactive','uid' => $item->uuid])}}"class="la la-trash alterConfirmMassageForProductActive">ReActive Product</a>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            {{$items->links()}}
            <!--end: Datatable -->
            @else
                <p><b> No Data Available </b></p>
            @endif
        </div>
    </div></div>
<script></script>
@endsection