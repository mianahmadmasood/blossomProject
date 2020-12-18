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
                        Top Sale Products For Home
                    </h3>
                </div>
            </div>

            @include('partials.topsaleItem')

            <div class="kt-portlet__body">
                <!--</form>-->
                <!--begin: Datatable -->
                {{--            {{dd($banners['items'])}}--}}
                @if ($banners->count() > 0 )
                    <div class="tableOuter">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Link to product</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="row_position">
                        @foreach($banners as $key => $banner)

                            @if(!empty($banner['items']) && !empty($banner['category'])  && !empty($banner['sub_category']) )
                                <tr id="{{$banner->id}}" data-value="top_sales">
                                    <td>
                                        @if(!empty($banner->categories_id))
                                            {{$banner['category']->en_title}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($banner->sub_categories_id))
                                            {{$banner['sub_category']->en_title}}
                                        @endif
                                    </td>

                                    <td width="100%">
                                        @if(!empty($banner->item_id))
                                            <?php
                                            $ItemIamageData = \App\ItemImage::where('item_id', $banner->item_id)->first();
                                            ?>

                                            @if(!empty($ItemIamageData->image))
                                                <img style="float: left;margin: 0 10px 0 0;" height="80" width="80"
                                                     src="{{config('paths.home_url')}}thumbnails/large/items/{{$ItemIamageData->image}}">
                                            @else
                                                <img style="float: left;margin: 0 10px 0 0;" height="80" width="80"
                                                     src="{{config('paths.home_url')}}thumbnails/large/categories/Category_5daf2155ba6481571758421.jpg">
                                            @endif
                                            <p class="col-form-label"> Sale Price : {{$banner['items']->sale_price}}
                                                </p>
                                                <p class="col-form-label" style="margin-bottom: 18px;">
                                                Orignal Price : {{$banner['items']->price}}</p>
                                            <label class="col-form-label"
                                                   style="text-align: left;"> {{$banner['items']->en_title}} </label>
                                        @endif

                                    </td>

                                    <td>
                                        @if($banner->archive == 0)
                                            <a href="{{route('updateArchiveBanner', ['uid' => $banner->uuid,'status' => 'in-active','type' => 'top_sales'])}}"
                                               class="alterConfirmMassageForTopSaleItem">
                                                <i class="fa fa-trash">Delete</i>
                                            </a>
                                        @else
                                            <a href="{{route('updateArchiveBanner', ['uid' => $banner->uuid,'status' => 'active','type' => 'top_sales'])}}"
                                               class="alterConfirmMassageForTopSaleItemActive">
                                                <i class="fa fa-trash">Unarchive</i>
                                            </a>
                                        @endif
                                        <br>
                                        @if($banner->status == 0)
                                            <a href="{{route('updateStatusBanner', ['uid' => $banner->uuid,'status' => 'in-active','type' => 'top_sales'])}}">
                                                <i class="la la-trash">Deactive</i>
                                            </a>
                                        @else
                                            <a href="{{route('updateStatusBanner', ['uid' => $banner->uuid,'status' => 'active','type' => 'top_sales'])}}">
                                                <i class="la la-trash">Active</i>
                                            </a>
                                        @endif
                                        <br>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    {{--                {{ $banners->appends(request()->query())->links() }}--}}
                @endif
            </div>
        </div>
    </div>
    <!-- Bootstrap & Core Scripts -->
    <script src="{{asset('public/js/sorting/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/js/sorting/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/js/homeBannersForOrderPositioning.js')}}"></script>
@endsection