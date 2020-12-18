@extends('layouts.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Warehouse Information Schema
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--fit kt-form--label-right" action="{{route('storeWarehouse')}}"
                          method="POST" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">English Title: <span
                                            style=" color: red;">*</span></label>
                                <div class="col-lg-3">
                                    <input type="text" required class="form-control" placeholder="Enter warehouse title"
                                           name="en_title" maxlength="45">
                                    <span class="form-text text-muted">Please enter warehouse title in English</span>
                                </div>
                                <label class="col-lg-2 col-form-label">Arabic Title:<span style=" color: red;">*</span></label>
                                <div class="col-lg-3">
                                    <input type="text" required class="form-control" placeholder="Enter warehouse title"
                                           name="ar_title" maxlength="45">
                                    <span class="form-text text-muted">Please enter warehouse title in Arabic</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Country: <span
                                            style=" color: red;">*</span></label>
                                <div class="col-lg-3">

                                    <select required style=" width: 100%;"class="js-example-basic-single" id="country" name="country">
                                        @include('partials.countryList')
                                    </select>

                                    <span class="form-text text-muted">Please enter warehouse country</span>
                                </div>

                                <label class="col-lg-2 col-form-label">city: <span
                                            style=" color: red;">*</span></label>
                                <div class="col-lg-3">

                                    <select required style=" width: 100%;"class="js-example-basic-single" id="city" name="city">
                                        <option value="">Select city:</option>
                                        @include('partials.cityList')
                                    </select>

                                    <span class="form-text text-muted">Please enter warehouse city</span>
                                </div>

                            </div>
                            <div class="form-group row">

                                <label class="col-lg-2 col-form-label">Address :</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" placeholder="Enter address"
                                           name="address" maxlength="45">
                                    <span class="form-text text-muted">Please enter warehouse address</span>
                                </div>

                                <label class="col-lg-2 col-form-label">state:</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" placeholder="Enter state"
                                           name="state" maxlength="45">
                                    <span class="form-text text-muted">Please enter warehouse state</span>
                                </div>



                            </div>

                            <div class="form-group row">

                                <label class="col-lg-2 col-form-label">zip code:</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" placeholder="Enter warehouse zip_code"
                                           name="zip_code" maxlength="255">
                                    <span class="form-text text-muted">Please enter warehouse zip_code</span>
                                </div>

                                <label class="col-lg-2 col-form-label">Phone #: </label>
                                <div class="col-lg-3">
                                    <input type="number" class="form-control" placeholder="Enter Phone Number"
                                           name="phone" maxlength="20">
                                    <span class="form-text text-muted">Please enter warehouse phone number </span>
                                </div>

                            </div>
                            <div class="form-group row">

                                <label class="col-lg-2 col-form-label">lat:</label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" placeholder="Enter warehouse lat"
                                           name="lat" maxlength="45">
                                    <span class="form-text text-muted">Please enter warehouse lat</span>
                                </div>

                                <label class="col-lg-2 col-form-label">lng: </label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" placeholder="Enter warehouse lng"
                                           name="lng" maxlength="45">
                                    <span class="form-text text-muted">Please enter warehouse lng</span>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Warehouse Image:</label>
                                <div class="col-lg-3">
                                    <div class="d-flex justify-content-center p-3">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <div class="btn btn-dark">
                                                    <input type="file" class="file-upload" id="file-upload"
                                                           name="warehouse_picture" accept="image/*">
                                                    Upload New Photo
                                                </div>
                                                <span class="form-text text-muted">eg (H:800px X W:800px) – file size  1 to 5MB</span>
                                            </div>

                                        </div>
                                    </div>
                                    <input id="image_name" type="hidden" name="image"/>
                                </div>
                                <label class="col-lg-2 col-form-label">Preview</label>
                                <img id="prevWarehousesImage" style="padding-top: 10px !important;" height="257" width="257"
                                     alt="No Image" src="{{asset('public/theme-images/camera.png')}}"/>
                            </div>

                        </div>
                        <div class="kt-portlet__foot kt-portlet__foot--fit-x">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-8"></div>
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style=" min-width: 400px;">
                <!-- Modal Header -->
                <div class="modal-header" style="padding: 5px">
                    <h4 class="modal-title">Crop Image And Upload</h4>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="resizer"></div>
                    <span style="cursor: pointer;" class="btn rotate float-lef" data-deg="90" >
                    <i class="fas fa-undo"></i></span>
                    <span style="cursor: pointer;" class="btn rotate float-right" data-deg="-90" >
                    <i class="fas fa-redo"></i></span>

                    <button type="button" class="btn btn-block btn-dark" id="upload-warehouse-image" >
                        Crop And Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection