<?php
$flag = false;

$items = Session::get('items');
$itemeditcolor=Session::get('itemColorEdit');
if (!empty($items)) {

    foreach ($items as $i) {

        if ($i['uuid'] == $item['uuid']) {
            $flag = true;
        }
    }
}
?>

@if($flag)
    <a id="addToBag" class="BagAdded" style="cursor: pointer;" data-uid="{{$item['uuid']}}"
       data-category="{{$item['category_slug']}}" href="javascript:void(0)">
        <i id="check" class="fa fa-check"></i>
        {{ __('localization.added_to_cart')}}
    </a>
@else
    <a hreflang="javascript:void(0)" id="addToBag" class="BagAdded " style="cursor: pointer;"
       data-uid="{{$item['uuid']}}" data-category="{{$item['category_slug']}}">
        <i id="loader-btn" class="dn"><img src="{{asset('/public/images/ajax-loader.gif')}}" alt=""/> </i>
        <i id="check" class="fa fa-check dn"></i>
        {{ __('localization.add_to_cart')}}
    </a>
@endif




