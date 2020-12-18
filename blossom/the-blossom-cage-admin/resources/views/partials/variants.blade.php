<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-paint-brush"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Product Variant Information
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body">
            @if($item->variants->isEmpty())
            <div class="kt-portlet__head-toolbar">
                <a href="{{route('createVairants', ['uid' => $item->uuid, 'page' => 'details'])}}" class="btn btn-label-brand btn-bold btn-sm">
                    Add Variant
                </a>
            </div>
            @endif
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Serial ID</th>
                        <th>Weight</th>
                        <th>Orientation(lenght * height * width)</th>
                        <th>Color Name(en)</th>
                        <th>Power</th>
                        <th>Color Code</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($item->variants as $key => $variant)
                    <tr>
                        <td> {{$key+1}}</td>
                        <td> {{$variant->size->weight}} - ({{$variant->size->weight_unit}})</td>
                        @if(!empty($variant->size->height) && !empty($variant->size->width) && !empty($variant->size->lenght) )
                            <td> {{$variant->size->lenght}} * {{$variant->size->height}} *  {{$variant->size->width}} - ({{$variant->size->orientation_unit}})</td>
                        @elseif(!empty($variant->size->height) && !empty($variant->size->width) )
                            <td>  {{$variant->size->height}} *  {{$variant->size->width}} - ({{$variant->size->orientation_unit}})</td>
                        @elseif(!empty($variant->size->width) && !empty($variant->size->lenght) )
                            <td> {{$variant->size->lenght}} *  {{$variant->size->width}} -
                                ({{$variant->size->orientation_unit}})
                            </td>
                        @elseif(!empty($variant->size->height)  && !empty($variant->size->lenght) )
                            <td> {{$variant->size->lenght}} * {{$variant->size->height}} -
                                ({{$variant->size->orientation_unit}})
                            </td>
                        @elseif(!empty($variant->size->lenght))
                            <td> {{$variant->size->lenght}} - ({{$variant->size->orientation_unit}})</td>
                        @elseif(!empty($variant->size->height))
                            <td> {{$variant->size->height}} - ({{$variant->size->orientation_unit}})</td>
                        @elseif(!empty($variant->size->width))
                            <td>  {{$variant->size->width}} - ({{$variant->size->orientation_unit}})</td>
                        @else
                        <td> </td>
                        @endif
                        <td>
                            <?php $itemColor=[]; ?>
                            @foreach($item->colors as $row)
                                <?php $itemColor[]= $row->en_color_name ?>
                            @endforeach
                            <?php echo implode(",",$itemColor); ?>
                        </td>
                       @if($variant->item->otherunits)
                        <td>  {{!empty($variant->item->otherunits->value_en) ? $variant->item->otherunits->value_en : ''}} @if(!empty($variant->item->otherunits->unit_en)) ({{ $variant->item->otherunits->unit_en }}) @endif  </td>
                        @else
                            <td></td>
                        @endif
                        <td>
                            @if(!empty($item->colors))
                            @foreach($item->colors as $row)
                                    <span style="border: 1px solid #ccc;background: {{ $row->color_code}} ; margin-top: 5px; width: 40px; "class="kt-badge kt-badge--dark kt-badge--inline kt-badge--pill kt-badge--rounded"></span>
                            @endforeach
                            @endif
                        </td>

                        <td>
                            <a href="{{route('editVariant', ['uid' => $variant->uuid])}}" class="btn btn-label-brand btn-bold btn-sm">
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
