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
                   {{$category->en_title}}'s PRODUCT LISTING
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
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

                            <a href="{{route('showItem', ['uid' => $item->uuid])}}"class="la la-fast-forward">Details</a>
                            @if($item->is_approved == 1)
                            &nbsp;
                            <a href="{{route('changeItemStatus', ['key' => 'dismiss', 'uid' => $item->uuid])}}"class="la la-trash">Deactivate</a>
                            <br>
                            <br>
                            @if($item->is_featured == 0)
                            &nbsp;
                            <a style="text-decoration: underline;" href="{{route('makeFeatured', ['key' => 'add','uid' => $item->uuid])}}">Make Featured</a>
                            @else
                            &nbsp;
                            <a style="text-decoration: underline;" href="{{route('makeFeatured', ['key' => 'remove','uid' => $item->uuid])}}">Remove Featured</a>
                            @endif
                            @endif
                            <br>
                            <br>
                            <a style="text-decoration: underline;" href="{{route('removed', ['key' => 'remove','uid' => $item->uuid])}}"class="la la-trash">Delete Product</a>
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