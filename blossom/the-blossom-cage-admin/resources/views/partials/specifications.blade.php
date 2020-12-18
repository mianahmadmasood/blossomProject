<div class="kt-content  kt-grid__item kt-grid__item--fluid ">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-images"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Product Technical Specifications
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body">
            @if($item->specs->isEmpty())
                <div class="kt-portlet__head-toolbar">
                    <a href="{{route('createItemSpecs', ['uid' => $item->uuid])}}" class="btn btn-label-brand btn-bold btn-sm">
                        Add Specification
                    </a>
                </div>
            @endif
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial Id</th>
                        <th>Specification</th>
                        <th>Language</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($item->specs as $key => $spec)
                    <tr>

                        <td> {{$key+1}}</td>
                        <td>  {{ $spec->specifications }} </td>
                        <td>
                            @if($spec->type == 'ar')
                            <span class="kt-badge kt-badge--success kt-badge--inline">Arabic</span>
                            @else
                            <span class="kt-badge kt-badge--warning kt-badge--inline">English</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{route('editItemSpecs', ['uid' => $spec->uuid])}}" class="btn btn-label-brand btn-bold btn-sm">

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
