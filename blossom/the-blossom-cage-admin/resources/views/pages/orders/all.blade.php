@extends('layouts.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="alert alert-light alert-elevate" role="alert">
            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
            <div class="alert-text">
                The record you are entering here, will be displayed on the web application and mobile application.
                Please enter the data carefully.
            </div>
        </div>

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-list"></i>
                </span>
                    <h3 class="kt-portlet__head-title" style=" text-transform: uppercase;">
                        {{$type}} Orders Listing
                    </h3>
                </div>
            </div>

            <div class="kt-portlet__body">
                <div class="kt-form kt-form--fit kt-margin-b-20">
                    <div class="row kt-margin-b-20">
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            {{ Form::text('searchTextBox',$searchText,
                                    array('name' => 'search', 'id'=>'searchTextBox','class'=>'form-control kt-input','placeholder'=>' E.g: Transaction=dxb1243'))
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
                            @if(strpos(request()->url(), 'new'))
                                <a href="{{route('orders', ['type' => 'new'])}}"
                                   class="btn btn-secondary btn-secondary--icon">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                                </a>
                            @elseif(strpos(request()->url(), 'accepted'))
                                <a href="{{route('orders', ['type' => 'accepted'])}}"
                                   class="btn btn-secondary btn-secondary--icon">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                                </a>
                            @elseif(strpos(request()->url(), 'dispatched'))
                                <a href="{{route('orders', ['type' => 'dispatched'])}}"
                                   class="btn btn-secondary btn-secondary--icon">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                                </a>
                            @elseif(strpos(request()->url(), 'completed'))
                                <a href="{{route('orders', ['type' => 'completed'])}}"
                                   class="btn btn-secondary btn-secondary--icon">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                                </a>
                            @elseif(strpos(request()->url(), 'cancelled'))
                                <a href="{{route('orders', ['type' => 'cancelled'])}}"
                                   class="btn btn-secondary btn-secondary--icon">
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
                @if ($orders->count() > 0)
                    <div class="tableOuter">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                        <tr>
                            <th>Order Token</th>
                            <th>Customer Name</th>
                            <th>Total Amount</th>
                            <th>Date</th>
                            <th>Current Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $key => $order)

                            <tr>
                                <td>{{$order->order_token}}</td>
                                <td>{{$order->recipient_first_name}}</td>
                                <td> SAR {{$order->total_amount}}</td>
                                <td>{{date('Y-m-d', strtotime($order->created_at))}}</td>
                                <td>
                                    @if($order->transaction_status != 'rejected' )
                                        @if($order->status->en_title == 'received' )
                                            New Orders
                                        @elseif($order->status->en_title == 'accepted')
                                            Accepted Orders
                                        @elseif($order->status->en_title == 'dispatched' )
                                            Dispatched Orders
                                        @elseif($order->status->en_title == 'delivered' )
                                            Completed Orders
                                        @elseif($order->status->en_title == 'cancelled' )
                                            Cancelled Orders
                                        @endif
                                    @else
                                        Rejected Orders
                                    @endif

                                </td>
                                <td>
                                    <a href="{{route('showOrder', ['uid' => $order->uuid])}}"
                                       class="la la-fast-forward">Details</a>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                    </div>
                    {{ $orders->appends(request()->query())->links() }}
                <!--end: Datatable -->
                @else
                    <p><b> No Data Available </b></p>
                @endif
            </div>
        </div>
    </div>
    <script></script>
@endsection