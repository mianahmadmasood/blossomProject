@if(!empty($item['sale_price']))
<p> <span class="amount"> {{Session::get('cur_currency')}} {{ round($item['price'] * Session::get('amount_per_unit'),2) }}</span> <span>{{Session::get('cur_currency')}} {{round($item['sale_price'] * Session::get('amount_per_unit'),2) }}</span></p>
@else
<p> {{Session::get('cur_currency')}} {{round($item['price'] * Session::get('amount_per_unit'),2) }}</p>
@endif
