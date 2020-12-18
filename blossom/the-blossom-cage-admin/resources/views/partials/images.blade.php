<div class="kt-content  kt-grid__item kt-grid__item--fluid ">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-images"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Product Images Control
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{route('createImage', ['uid' => $item->uuid])}}" class="btn btn-label-brand btn-bold btn-sm">
                    Add Image
                </a>
            </div>
        </div>

        <div class="kt-portlet__body">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>Preview</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($item->images as $key => $image)
                        @if($image->archive == 0)
                            <tr>

                        <td> {{$key+1}}</td>
                        <td>
                            <img style="width: 86px;height: 86px;" src="{{config('paths.home_url') . config('paths.small-items-thumb') . $image->image}}">
                        </td>
                        <td>
                            @if($image->is_default == 1)
                            Default Image
                            @else
                                <a   href="{{route('imageStatus', ['uid' => $image->uuid, 'status' => 'default'])}}" class="btn btn-label-brand btn-bold btn-sm">
                                Make Default
                            </a>
                            @endif
                        </td>
                        <td>
                            @if($image->archive == 0) 
                            @if($image->is_default == 0) 
                            <a href="{{route('imageStatus', ['uid' => $image->uuid, 'status' => 'block'])}}"  class="btn btn-label-brand btn-bold btn-sm alterConfirmMassage">
                                Remove
                            </a>
                            @endif
                            @else
                            <a href="{{route('imageStatus', ['uid' => $image->uuid, 'status' => 'active'])}}" class="btn btn-label-brand btn-bold btn-sm">
                                Active
                            </a>
                            @endif
                        </td>
                    </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
