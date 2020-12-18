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
                    Home Trendyitem
                </h3>
            </div>
        </div>

        @include('partials.Trendyitems')

        <div class="kt-portlet__body">
            <!--</form>-->
            <!--begin: Datatable -->
            @if ($banners->count() > 0)
                <div class="tableOuter">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>

                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="row_position">
                    @foreach($banners as $key => $banner)

                    <tr id="{{$banner->id}}">
                        

                        <td width="100%">
                            
                            @if(!empty($banner->categories_id))
                                <strong>Category :</strong>
                                <?php
                                $Categorydata = \App\Category::where('id', $banner->categories_id)->first();
                                ?>
                                {{$Categorydata->en_title}}
                                <br>
                            @endif

                            @if(!empty($banner->sub_categories_id))
                                <strong>Sub Category :</strong>
                                <?php
                                $Categorydata = \App\Category::where('id', $banner->sub_categories_id)->first();
                                ?>
                                {{$Categorydata->en_title}}
                                <br>
                            @endif

                            @if(!empty($banner->item_id))
                                <strong>Product :</strong>
                                <?php
                                $Itemdata = \App\Item::where('id', $banner->item_id)->first();
                                ?>
                                {{$Itemdata->en_title}}
                            @endif

                        </td>

                        <td>
                            @if($banner->archive == 0)
                            <a href="{{route('updateArchiveTrendyItem', ['uid' => $banner->uuid,'status' => 'in-active','type' => 'trendy_item'])}}" class="alterConfirmMassageFortrendyitem">
                                <i class="fa fa-trash">Delete</i>
                            </a>
                            @else
                            <a href="{{route('updateArchiveTrendyItem', ['uid' => $banner->uuid,'status' => 'active','type' => 'trendy_item'])}}" class="alterConfirmMassageFortrendyitemActive">
                                <i class="fa fa-trash">Unarchive</i>
                            </a>
                            @endif
                            <br>
                                @if($banner->status == 0)
                            <a href="{{route('updateArchiveTrendyItem', ['uid' => $banner->uuid,'status' => 'in-active','type' => 'trendy_item'])}}" >
                                <i class="la la-trash">Deactive</i>
                            </a>
                            @else
                            <a href="{{route('updateArchiveTrendyItem', ['uid' => $banner->uuid,'status' => 'active','type' => 'trendy_item'])}}" >
                                <i class="la la-trash">Active</i>
                            </a>
                            @endif
                            <br>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
                    {{--                {{ $banners->appends(request()->query())->links() }}--}}
            @endif
        </div>
    </div></div>
<!-- Bootstrap & Core Scripts -->
<script src="{{asset('public/js/sorting/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('public/js/sorting/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/js/homeBannersForOrderPositioning.js')}}"></script>
@endsection