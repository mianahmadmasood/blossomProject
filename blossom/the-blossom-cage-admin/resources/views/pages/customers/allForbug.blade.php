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
                    Customer Listing for bug
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="kt-form kt-form--fit kt-margin-b-20">

            </div>
            <!--</form>-->
            <!--begin: Datatable -->

            @if ($customers->count() > 0)
                <div class="tableOuter">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>bug response Detail</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $key => $customer)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$customer->response}}</td>
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