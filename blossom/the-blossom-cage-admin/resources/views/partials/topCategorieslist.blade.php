<div class="kt-portlet__body">
    <!--</form>-->
    <!--begin: Datatable -->
    @if ($banners->count() > 0)
        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
            <thead>
            <tr>

                <th>Category</th>
                <th>Sub Category</th>
                <th>Link to product</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="row_position_{{$i}}">
            <?php $counter = 0; ?>
            @foreach($banners as $key => $banner)
                @if($banner->type == $catgorytype)
                    @if(!empty($banner['items']) && !empty($banner['category'])  && !empty($banner['sub_category']) )

                        <?php $counter++; ?>
                        <tr id="{{$banner->id}}" data-value="{{$catgorytype}}">

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

                                    <p class="col-form-label"> Sale Price : {{$banner['items']->sale_price}}</p>
                                        <p class="col-form-label">Orignal Price: {{$banner['items']->price}}</p>
                                    <label class="col-form-label"
                                           style="text-align: left;"> {{$banner['items']->en_title}} </label>
                                @endif

                            </td>

                            <td>
                                @if($banner->archive == 0)
                                    <a href="{{route('updateArchiveBanner', ['uid' => $banner->uuid,'status' => 'in-active','type' => $catgorytype])}}"
                                       class="alterConfirmMassageForTopCategories">
                                        <i class="fa fa-trash">Delete</i>
                                    </a>
                                @else
                                    <a href="{{route('updateArchiveBanner', ['uid' => $banner->uuid,'status' => 'active','type' => $catgorytype])}}"
                                       class="alterConfirmMassageForTopCategoriesActive">
                                        <i class="fa fa-trash">Unarchive</i>
                                    </a>
                                @endif
                                <br>
                                @if($banner->status == 0)
                                    <a href="{{route('updateStatusBanner', ['uid' => $banner->uuid,'status' => 'in-active','type' => $catgorytype])}}">
                                        <i class="la la-trash">Deactive</i>
                                    </a>
                                @else
                                    <a href="{{route('updateStatusBanner', ['uid' => $banner->uuid,'status' => 'active','type' => $catgorytype])}}">
                                        <i class="la la-trash">Active</i>
                                    </a>
                                @endif
                                <br>
                            </td>
                        </tr>
                    @endif
                @endif
            @endforeach
            </tbody>
        </table>
        {{--                {{ $banners->appends(request()->query())->links() }}--}}
    @endif
</div>