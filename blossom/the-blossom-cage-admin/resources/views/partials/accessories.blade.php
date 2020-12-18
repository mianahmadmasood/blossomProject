<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-paint-brush"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Product Accessories Information
                </h3>
            </div>

        </div>

        <div class="kt-portlet__body">

            <form id="itemAccessoires_form" class="kt-form kt-form--fit kt-form--label-right"
                  action="{{route('storeItemAccessories')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="item_uuid" value="{{$item->uuid}}">

                <div class="form-group row">


                    <div class="col-md-3">
                        <span class="form-text">Accessories</span>
                        <select required style=" width: 100%;" class="js-example-basic-single-itemAccessories"
                                id="accessories_id" name="accessories_id">
                            <option value="">Select Accessories</option>
                            @foreach($accessories as $row)
                                <option value="{{$row->id}}">{{$row->en_title}} - {{$row->ar_title}}</option>
                            @endforeach
                        </select>
                        <span class="form-text text-muted">Please Select Accessories</span>
                        <span id="itemAss_message" class="form-text"
                              style=" color: red;  display: none;"></span>
                    </div>
                    <div class="col-md-3" style="text-align: center;">
                        <span class="form-text" style="text-align: center;">Must Purchase</span>
                        <input id="accessories_status" type="checkbox" style="margin-top: 15px;"
                               name="accessories_status">
                    </div>

                    <div class="col-md-3 ">
                        <button id="submit_form_itemAccessories" type="submit" style="margin-top: 20px;" class="btn btn-success">Save
                        </button>
                    </div>
                </div>
            </form>

            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                <tr>
                    <th>Serial ID</th>
                    <th>Accessories</th>
                    <th>Must Purchase</th>
                    <th>Action</th>

                </tr>
                </thead>

                <tbody>


                @foreach($item->itemAccessories as $key => $itemAccessorie)
                    <?php
                    $itemAccessorie_data = \App\Accessories::where('id', $itemAccessorie->accessories_id)->first();
                    ?>
                    <tr>
                        <td> {{$key+1}}</td>
                        <td>  {{ $itemAccessorie_data->en_title }} </td>
                        @if($itemAccessorie->accessories_status == 1)
                            <td> mandatory</td>
                        @else
                            <td> optional</td>
                        @endif
                        <td>
                        @if($itemAccessorie->archive == 0)
                            <a href="{{route('updateStatusitemAccessorie', ['uid' => $itemAccessorie->uuid,'status' => 'in-active'])}}" class="alterConfirmMassageForItemAccessories">
                                <i class="fa fa-trash">Delete</i>

                            </a>
                        @else
                            <a href="{{route('updateStatusitemAccessorie', ['uid' => $itemAccessorie->uuid,'status' => 'active'])}}" class="alterConfirmMassageForItemAccessoriesActive">
                                <i class="fa fa-trash">Unarchive</i>
                            </a>
                        @endif
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $('.js-example-basic-single-itemAccessories').select2();
    });

</script>
