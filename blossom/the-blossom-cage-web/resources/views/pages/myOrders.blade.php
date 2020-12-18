@extends('layouts.item_listing')
@section('content')
@inject('paths', 'App\Http\Services\Profile')
<section class="Profilepage">
    <div class="container">
        <div class="row">
            @include('partials.pagesSideMenu')
            <div class="col-md-9">
                @include('partials.messages')
                <div class="Box_right">
                    <div class="MenuBox">
                        <p><i class="icon icon-user"></i> {{ __('localization.my_orders')}}</p>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div><!--MenuBox-->
                    <div class="cProfile">
                        <div class="eHead">
                            <h3> {{ __('localization.order_history')}}</h3>
                            <p> {{ __('localization.order_desc')}}</p>
                        </div>
                        <div class="box1 OrdersBox">
                            <div class="table-responsive">
                                @if(!empty($response['data']['orders']))
                                <table class="table table-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th> {{ __('localization.order_id')}}</th>
                                            <th> {{ __('localization.date')}}</th>
                                            <th> {{ __('localization.status')}}   </th>
                                            <th> {{ __('localization.total_amount')}}</th>
                                            <th> {{ __('localization.action')}}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($response['data']['orders'] as $order)
                                        <tr>
                                            <td><i>Order ID</i>{{$order['order_id']}}</td>
                                            <td><i>Date</i>{{$order['date']}}</td>
                                            @if($order['status_id'] == 1)
                                            <td><i>Status</i><span class="sucess"> {{ __('localization.received')}}</span></td>
                                            @elseif($order['status_id'] == 2)
                                            <td><i>Status</i><span class="sucess"> {{ __('localization.processing')}}</span></td>
                                            @elseif($order['status_id'] == 3)
                                            <td> <i>Status</i><span class="sucess"> {{ __('localization.dispatched')}}</span></td>
                                            @elseif($order['status_id'] == 4)
                                            <td> <i>Status</i><span class="sucess">  {{ __('localization.delivered')}}</span></td>
                                            @elseif($order['status_id'] == 5)
                                            <td> <i>Status</i><span class="sucess" style=" background-color: red !important;">  {{ __('localization.canceled')}}</span></td>
                                            @elseif($order['status_id'] == 6)
                                                <td> <i>Status</i><span class="sucess" style=" background-color: red !important;">  {{ __('localization.rejected')}}</span></td>
                                            @endif
                                            <td> {{$order['order_currency']}} {{$order['converted_total_amount']}}</td>
                                            <td><a class="viewdet" href="{{route('orderDetails', ['lang' => App::getLocale(), 'uuid' => $order['uuid']])}}"> {{ __('localization.view_detail')}}</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <p class="no-orders">{{ __('localization.no_orders')}}</p>
                                @endif
                            </div>
                        </div>
                    </div><!--cProfile-->
                </div><!--Box_right-->
            </div>
        </div><!--row-->

        <?php
        $totaldata = $response['data']['count'];
        $limit = $response['data']['count'] / 10;

        if ($limit > !1) {
            $limit = ceil($limit);
        }

        $url = URL::current();
        $params = Request::except('page_no');
        $request_params = Request::all();

        if (!empty($params)) {
            $url = $url . '?' . urldecode(http_build_query($params));
        }
        if (!empty($params)) {
            $url = $url . '&';
        } else {
            $url = $url . '?';
        }
        ?>

        <?php

        $page_no = !empty($request_params['page_no']) ? (int)$request_params['page_no'] : 1;
        $total_records_per_page = 3;
        $offset = ($page_no - 1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";
        $total_records = $totaldata / 10;
        $total_no_of_pages = ceil($total_records);
        $second_last = $total_no_of_pages - 1; // total page minus 1

        ?>

        <div class="LoadMore2 mt-4">
            <a class="LeftICO" <?php if ($page_no <= 1) {
                echo "class='disabled'";
            }  if($page_no > 1){ ?>  href="{{$url}}page_no={{$previous_page}}" <?php  } ?> ><img
                    src="{{asset('public/assets/images/angle_left.png')}}"></a>

            <?php
            if ($total_no_of_pages <= 10){
            for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
            if ($counter == $page_no) {
            ?>
            <a id='pagination' style='font-size: larger;color: #8D8D8D;' class='active'
               href="{{$url}}page_no={{$counter}}">{{$counter}}</a>

            <?php
            }else{
            ?>
            <a id='pagination' href="{{$url}}page_no={{$counter}}">{{$counter}}</a>
            <?php
            }
            }
            }
            elseif($total_no_of_pages > 10){

            if($page_no <= 4) {
            for ($counter = 1; $counter < 8; $counter++){
            if ($counter == $page_no) {
            ?>
            <a id='pagination' style='font-size: larger;color: #8D8D8D;' class='active'
               href="{{$url}}page_no={{$counter}}">{{$counter}}</a>
            <?php
            }else{
            ?>
            <a id='pagination' href="{{$url}}page_no={{$counter}}">{{$counter}}</a>
            <?php
            }
            }
            ?>
            <span onclick='return false;'>...</span>
            <a id='pagination' href="{{$url}}page_no={{$second_last}}">{{$second_last}}</a>
            <a id='pagination' href="{{$url}}page_no={{$total_no_of_pages}}">{{$total_no_of_pages}}</a>
            <?php
            }

            elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
            ?>
            <a id='pagination' href="{{$url}}page_no=1">1</a>
            <a id='pagination' href="{{$url}}page_no=2">2</a>
            <span onclick='return false;'>...</span>

            <?php
            for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
            if ($counter == $page_no) {
            ?>
            <a id='pagination' style='font-size: larger;color: #8D8D8D;' class='active'
               href="{{$url}}page_no={{$counter}}">{{$counter}}</a>

            <?php
            }else{
            ?>
            <a id='pagination' href="{{$url}}page_no={{$counter}}">{{$counter}}</a>
            <?php
            }
            }
            ?>
            <span onclick='return false;'>...</span>
            <a id='pagination' href="{{$url}}page_no={{$second_last}}">{{$second_last}}</a>
            <a id='pagination' href="{{$url}}page_no={{$total_no_of_pages}}">{{$total_no_of_pages}}</a>
            <?php
            }

            else {
            ?>
            <a id='pagination' href="{{$url}}page_no=1">1</a>
            <a id='pagination' href="{{$url}}page_no=2">2</a>
            <span onclick='return false;'>...</span>

            <?php
            for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                if ($counter == $page_no) {
                    echo "<a id='pagination' style='font-size: larger;color: #8D8D8D;' class='active' href=" . $url . 'page_no=' . $counter . " >$counter</a>";
                } else {
                    echo "<a id='pagination'  href=" . $url . 'page_no=' . $counter . ">$counter</a>";
                }
            }
            }
            }
            ?>
            <a class="RightICO"
               <?php if($page_no < $total_no_of_pages) { ?> href="{{$url}}page_no={{$next_page}}" <?php } ?>><img
                    src="{{asset('public/assets/images/angle_right.png')}}"></a>
        </div>




    </div>
</section><!--Profilepage-->
@endsection
