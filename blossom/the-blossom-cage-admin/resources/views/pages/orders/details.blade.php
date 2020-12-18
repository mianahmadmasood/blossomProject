@extends('layouts.main')
@section('content')
    @inject('commonService', 'App\Http\Services\Order')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Orders history', 'Total order servings'],
                ['Completed orders', <?php
                    if (!empty($total_completed_order)) {
                        echo count($total_completed_order);
                    } else {
                        echo 0;
                    }
                    ?>],
                ['Current Servings', <?php
                    if (!empty($total_inprocess_order)) {
                        echo count($total_inprocess_order);
                    } else {
                        echo 0;
                    }
                    ?>],
            ]);

            var options = {
                title: 'Order Activities',
                is3D: true,

            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data);
        }
    </script>
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
            @if(Auth::check() && Auth::user()->role_id == 1)
                @include('partials.admin_assignment')
            @elseif(Auth::check() && Auth::user()->role_id == 3)
                @include('partials.employee_change_status')
            @endif
        </div>


        @if(isset($order->receiverUser))
            @foreach($order->receiverUser as $receiverinfo)
                <div class="col-md-12">
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    @if($receiverinfo->status == 'smsa_receiver')
                                        The person who is picking up this package from SMSA.
                                    @elseif($receiverinfo->status == 'package_receiver')
                                        The customer who will receive this package.
                                    @endif
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="kt-widget12__desc bbold"> Name</span> <br>
                                    <span>{{isset($receiverinfo->name)?$receiverinfo->name:""}}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="kt-widget12__desc bbold"> phone</span> <br>
                                    <span>{{isset($receiverinfo->phone)?$receiverinfo->phone:""}}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="kt-widget12__desc bbold"> Nation id</span> <br>
                                    <span class="">{{isset($receiverinfo->national_id)?$receiverinfo->national_id:""}}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="kt-widget12__desc bbold"> Information</span> <br>
                                    <span class="">{{isset($receiverinfo->display_stored_information)?$receiverinfo->display_stored_information:""}}</span>
                                </div>
                            </div>
                            <!--end:: Widgets/Company Summary-->
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet kt-portlet--height-fluid">
                    @if(Auth::user()->role_id == 3)
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Order Details({{$order->order_token}})
                                </h3>
                            </div>
                            <div class="kt-portlet__head-label">
                                @if($order->order_status_id == 1)
                                    <img src="{{asset('public/theme-images/new.gif')}}" alt=""/>
                                    <span class="kt-font-danger bbold"> RECEIVED</span>
                                @elseif($order->order_status_id == 2)
                                    <img src="{{asset('public/theme-images/time-left.gif')}}" alt=""/>
                                    <span class="kt-font-danger bbold"> PROCESSING</span>
                                @elseif($order->order_status_id == 3)
                                    <img src="{{asset('public/theme-images/bicycle.gif')}}" alt=""/>
                                    <span class="kt-font-danger bbold"> DELIVER SOON</span>
                                @elseif($order->order_status_id == 4)
                                    <img src="{{asset('public/theme-images/delivered-box.gif')}}" alt=""/>
                                    <span class="kt-font-danger bbold">DELIVERED</span>
                                @else
                                    <img src="{{asset('public/theme-images/time-left.gif')}}" alt=""/>
                                    <span class="kt-font-danger bbold"> PROCESSING</span>
                                @endif

                            </div>
                        </div>
                    @endif
                    <div class="kt-portlet__body">
                        <div class="kt-widget12">
                            <div class="kt-widget12__content">
                                <h4> Order Details</h4>
                                <div class="row line">
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Order Number</span> <br>
                                        <span>{{$order->order_token}}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Placement Date</span> <br>
                                        <span>{{date('Y-m-d', strtotime($order->created_at))}}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Order Status</span> <br>
                                        <span class=""
                                              style="text-transform: capitalize;">

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

{{--                                            {{$order->status->en_title}}--}}


                                        </span>
                                    </div>

                                </div>

                                <h4 style=" padding-top: 10px;"> Payment Method
                                    ({{ $order->cod == 0 ? 'PayTabs' : 'COD'}})</h4>
                                <div class="row ">
                                    @if($order->cod == 0)
                                        <div class="col-md-4">
                                            <span class="kt-widget12__desc bbold">Transaction #</span> <br>
                                            <span>{{$order->transaction_id}}</span>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <span class="kt-widget12__desc bbold">Order #</span> <br>
                                            <span>{{ $order->order_token}}</span>
                                        </div>

                                    @endif
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Transaction Status</span> <br>
                                        <span class="bbold"
                                              @if($order->transaction_status == 'rejected' || $order->transaction_status === 'refunded_pending' || $order->order_status_id == 5 ) style="text-transform: capitalize; color: red"
                                              @else style="text-transform: capitalize; color: green" @endif >
                                                @if($order->transaction_status === 'refunded_pending')
                                                Refund Pending
                                            @else
                                                @if($order->cod != 0 && $order->order_status_id != 4 && $order->order_status_id != 5)
                                                    Pending
                                                @elseif($order->cod != 0 && $order->order_status_id != 4 && $order->order_status_id != 5)
                                                    Succeeded
                                              @elseif($order->cod == 1 && $order->order_status_id == 5)
                                                    Canceled
                                                @elseif($order->cod == 0 && $order->order_status_id == 5)
                                                    Refund
                                                @else
                                                    {{$order->transaction_status}}
                                                @endif
                                            @endif
                                            </span>
                                    </div>
                                    @if(!empty($order->transaction_response_detail))
                                        <div class="col-md-4">
                                            <span class="kt-widget12__desc bbold">Transaction Response</span> <br>
                                            <span class="bbold"
                                                  style="color: red">{{$order->transaction_response_detail}}</span>
                                        </div>
                                    @endif
                                </div>

                                <h4 style=" padding-top: 10px;"> Payment Details</h4>
                                <div class="row ">
                                    {{--                                        <div class="col-md-4">--}}
                                    {{--                                            <span class="kt-widget12__desc bbold"> Transaction#</span> <br>--}}
                                    {{--                                            <span>{{$order->transaction_id}}</span>--}}
                                    {{--                                        </div>--}}
                                    @if($order->cod == 0)
                                        <div class="col-md-4">
                                            <span class="kt-widget12__desc bbold">Card Number</span> <br>
                                            <span>
                                        <img height="20" width="30" src="{{asset('public/theme-images/visa.png')}}">
                                        {{$order->first_4_digits}}********{{$order->last_4_digits}}</span>
                                        </div>
                                    @endif
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Transaction Date</span> <br>
                                        <span>{{date('Y-m-d', strtotime($order->created_at))}}</span>
                                    </div>
                                </div>

                                <h4 style=" padding-top: 10px;"> Customer Details</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold"> Name</span> <br>
                                        <span style="word-break: break-all">{{$order->recipient_first_name}} {{$order->recipient_last_name}}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold">Email</span> <br>
                                        <span style="word-break: break-all">{{$order->recipient_email}}</span>
                                    </div>
                                </div>
                                <div class="row line">
                                    <div class="col-md-8">
                                        <span class="kt-widget12__desc bbold">Number </span> <br>
                                        <span>{{$order->recipient_phone_no}}</span>
                                    </div>
                                </div>
                                <h4 style=" padding-top: 10px;"> Shipping Address</h4>
                                <div class="row">
                                    <div class="col-md-8">
                                        <span class="kt-widget12__desc bbold">Address</span> <br>
                                        <span style="word-break: break-all;">{{ !empty($order->shipping_address->zip_code) ? $order->shipping_address->zip_code : ''}} , {{$order->shipping_address->full_address}} , {{$order->shipping_address->city}}, {{$order->shipping_address->state}}, {{$order->shipping_address->country}}</span>
                                    </div>
                                </div>
                                <h4 style=" padding-top: 10px;"> Billing Address</h4>
                                <div class="row line">
                                    <div class="col-md-8">
                                        <span class="kt-widget12__desc bbold">Address</span> <br>
                                        <span style="word-break: break-all;">{{!empty($order->billing_address->zip_code) ? $order->billing_address->zip_code : ''}} , {{$order->billing_address->full_address}} , {{$order->billing_address->city}}, {{$order->billing_address->state}}, {{$order->billing_address->country}}</span>
                                    </div>
                                </div>

                                <h4 style=" padding-top: 10px;"> Shipping Method Details</h4>
                                <div class="row ">
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold"> Selected Method</span> <br>
                                        <span>SECOM</span>
                                    </div>
                                    @if(is_numeric($order->awb_number))
                                        <div class="col-md-4">
                                            <span class="kt-widget12__desc bbold"> Air Way Bill #</span> <br>
                                            <span>{{$order->awb_number}}</span>
                                        </div>
                                    @endif
                                </div>
                                <h4 style=" padding-top: 10px;"> Shipment Tracking</h4>
                                <div class="row">
                                    @if(is_numeric($order->awb_number))
                                        <div class="col-md-4">
                                            <span class="kt-widget12__desc bbold"> Shipment#</span> <br>
                                            <span>{{$order->awb_number}}</span>
                                        </div>
                                    @endif
                                    <div class="col-md-4">
                                        <span class="kt-widget12__desc bbold"> Activity</span> <br>
                                        <span>{{!empty($order->shipping_details) ? $order->shipping_details : 'N/A'}}</span>
                                    </div>
                                    @if(is_numeric($order->awb_number))
                                        <div class="col-md-4">
                                            <span class="kt-widget12__desc bbold"> Tracking Slip</span> <br>
                                            <a href="{{route('downloadPdf', ['UUID' => $order->uuid])}}"
                                               style=" padding-top: 5px; "> <i
                                                        class="fa fa-file-pdf"></i> {{ $order->order_token}}.pdf</a>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <span class="kt-widget12__desc bbold"> Generate Pdf Slip </span> <br>
                                            <a href="{{route('generatePdfSlip', ['UUID' => $order->uuid])}}"
                                               class="btn btn-success"> Submit shipment to smsa</a>
                                        </div>

                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-invoice-2">
                            <div class="kt-invoice__wrapper">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Order Payment Summary
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-invoice__body kt-invoice__body--centered">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>DESCRIPTION</th>
                                                <th class="text-center">QUANTITY</th>
                                                <th>PRICE</th>
                                                <th>TOTAL AMOUNT</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $subtotal = 0; @endphp
                                            @foreach($order->order_items as $order_item)

                                                @php $subtotal = $subtotal + ($order_item->price * $order_item->quantity); @endphp
                                                <tr>
                                                    <td style="width: 50%;">
                                                        {{$order_item->item->en_title}}
                                                        <br>
                                                        <?php
                                                        $variant = $order_item->item->variants->first();
                                                        ?>
                                                        @if(!empty($variant->size->orientation_unit))
                                                            Size = @if($variant->size->lenght){{$variant->size->lenght}}
                                                            * @endif @if($variant->size->height){{$variant->size->height}}
                                                            * @endif {{$variant->size->width}}
                                                            ({{$variant->size->orientation_unit}})
                                                        @endif
                                                        <br>
                                                        @if(!empty($variant->size->weight))
                                                            Weight = {{$variant->size->weight}}
                                                            ({{$variant->size->weight_unit}})
                                                        @endif
                                                        <br>
                                                        @if($order_item->color_name)
                                                            Color ={{$order_item->color_name}}
                                                        @endif
                                                        @if(!empty($order_item->color_code))
                                                            <span style="margin-top: 5px !important;display:inline-block;vertical-align: middle !important;">
                                                        <div class="kt-badge kt-badge--xl kt-badge--brand"
                                                             style="width: 20px !important;height: 20px !important;background-color: {{$order_item->color_code}} !important;"></div>
                                                       </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{$order_item->quantity}}</td>

                                                    @if($order->order_currency !== 'SAR')
                                                        @if($order_item->price)
                                                            <td> SAR {{$order_item->price}}
                                                                <small>(USD) {{$order_item->converted_price}}</small>
                                                            </td>
                                                        @else
                                                            <td> SAR {{$order_item->item->price}}
                                                                <small>(USD) {{$order_item->converted_price}}</small>
                                                            </td>
                                                        @endif
                                                        <td class="kt-fon-danger">
                                                            SAR {{$order_item->item->price * $order_item->quantity}}
                                                            <small>
                                                                (USD) {{$order_item->converted_price * $order_item->quantity}}</small>
                                                        </td>
                                                    @else
                                                        @if($order_item->price)
                                                            <td> SAR {{$order_item->price}} </td>
                                                            <td class="kt-fon-danger">
                                                                SAR {{$order_item->price * $order_item->quantity}}</td>
                                                        @else
                                                            <td> SAR {{$order_item->item->price}} </td>
                                                            <td class="kt-fon-danger">
                                                                SAR {{$order_item->item->price * $order_item->quantity}}</td>
                                                        @endif
                                                    @endif
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2"></td>
                                                <td class="totalz">
                                                    <strong>SHIPPING COST</strong>
                                                    <br>
                                                    <strong>TAX AMOUNT </strong>
                                                    <br>
                                                    <strong>ORDER TOTAL</strong>
                                                    <br>
                                                    <strong>TOTAL AMOUNT</strong>
                                                </td>
                                                <td class="totalz2">
                                                    <span> SAR {{$order->shipping_amount}}</span>
                                                    <br>
                                                    <span> SAR {{$order->tax_amount}}</span>
                                                    <br>
                                                    <span> SAR {{$subtotal}}</span>
                                                    <br>
                                                    <span> SAR {{$order->total_amount}}</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="kt-invoice__footer">
                                    <div class="kt-invoice__table  kt-invoice__table--centered table-responsive">
                                        <div class="shipping_info">


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .shipping_info {
            display: inline-block;
            text-align: center;
            margin: 0 6% 0 0;
            float: right;
        }

        .shipping_info p {
            font-weight: 500;
            border-bottom-width: 1px;
            padding: .5rem 1rem;
            float: right;
            width: 400px;
            color: #000;
            clear: both;
            text-align: left;
            margin: 0;
            border-top: 1px solid #e6e6e6;
            border-left: 1px solid #e6e6e6;
            border-right: 1px solid #e6e6e6;
        }

        .shipping_info span {
            font-weight: 500;
            float: right;
            width: 50%;
            text-align: left;
        }

        .totalz {
            text-align: right;
        }

        .totalz strong {
            text-align: right;
            display: inline-block;
            margin: 0 0 10px;
        }

        .totalz2 span {
            text-align: left;
            margin: 0 0 10px;
            display: inline-block;
        }

    </style>
@endsection