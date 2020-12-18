<div class="col-md-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if($order->cod != 1 && !empty($order->transaction_id) && $order->transaction_status == 'rejected')
                        Paytab
                    @else
                        Assignment Portal
                    @endif
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body ">
            @if($order->cod != 1 && !empty($order->transaction_id) && $order->transaction_status == 'rejected')
                <div class="row">
                    <div class="col-md-12">
                        <div class="kt-widget12" style=" padding-top: 10px;">

                            <div class="kt-portlet__head-label float-lg-right">
                                <span class="kt-widget12__desc bbold">Transaction # &nbsp; &nbsp;</span>
                                <span class="bbold"
                                      style="text-transform: capitalize;"> {{$order->transaction_id}}</span>
                            </div>
                            <div class="kt-portlet__head-label float-lg-right">
                                <span class="kt-widget12__desc bbold">Transaction Status : &nbsp; &nbsp;</span>
                                <span class="bbold"
                                      style="text-transform: capitalize; color: red"> {{$order->transaction_status}}</span>
                            </div>
                            @if(!empty($order->transaction_response_code))
                                <div class="kt-portlet__head-label float-lg-right">
                                    <span class="kt-widget12__desc bbold">Transaction Detail : &nbsp; &nbsp;</span>
                                    <span class="bbold"
                                          style="text-transform: capitalize; color: red "> {{$order->transaction_response_detail}}</span>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Company Summary-->
            @else
                <div class="row">
                    <div class="col-md-6">
                        <div class="kt-widget12" style=" padding-top: 10px;">

                            <div class="kt-portlet__head-label float-lg-right">
                                <span class="kt-widget12__desc bbold">Order Current Status : &nbsp; &nbsp;</span>
                                <span class="bbold"
                                      style="text-transform: capitalize;"> {{$order->status->en_title}}</span>
                            </div>
                            <br>

                            @if($order->order_status_id !== 4 )
                                <form class="kt-form" action="{{route('changeStatus')}}" method="POST">
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <input type="hidden" value="{{$order->order_status_id}}" name="order_status">
                                    @csrf

                                    @if($order->order_status_id == 1)
                                        <div class="form-group">
                                            <select name="status_id" id="admin_status_id" style=" min-width: 250px;"
                                                    class="js-example-basic-single">
                                                <option value="">Change Status</option>
                                                <option value="2"> Accepted</option>
                                                <option value="5"> Canceled</option>
                                            </select>
                                        </div>
                                    @elseif($order->order_status_id != 5)
                                        <div class="form-group">
                                            <select name="status_id" id="admin_status_id" style=" min-width: 250px;"
                                                    class="js-example-basic-single">
                                                <option value="">Change Status</option>
                                                <option value="5"> Canceled</option>
                                            </select>
                                        </div>
                                    @endif
                                    @if($order->order_status_id == 1 || $order->order_status_id == 2 || $order->order_status_id == 3)
                                        <div class="form-group" id="employee_dropdwon">
                                            <label></label>
                                            <select name="employee_id" id="employee_id"
                                                    style="  min-width: 50px; width: 250px;"
                                                    class="js-example-basic-single3">
                                                <option value=""> Select Employee</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{$employee->id}}">{{$employee->first_name}}
                                                        => {{$employee->phone_no}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    @if($order->order_status_id != 5)
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    @endif
                                </form>
                            @endif

                        </div>
                    </div>
                    <input type="hidden" id="shipping_Status_get_by_order" value="{{$order->id}}">
                    <div class="col-md-6">
                        <div class="kt-widget12" style=" padding-top: 10px;">
                            <div class="kt-portlet__head-label float-lg-right" style="text-align: center;margin-right: 182px;">
                                <span class="kt-widget12__desc bbold">Order Log Status &nbsp; &nbsp;</span>
                            </div>
                            <div id="logsHtml"  class="kt-portlet__body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="kt_widget3_tab1_content">
                                        <!--Begin::Timeline 3 -->
                                        @if($order->order_status_id !== 4  || $order->order_status_id !== 5 )
                                        <div  class="kt-timeline-v3" style="text-align: center;margin-right: 182px;">
                                            <img style="max-width: 80px;height: auto;" height="64" width="160"
                                                 alt="No Image"
                                                 src="{{asset('public/images/ajax-loader.gif')}}">
                                        </div>
                                        @else
                                        <div class="kt-timeline-v3__items">
                                            @foreach($order->logs as $log)
                                                <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                                                    <span class="kt-timeline-v3__item-time">{{date('h:i', strtotime($commonService->datetimeConvertToAnotherTimezone($log->created_at, 'UTC', 'Asia/Riyadh')))}} </span>
                                                    <div class="kt-timeline-v3__item-desc">
                                                                                    <span class="kt-timeline-v3__item-text">
                                                                                        {{$log->comment}}
                                                                                    </span><br>
                                                        <span class="kt-timeline-v3__item-user-name">
                                                                                        <a href="#"
                                                                                           class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                                                            @if($log->user_id == 1 && $log->type == 'shipping')
                                                                                                <span style=" font-weight: bold;">By SMSA </span>
                                                                                            @else
                                                                                                <span style=" font-weight: bold;">By {{$log->user->first_name}}</span>
                                                                                            @endif
                                                                                        </a>
                                                                                    </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @endif

                                    </div>
                                    <!--End::Portlet-->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
</div>

@if(!empty($order->assignment))
    <div class="col-md-12">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Employee Details
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body ">
                <div class="row ">
                    <div class="col-md-3">
                        <div class="kt-widget14">
                            <div class="kt-widget19__userpic">
                                <img style=" max-width: 100px; border-radius: 50px;"
                                     src="{{config('paths.home_url') . config('paths.medium-profiles-thumb') . $order->assignment->employee->image}}"
                                     alt="">
                            </div>
                        </div>
                        <div class="kt-widget14__legends" style=" padding-left: 25px;">

                            <h4 class="card-title">{{$order->assignment->employee->first_name}}</h4>
                            <p class="card-text"><i class="fa fa-envelope"></i>
                                : {{$order->assignment->employee->email}}</p>
                            <p class="card-text"><i class="fa fa-phone"></i>
                                : {{$order->assignment->employee->phone_no}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="kt-widget14">
                            <div class="kt-widget14__header">
                                <h3 class="kt-widget14__title">
                                    Total Orders {{$order->assignment->employee->first_name}} has
                                </h3>
                                <span class="kt-widget14__desc">
                                Total orders => {{ count($total_completed_order) +  count($total_inprocess_order)}} <br>
                                Completed orders => {{ count($total_completed_order)}} <br>
                                In-progress orders => {{ count($total_inprocess_order)}}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="kt-widget14">
                            <div class="kt-widget14__header">
                                <div id="piechart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif