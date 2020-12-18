@extends('layouts.main')
@section('content')

    @inject('commonService', 'App\Http\Services\Order')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                <img height="50" width="50" class="img-rounded"
                                     src="{{config('paths.home_url') . config('paths.medium-profiles-thumb') . $cusotmer->image}}"
                                     alt="">
                                <h4>&nbsp;Customer information</h4>
                            </h3>
                        </div>

                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget12">
                            <div class="kt-widget12__content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Name</span> <br>
                                        <span>{{$cusotmer->first_name}} {{$cusotmer->last_name}}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Email</span> <br>
                                        <span>{{$cusotmer->email}}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Phone</span> <br>
                                        <span class="">{{$cusotmer->phone_no}}</span>
                                    </div>

                                </div>
                                <br>
                            </div>
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
                                <h4>Order information</h4>
                            </h3>
                        </div>

                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-widget12">
                            <div class="kt-widget12__content">

                                <div class="row">
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Total New Orders</span> <br>
                                        <span>{{$new_Orders_count}}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Total Accepted Orders</span> <br>
                                        <span>{{$accepted_Orders_count}}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Total Displatched Orders</span> <br>
                                        <span>{{$displatched_Orders_count}}</span>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Total Completed Orders</span> <br>
                                        <span>{{$completed_assignment_count}}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Total Cancelled Orders</span> <br>
                                        <span>{{$cancelled_assignment_count}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
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
                                Current Orders
                            </h3>
                        </div>
                        <div style="margin-top: 10px; margin-left: 20px;">
                            <select id="order_type_filter" name="order_type_filter" class="form-control  js-example-basic-single">
                                <option value="all">Select Order Type</option>
                                <option value="new_Orders" @if($type == 'new_Orders') selected @endif >New Orders</option>
                                <option value="accepted_Orders" @if($type == 'accepted_Orders') selected @endif >Accepted Orders</option>
                                <option value="delivered_Orders" @if($type == 'delivered_Orders') selected @endif >Delivered Orders</option>
                                <option value="canceled_Orders" @if($type == 'canceled_Orders') selected @endif >Canceled Orders</option>
                                <option value="displatched_Orders" @if($type == 'displatched_Orders') selected @endif >Displatched Orders</option>
                                <option value="completed_Orders" @if($type == 'completed_Orders') selected @endif >Completed Orders</option>
                            </select>
                        </div>


                    </div>
                    <input type="hidden" value="{{$id}}" id="uuid">
                    <div class="kt-portlet__body">
                        @if($pending_assignments->isEmpty())
                            No Data Available
                        @else
                            <table class="table table-striped- table-bordered table-hover table-checkable"
                                   id="kt_table_1">
                                <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Total Amount</th>
                                    <th>Date</th>
                                    <th>Current Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                @foreach($pending_assignments as $key => $assignment)
                                    <tr>
                                        <td>{{$assignment->order_token}}</td>
                                        <td> SAR {{$assignment->total_amount}}</td>
                                        <td>{{date('Y-m-d', strtotime($assignment->created_at))}}</td>
                                        <td>
                                            @if($assignment->status->en_title == 'received')
                                                New Orders
                                                @else
                                                {{$assignment->status->en_title}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('showOrder', ['uid' => $assignment->uuid])}}"
                                               class="la la-fast-forward">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        {{ $pending_assignments->appends(request()->query())->links() }}
                    @endif
                    <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection