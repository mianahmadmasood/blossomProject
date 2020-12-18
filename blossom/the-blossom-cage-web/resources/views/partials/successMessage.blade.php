<div class="successBox dn">
    <button id="btnClick" type="button" class="close text-right float-right">
        <span aria-hidden="true">×</span>
    </button>
    <p id="popup_message"></p>
    <div class="mb-3 dn">
        <button  onclick="window.location.href = baseUrl + locale + '/cart';" type="button" class="btn btn-primary"> {{ __('localization.v_cart_btn')}}</button>
        <button onclick="window.location.href = baseUrl + locale + '/products';" type="button" class="btn btn-primary">{{ __('localization.continue_shopping')}}</button>
    </div>
</div>
