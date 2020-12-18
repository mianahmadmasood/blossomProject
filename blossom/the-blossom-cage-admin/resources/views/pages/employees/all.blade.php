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
                    Employee Listing
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
                        <a href="{{route('allEmployees')}}" class="btn btn-secondary btn-secondary--icon" id="kt_reset">
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

            @if ($employees->count() > 0)
                <div class="tableOuter">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>Picture</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Order Servings</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $key => $employee)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @if(!empty($employee->image))
                                <img  style="border-radius: 50px;"  src="{{config('paths.home_url') . config('paths.small-profiles-thumb') . $employee->image}}">
                                @else
                                <img  style="border-radius: 50px;" height="86" src="{{asset('public/theme-images/user.png')}}">
                                @endif

                            </td>
                            <td>{{$employee->first_name}}</td>
                            <td>{{$employee->last_name}}</td>
                            <td>{{$employee->phone_no}}</td>
                            <td>{{$employee->email}}</td>
                            <td>
                                @if($employee->assigned_orders_count != 0 )
                                <a href="{{route('showEmployees', ['id' => $employee->uuid])}}" title="View Orders">
                                    Assigned {{$employee->assigned_orders_count}} Orders
                                </a>
                                @endif
                            </td>
                            <td>
                                 @if($employee->assigned_orders_count != 0 )
                                    @if($employee->is_active == 0)
                                        Active
                                    @else
                                        Block
                                    @endif
                                @else
                                    Active
                                @endif
                            </td>

                            <td>
                                <a href="{{route('editEmployee', ['id' => $employee->uuid])}}"class="btn btn-elevate "> <i class="fa fa-edit"></i>Edit Info</a>
                                @if($employee->assigned_orders_count != 0 )
                                @if($employee->is_active == 0)
                                    <a href="{{route('blockEmployee', ['id' => $employee->uuid, 'string' => 'block'])}}"class="btn  btn-elevate alterConfirmMassageForemployee "> <i class="fa fa-trash"></i>Block</a>
                                @else
                                    <a href="{{route('blockEmployee', ['id' => $employee->uuid, 'string' => 'active'])}}"class="btn btn-elevate alterConfirmMassageForemployeeActive  "> <i class="fa fa-user"></i>Active</a>

                                @endif
                                @else
                                    <a href="{{route('blockEmployee', ['id' => $employee->uuid, 'string' => 'delete'])}}"class="btn  btn-elevate alterConfirmMassageForemployeedelete"> <i class="fa fa-trash"></i>Delete</a>
                                @endif
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
                </div>
            {{ $employees->appends(request()->query())->links() }}
            @else
                <p><b> No Data Available </b></p>
            @endif
            <!--end: Datatable -->
        </div>
    </div></div>
<script></script>
@endsection