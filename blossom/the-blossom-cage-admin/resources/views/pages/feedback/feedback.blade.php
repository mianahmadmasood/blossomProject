@extends('layouts.main') 
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-list"></i>
                </span>
                <h3 class="kt-portlet__head-title" style=" text-transform: uppercase;">
                    Users Feedback
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="kt-form kt-form--fit kt-margin-b-20">
                <div class="row kt-margin-b-20">
                    <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                        {{ Form::text('searchTextBox',$searchText,
                                array('name' => 'search', 'id'=>'searchTextBox','class'=>'form-control kt-input','placeholder'=>' E.g: Name=Hamza')) 
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
                        <a href="{{route('feedBack')}}" class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <!--</form>-->
            @if ($feedback->count() > 0)
            <!--begin: Datatable -->
                <div class="tableOuter">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th style="width: 20%;">User Name</th>
                        <th style="width: 30%;">User Email</th>
                        <th style="width: 50%;">Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedback as $key => $message)
                    <tr>
                        <td style="word-break: break-all">{{$message->name}}</td>
                        <td style="word-break: break-all">{{$message->email}}</td>
                        <td style=" word-break: break-all">{{$message->feedback}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
            {{$feedback->links()}}
            <!--end: Datatable -->
            @else
                <p><b> No Data Available </b></p>
            @endif
        </div>
    </div>
</div>
<script></script>
@endsection