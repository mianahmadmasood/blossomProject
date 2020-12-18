@inject('commonService', 'App\Http\Services\Order')
<div class="kt-portlet__body">
    <div class="tab-content">
        <div class="tab-pane active" id="kt_widget3_tab1_content">
            <!--Begin::Timeline 3 -->
            <div class="kt-timeline-v3">
                <div class="kt-timeline-v3__items">

                    @foreach($order->logs as $log)

                        <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                            <span class="kt-timeline-v3__item-time">{{date('h:i', strtotime($commonService->datetimeConvertToAnotherTimezone($log->created_at, 'UTC', 'Asia/Riyadh')))}} </span>
{{--                            <br>--}}
{{--                            <p >{{date('Y-m-d', strtotime($commonService->datetimeConvertToAnotherTimezone($log->created_at, 'UTC', 'Asia/Riyadh')))}} </p>--}}
                            <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                {{$log->comment}}
                                            </span><br>
                                <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
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
            </div>
        </div>
        <!--End::Portlet-->
    </div>
</div>
