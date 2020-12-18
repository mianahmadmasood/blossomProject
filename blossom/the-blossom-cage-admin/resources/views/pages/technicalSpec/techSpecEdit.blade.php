@extends('layouts.main')
@section('content')
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                <i class=" fa fa-edit"></i>Edit Technical Specification
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form id="techspec_form" class="kt-form kt-form--fit kt-form--label-right" action="{{route('updateTechSpec')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="item_id" value="{{$item_id}}">
                        <div class="kt-portlet__body">
                            <div class="form-group row row_1">
                                <div class="col-lg-3">
                                    <label class="col-form-label">Technical Specification(en)<span style=" color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Technical Specification"
                                           name="techspecs[1][specs_en]" id="specs_en" value="{{ old('specs_en') }}">
                                    <span class="form-text text-muted">Please enter item technical specification in English</span>
                                    <span id="specs_en_message"  class="form-text text-muted" style="color: red !important"></span>
                                </div>
                                <div class="col-lg-1">
                                    <label class="col-form-label">value(en)<span style=" color: red;">*</span></label>
                                    <input type="text" class="form-control"
                                           name="techspecs[1][specs_value_en]"  id="specs_value_en">
                                    <span id="specs_value_en_message"  class="form-text text-muted" style="color: red !important"></span>
                                </div>
                                <div class="col-lg-3">
                                    <label class="col-form-label">Technical Specification(ar)<span style=" color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Technical Specification"
                                           name="techspecs[1][specs_ar]" id="specs_ar" value="{{ old('specs_ar') }}">
                                    <span class="form-text text-muted">Please enter item technical specification in Arabic</span>
                                    <span id="specs_ar_message" class="form-text text-muted" style="color: red !important"></span>
                                </div>
                                <div class="col-lg-1">
                                    <label class="col-form-label">Value(ar)<span style=" color: red;">*</span></label>
                                    <input type="text" class="form-control"
                                           name="techspecs[1][specs_value_ar]"  id="specs_value_ar">
                                    <span id="specs_value_ar_message"  class="form-text text-muted" style="color: red !important"></span>
                                </div>
                                <div class="col-md-2">
                                    <label class="col-form-label">Units</label>
                                    <select id="spec_unit"  class="js-example-basic-single form-control"  name="techspecs[1][unit]" >
                                        <option value="">Select Unit</option>
                                        <option value="Annual energy consumption-kWh/annum-استهلاك الطاقة السنوي-كيلوواط ساعة / سنة"> kWh/annum - كيلوواط ساعة / سنة</option>   
                                        <option value="Sound power level-dB(A)-درجة قوة الصوت-ديسيبل (أ)"> dB(A)-ديسيبل (أ)</option>
                                        <option value="Cable length-(m)/ plug type-طول السلك-(م) / نوع المكونات"> (m)/ plug type - (م) / نوع المكونات</option>
                                        <option value="Volt/frequency-v/hz-فولت / تردد-فولت / تردد"> v/hz	فولت / تردد-</option>
                                        <option value="Protection class / ip protection-w-فئة الحماية / حماية الملكية الفكرية-دبليو"> W	دبليو-</option>
                                        <option value="Vacuum at nozzle-Kpa-فراغ في فوهة -كبا"> Kpa-كبا</option>
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
                                <div class="col-lg-2">
                                    <button id="submit_tech_spec_add" style="margin-top: 25%" type="button" class="btn btn-success">Add more
                                    </button>
                                </div>
                            </div>
                            @if(!empty($techspec))
                                <?php $count =1;  ?>
                            @foreach($techspec as $row)
                            <?php $count++; ?>
                            <div class="form-group description_text row row_{{$count}}">

                                @if(!empty($row['id_en']))
                                    <input type="hidden" id="specIden" name="techspecs[{{$count}}][specIden]" value="{{$row['id_en']}}">
                                @endif
                                @if(!empty($row['id_ar']))
                                    <input type="hidden" id="specIdar" name="techspecs[{{$count}}][specIdar]" value="{{$row['id_ar']}}">
                                @endif
                                <div class="col-lg-3">
                                    <input type="text" class="form-control"
                                           name="techspecs[{{$count}}][specs_en]" id="specs_en" value="{{!empty($row['title_en'])?$row['title_en']:''}}">
                                </div>
                                <div class="col-lg-1">
                                    <input type="text" class="form-control"
                                           name="techspecs[{{$count}}][specs_value_en]"  value="{{!empty($row['value_en'])?$row['value_en']:''}}" id="specs_value_en">
                                 </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control"
                                           name="techspecs[{{$count}}][specs_ar]" id="specs_ar" value="{{!empty($row['title_ar'])?$row['title_ar']:''}}" >
                                 </div>
                                <div class="col-lg-1">
                                    <input type="text"  class="form-control"
                                           name="techspecs[{{$count}}][specs_value_ar]"  value="{{!empty($row['value_ar'])?$row['value_ar']:''}}" id="specs_value_ar">
                                </div>
                                <div class="col-md-2">
                                    <select  class="js-example-basic-single form-control"  name="techspecs[{{$count}}][unit]" >
                                        <option value="">Select Unit</option>

                                        <option value="Energy efficiency class-ec-فئة كفاءة الطاقة-ث" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Energy efficiency class') selected @endif> EC - ث</option>
                                        <option value="Annual energy consumption-kWh/annum-استهلاك الطاقة السنوي-كيلوواط ساعة / سنة" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Annual energy consumption') selected @endif> kWh/annum - كيلوواط ساعة / سنة</option>
                                        <option value="Dust pick up on carpet-d-التقاط الغبار على السجادة-د" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Dust pick up on carpet') selected @endif > D - د</option>
                                        <option value="Dust re-emission class-g-فئة إعادة انبعاث الغبار-ز" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Dust re-emission class') selected @endif > G - ز</option>
                                        <option value="Sound power level-dB(A)-درجة قوة الصوت-ديسيبل (أ)" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Sound power level') selected @endif > dB(A)-ديسيبل (أ)</option>
                                        <option value="Cable length-(m)/ plug type-طول السلك-(م) / نوع المكونات" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Cable length') selected @endif > (m)/ plug type - (م) / نوع المكونات</option>
                                        <option value="Volt/frequency-v/hz-فولت / تردد-فولت / تردد" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Volt/frequency') selected @endif > v/hz	فولت / تردد-</option>
                                        <option value="Protection class / ip protection-w-فئة الحماية / حماية الملكية الفكرية-دبليو" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Protection class / ip protection') selected @endif > W	دبليو-</option>
                                        <option value="Vacuum at nozzle-Kpa-فراغ في فوهة -كبا" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Vacuum at nozzle') selected @endif > Kpa-كبا</option>
                                        <option value="Main filter area-cm²-منطقة التصفية الرئيسية -سم²" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Main filter area') selected @endif >cm²-سم²</option>
                                        <option value="Length x width x height-cm-الطول × العرض × الارتفاع -سم" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Length x width x height') selected @endif >cm-سم</option>
                                        <option value="Weight-kg-وزن -كلغ" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Weight') selected @endif >kg-كلغ</option>
                                        <option value="Weight-OZ / Gram-وزن -اوز / جرام" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Weight') selected @endif >OZ / Gram	اوز / جرام-</option>                                        
                                        <option value="watt-w-واط-ث" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'watt') selected @endif> watt(w) - واط</option>
                                        <option value="horsepower-hp-قوة حصان-حصان" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'horsepower') selected @endif> horsepower(hp)  - قوة حصان</option>
                                        <option value="Liter Per Second-l/sec-لتر في الثانية-لتر/ثانية" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Liter') selected @endif> Liter Per Second (l/sec) -  لتر في الثانية</option>
                                        <option value="pascal-pa-باسكال-باسكال" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'pascal') selected @endif> pascal (Pa) - باسكال</option>
                                        <option value="kilopascal-kpa-كيلوباسكال-كيلوباسكال" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'kilopascal') selected @endif> kilopascal (kPa) - كيلوباسكال</option>
                                        <option value="decibel-dB(A)-ديسيبل-ديسيبل" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'decibel') selected @endif> kilopascal (dB(A)) -  ديسيبل</option>
                                        <option value="litre-litre-لتر-ل" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'litre') selected @endif> litre (l) -  لتر</option>
                                        <option value="meter-m-متر-م" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'meter') selected @endif> meter (m) -  متر</option>
                                        <option value="centimetre-cm-سنتيمتر-سم" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'centimetre') selected @endif> centimetre (cm) -  سم</option>
                                        <option value="kilogram-kg-كيلوغرام-كلغ" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'kilogram') selected @endif> kilogram (kg) -  كيلوغرام</option>
                                        <option value="second-s-ثانيا-ثانية" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'second') selected @endif> second (s) -  ثانيا</option>
                                        <option value="Ø mm-Ø mm-Ø مم-Ø مم" @if(!empty($row['desp_unit']) && $row['desp_unit'] == ' Ø mm') selected @endif> Ø mm -  Ø مم</option>
                                        <option value="no.- no.-.لا.- لا" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'no.') selected @endif>  no. -   .لا</option>
                                        <option value="Rpm-Rpm-دورة في الدقيقة-دورة في الدقيقة" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Rpm') selected @endif> Rpm -  دورة في الدقيقة</option>
                                        <option value="Orb / Min-Orb / Min-الجرم السماوي / دقيقة-الجرم السماوي / دقيقة" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'Orb / Min') selected @endif> Orb / Min - الجرم السماوي / دقيقة</option>
                                        <option value="ML-ML-مل-مل" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'ML') selected @endif> ML - مل</option>
                                        <option value="V-V-الجهد االكهربى-الجهد االكهربى" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'V') selected @endif > V - الجهد االكهربى</option>
                                        <option value="HZ-HZ-هرتز-هرتز" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'HZ') selected @endif> HZ - هرتز</option>
                                        <option value="mm-mm-مم-مم" @if(!empty($row['desp_unit']) && $row['desp_unit'] == 'mm') selected @endif> mm - مم</option>
                                    </select>
                                </div>
                                <div class="row col-lg-2">
                                    <input type="hidden" id="specIdremove_{{$count}}" name="techspecs[{{$count}}][specIdremove]" value="{{$row['id_en']}}-{{$row['id_ar']}}">
                                    <span  class="remove_spec_row"  data-value="{{$count}}" style=" margin-top: 5%;margin-left: 35%;cursor: pointer;"> X </span>
                                </div>
                            </div>
                            @endforeach
                            <input type="hidden" id="counter" value="{{$count + 1}}">
                            @endif
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