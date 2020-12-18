<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-paint-brush"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Product Technical Spec Information
                </h3>
            </div>
            @if(!$item->specs->isEmpty())
                <div class="kt-portlet__head-toolbar">
                    <a href="{{route('editTechSpec', ['uid' => $item->id])}}"
                       class="btn btn-label-brand btn-bold btn-sm">
                        Edit
                    </a>
                </div>
            @endif
        </div>

        <div class="kt-portlet__body">

            @if($item->specs->isEmpty())
                <div class="kt-portlet__head-toolbar">
                    <a href="{{route('createTechSpec', ['uid' => $item->uuid, 'page' => 'details'])}}"
                       class="btn btn-label-brand btn-bold btn-sm">
                        Add Technical Spec
                    </a>
                </div>
            @endif

            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                <tr>
                    <th>Technical Specification (English)</th>
                    <th>Value (English)</th>
                    <th>Technical Specification (Arabic)</th>
                    <th>Value (Arabic)</th>
                    <th>Unit</th>
                </tr>
                </thead>

                <tbody>
                
                @foreach($techspec as $key => $spec)
               
                    <tr>
                        <td> {{$spec['title_en']}}</td>
                        <td> {{$spec['value_en']}}</td>
                        <td> {{$spec['title_ar']}}</td>
                        <td> {{$spec['value_ar']}}</td>
                        <td> {{$spec['unit']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
