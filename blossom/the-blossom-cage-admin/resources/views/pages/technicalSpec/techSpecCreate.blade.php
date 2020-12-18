@extends('layouts.main')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{route('editItem', ['uid' => $id])}}" class="kt-subheader__breadcrumbs-link">
                        Saved Item
                    </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        Add Variants
                    </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        Add Technical Spec
                    </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        Add Meta Data
                    </a>

                </div>

            </div>
        </div>

        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Item Technical Specification Information Schema
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form id="techspec_form" class="kt-form kt-form--fit kt-form--label-right"
                              action="{{route('storeTechSpecData')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="item_id" value="{{$id}}">
                            <div class="kt-portlet__body">
                                <div class="form-group row row_1">
                                    <div class="col-lg-3">
                                        <label class="col-form-label">Technical Specification(en)</label>
                                        <input type="text" class="form-control" placeholder="Enter Technical Specification"
                                               name="techspecs[1][specs_en]" id="specs_en" value="{{ old('specs_en') }}">
                                        <span class="form-text text-muted">Please enter item technical specification in English</span>
                                        <span id="specs_en_message"  class="form-text text-muted" style="color: red !important"></span>
                                    </div>
                                    <div class="col-lg-1">
                                        <label class="col-form-label">value(en)</label>
                                        <input  type="text" class="form-control"
                                               name="techspecs[1][specs_value_en]"  id="specs_value_en">
                                        <span id="specs_value_en_message"  class="form-text text-muted" style="color: red !important"></span>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="col-form-label">Technical Specification(ar)</label>
                                        <input type="text" class="form-control" placeholder="Enter Technical Specification"
                                               name="techspecs[1][specs_ar]" id="specs_ar" value="{{ old('specs_ar') }}">
                                        <span class="form-text text-muted">Please enter item technical specification in Arabic</span>
                                        <span id="specs_ar_message" class="form-text text-muted" style="color: red !important"></span>
                                    </div>
                                    <div class="col-lg-1">
                                        <label class="col-form-label">Value(ar)</label>
                                        <input  type="text" class="form-control"
                                               name="techspecs[1][specs_value_ar]"  id="specs_value_ar">
                                        <span id="specs_value_ar_message"  class="form-text text-muted" style="color: red !important"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="col-form-label">Units</label>
                                        <select id="spec_unit"  class=" form-control js-example-basic-single"  name="techspecs[1][unit]" >
                                            <option value="">Select Unit</option>
                                           <option value="Annual energy consumption-kWh/annum-استهلاك الطاقة السنوي-كيلوواط ساعة / سنة"> kWh/annum - كيلوواط ساعة / سنة</option>
                                        <option value="Sound power level-dB(A)-درجة قوة الصوت-ديسيبل (أ)"> dB(A)-ديسيبل (أ)</option>
                                        <option value="Cable length-(m)/ plug type-طول السلك-(م) / نوع المكونات"> (m)/ plug type - (م) / نوع المكونات</option>
                                        <option value="Volt/frequency-v/hz-فولت / تردد-فولت / تردد"> v/hz	فولت / تردد-</option>
                                        <option value="Protection class / ip protection-w-فئة الحماية / حماية الملكية الفكرية-دبليو"> W	دبليو-</option>
                                        <option value="Vacuum at nozzle-Kpa-فراغ في فوهة -كبا"> Kpa-كبا-</option>
                                        <option value="Main filter area-cm²-منطقة التصفية الرئيسية -سم²">cm²-سم²</option>
                                        <option value="Length x width x height-cm-الطول × العرض × الارتفاع -سم">cm-سم</option>
                                        <option value="Weight-kg-وزن -كلغ">kg-كلغ</option>
                                        <option value="Weight-OZ / Gram-وزن -اوز / جرام">OZ / Gram	اوز / جرام-</option>
                                        <option value="watt-w-واط-ث"> watt(w) - واط</option>
                                        <option value="horsepower-hp-قوة حصان-حصان"> hp  - قوة حصان</option>
                                        <option value="Liter Per Second-l/sec-لتر في الثانية-لتر/ثانية"> l/sec -  لتر في الثانية</option>
                                        <option value="pascal-pa-باسكال-باسكال"> Pa - باسكال</option>
                                        <option value="kilopascal-kpa-كيلوباسكال-كيلوباسكال"> kPa - كيلوباسكال</option>
                                        <option value="litre-litre-لتر-ل"> l -  لتر</option>
                                        <option value="meter-m-متر-م"> m -  متر</option>
                                       
                                        <option value="Ø mm-Ø mm-Ø مم-Ø مم"> Ø mm -  Ø مم</option>
                                        <option value="no.- no.-.لا.- لا">  no. -   .لا</option>
                                        <option value="Rpm-Rpm-دورة في الدقيقة-دورة في الدقيقة"> Rpm -  دورة في الدقيقة</option>
                                        <option value="Orb / Min-Orb / Min-الجرم السماوي / دقيقة-الجرم السماوي / دقيقة"> Orb / Min - الجرم السماوي / دقيقة</option>
                                        <option value="ML-ML-مل-مل"> ML - مل</option>
                                        <option value="V-V-الجهد االكهربى-الجهد االكهربى"> V - الجهد االكهربى</option>
                                        <option value="HZ-HZ-هرتز-هرتز"> HZ - هرتز</option>
                                        <option value="mm-mm-مم-مم"> mm - مم</option>

                                        </select>
                                        <span id="specs_unit_message"  class="form-text text-muted" style="color: red !important"></span>
                                    </div>

                                    <input type="hidden" id="counter" value="2">
                                    <div class="col-lg-2">
                                        <button id="submit_tech_spec_add" style="margin-top: 25%" type="button" class="btn btn-success">Add more
                                        </button>
                                    </div>
                                </div>
                                <div id="rowAppended"></div>
                                <div class="row float-right">
                                    <div class="col-lg-10"></div>
                                    <button id="submit_tech_spec" type="button" class=" col-lg-2 btn btn-success ">
                                        Submit & Continue
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.js-example-basic-single').select2();
    </script>
@endsection