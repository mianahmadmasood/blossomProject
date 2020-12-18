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
                    Customer Listing
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="kt-form kt-form--fit kt-margin-b-20">
                <div class="row kt-margin-b-20">
                    <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                        {{ Form::text('searchTextBox',$searchText,
                                array('name' => 'search', 'id'=>'searchTextBox','class'=>'form-control kt-input','placeholder'=>' E.g: name=john')) 
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
                        <a href="{{route('allCustomers')}}" class="btn btn-secondary btn-secondary--icon" id="kt_reset">
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

            @if ($customers->count() > 0)
                <div class="tableOuter">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Orders Detail</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $key => $customer)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @if(!empty($customer->image))
                                <img  style="border-radius: 50px;"  src="{{config('paths.home_url') . config('paths.small-profiles-thumb') . $customer->image}}">
                                @else
                                <img  style="border-radius: 50px;" height="86" src="{{asset('public/theme-images/user.png')}}">
                                @endif
                                {{$customer->first_name}}
                            </td>
                            <td>{{$customer->last_name}}</td>
                            <td>{{$customer->phone_no}}</td>
                            <td>{{$customer->email}}</td>
                            <td>
                                @if($customer->customer_orders_count != 0 )
                                <a href="{{route('showCustomers', ['id' => $customer->uuid,'type' => 'all'])}}" title="View Orders">
                                    Detail {{$customer->customer_orders_count}} Orders
                                </a>
                                @endif
                            </td>

                        </tr>

                    @endforeach
                </tbody>
            </table>
                </div>
            {{ $customers->appends(request()->query())->links() }}
            @else
                <p><b> No Data Available </b></p>
            @endif
            <!--end: Datatable -->
        </div>
    </div></div>
<script></script>
@endsection