@extends('layouts.main') 
@section('content')

<div class="kt-content  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-xl-12">
            <!--begin:: Widgets/Finance Summary-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Product Details
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a href="{{route('editItem', ['uid' => $item->uuid])}}" class="btn btn-label-brand btn-bold btn-sm">
                            Edit Product
                        </a>
                        &nbsp;
                        @if($item->is_approved == 0)
                        <a href="{{route('changeItemStatus', ['key' => 'approve','uid' => $item->uuid])}}" class="btn btn-label-brand btn-bold btn-sm">
                            Approve
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <!--begin:: Widgets/Finance Summary-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                {{$item->en_title}}
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-section">
                            <h2 class="kt-section__info">
                                Short Description(EN)
                            </h2>
                            <div class="kt-section__content" style="padding: 20px; margin: 10px 0 30px 0; border: 4px solid #efefef" >
                                <p id="kt_blockui_1_content">
                                    {{ $item->en_short_description }}
                                </p>
                            </div>
                        </div>
                        <div class="kt-section">
                            <h2 class="kt-section__info">
                                Description(EN)
                            </h2>
                            <div class="kt-section__content" style="padding: 20px; margin: 10px 0 30px 0; border: 4px solid #efefef" >
                                <p id="kt_blockui_1_content">
                                    {{ $item->en_description }}
                                </p>
                            </div>
                        </div>
                        <div class="kt-section">
                            <h2 class="kt-section__info">
                                Pricing Details
                            </h2>
                            <div class="kt-section__content">
                                <p style="padding: 20px; margin: 10px 0 30px 0; border: 4px solid #efefef" id="kt_blockui_1_content">
                                    <span style="  font-weight: bold;">Price:</span> <span>{{$item->price}}</span><br>
                                    <span style="  font-weight: bold;">Sale Price Discount / Percentage</span> <span> {{  $item->discount > 0 ?number_format($item->discount, 2):''}}</span>
                                </p>
                            </div>
                        </div>
                        <div class="kt-section">
                            <h2 class="kt-section__info">
                                Stock Details
                            </h2>
                            <div class="kt-section__content">
                                <p style="padding: 20px; margin: 10px 0 30px 0; border: 4px solid #efefef" id="kt_blockui_1_content">
{{--                                    <span style="  font-weight: bold;">Quantity:</span> <span>{{ $item->quantity}}</span><br>--}}
                                    <span style="  font-weight: bold;">Cart Quantity:</span> <span>{{ $item->cart_quantity}}</span><br>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!--begin:: Widgets/Finance Summary-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title" style=" text-align: right;">
                                {{ $item->ar_title }}

                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-section">
                            <h2 class="kt-section__info">
                                Short Description(AR)
                            </h2>
                            <div class="kt-section__content" style="padding: 20px; margin: 10px 0 30px 0; border: 4px solid #efefef">
                                <p  id="kt_blockui_1_content">
                                    {{ $item->ar_short_description }}
                                </p>
                            </div>
                        </div>
                        <div class="kt-section">
                            <h2 class="kt-section__info">
                                Description(AR)
                            </h2>
                            <div class="kt-section__content" style="padding: 20px; margin: 10px 0 30px 0; border: 4px solid #efefef">
                                <p  id="kt_blockui_1_content" >
                                     {{ $item->ar_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.images')
@include('partials.variants')
@include('partials.techSpec')
@include('partials.accessories')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">

        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-file-pdf"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Product Manuals
                </h3>
            </div>
            @if($item->manuals->isEmpty())
            <div class="kt-portlet__head-toolbar">
                <a href="{{route('addManual', ['uid' => $item->uuid])}}" class="btn btn-label-brand btn-bold btn-sm">
                    + New Record
                </a>
            </div>
            @endif

        </div>
        <div class="kt-portlet__body">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>Download</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($item->manuals as $key => $manual)

                    <tr>
                        <td> {{$key+1}}</td>
                        <td> 
                            <a target="_blank"  href="{{config('paths.home_url') . 'manuals/' . $manual->file}}"> <i class="fa fa-file-pdf"> </i> {{$manual->title}} </a>
                        </td>
                        <td>       
                            <a href="{{route('editManual', ['uid' => $manual->uuid])}}" class="btn btn-label-brand btn-bold btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fab fa-youtube"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Technical Videos 
                </h3>
            </div>
            @if($item->videos->isEmpty())
            <div class="kt-portlet__head-toolbar">
                <a href="{{route('addVideo', ['uid' => $item->uuid])}}" class="btn btn-label-brand btn-bold btn-sm">
                    + New Record
                </a>
            </div>
            @endif
        </div>

        <div class="kt-portlet__body">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>Title</th>
                        <th>Content Language</th>
                        <th>Video</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($item->videos as $key => $video)
                    <tr>
                        <td> {{$key+1}}</td>
                        <td> {{$video->title}}</td>
                        <td> {{$video->type}}</td>
                        <td> 
                            <iframe width="420" height="315" src="{{$video->video}}" frameborder="0" allowfullscreen></iframe>
                            <p class="form-text" style=" color: red;">
                                If your video is not showing up. Then you have entered wrong youtube link for the video.
                            </p>
                            <p class="form-text" style=" color: red;" >You must ensure the URL contains embed rather watch as the /embed endpoint allows outside requests, whereas the /watch endpoint does not.
                            </p>
                        </td>
                        <td>       
                            <a href="{{route('editVideo', ['uid' => $video->uuid])}}" class="btn btn-label-brand btn-bold btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection