@extends('layouts.main') 
@section('content')
@inject('commonService', 'App\Http\Services\Order')
<div class="kt-content  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h1 class="kt-portlet__head-title">
                            <i class=" fa fa-shopping-cart"></i> Order Info
                        </h1>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            <img height="50" width="50" class="img-rounded" src="{{config('paths.home_url') . config('paths.medium-profiles-thumb') . $employee->image}}" alt="">
                            Assigned Orders Detail
                        </h3>
                    </div>

                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget12">
                        <div class="kt-widget12__content">
                            <h4>Employee Details</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="kt-widget12__desc bbold">Name</span> <br>
                                    <span>{{$employee->first_name}} {{$employee->last_name}}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="kt-widget12__desc bbold">Email</span> <br>
                                    <span>{{$employee->email}}</span>	
                                </div>
                                <div class="col-md-4">
                                    <span class="kt-widget12__desc bbold">Phone</span> <br>
                                    <span class="">{{$employee->phone_no}}</span>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="kt-widget12__desc bbold">Total Current Orders</span> <br>
                                    <span>{{count($pending_assignments)}}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="kt-widget12__desc bbold">Total Completed Orders</span> <br>
                                    <span>{{count($completed_assignment)}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>			 
            </div>
        </div>
    </div>
    <div class="row">        <div class="col-md-12">

            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-list"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Current Servings
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">

                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        @if($pending_assignments->isEmpty())
                        No Data Available
                        @else
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Customer Name</th>
                                <th>Total Amount</th>
                                <th>Date</th>
                                <th>Current Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        @foreach($pending_assignments as $key => $assignment)
                        <tr>
                            <td>{{$assignment->order_token}}</td>
                            <td>{{$assignment->recipient_first_name}}</td>
                            <td> SAR {{$assignment->total_amount}}</td>
                            <td>{{date('Y-m-d', strtotime($assignment->created_at))}}</td>
                            <td>{{$assignment->status->en_title}}</td>
                            <td>
                                <a href="{{route('showOrder', ['uid' => $assignment->uuid])}}"class="la la-fast-forward">Details</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-list"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Completed Servings
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">

                    <!--</form>-->
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        @if($completed_assignment->isEmpty())
                        No Data Available
                        @else
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Customer Name</th>
                                <th>Total Amount</th>
                                <th>Date Time</th>
                                <th>Current Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completed_assignment as $key => $assignment)
                            <tr>
                                <td>{{$assignment->order_token}}</td>
                                <td>{{$assignment->recipient_first_name}}</td>
                                <td> SAR {{$assignment->total_amount}}</td>
                                <td>{{date('Y-m-d', strtotime($assignment->created_at))}}</td>
                                <td>{{$assignment->status->en_title}}</td>
                                <td>
                                    <a href="{{route('showOrder', ['uid' => $assignment->uuid])}}"class="la la-fast-forward">Details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection