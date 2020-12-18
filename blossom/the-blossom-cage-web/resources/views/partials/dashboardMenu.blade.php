<div class="dashboard_menu">
    <div class="overlay_dashboard"></div><!--overlay_dashboard-->
    <div class="dropdown profile_nav">
        <h6 class="menuu"> {{ __('localization.menu')}}</h6>
        <div class="close-btn2">
            <svg xmlns="https   ://www.w3.org/2000/svg" viewBox="0 0 64 64" id="close-1" width="100%" height="100%">
                <path data-name="layer1" fill="none" stroke="#202020" stroke-miterlimit="10" d="M41.999 20.002l-22 22m22 0L20 20" stroke-linejoin="round" stroke-linecap="round" style="stroke:var(--layer1, #202020)"></path>
            </svg>
        </div>
        <ul class="fixmenu">
            <li><a href="{{route('myProfile', [ 'lang' => App::getLocale()])}}"><i class="icon icon-user"></i>{{ __('localization.proffile_btn')}}</a></li>
            <li><a href="{{route('myOrders' ,[ 'lang' => App::getLocale()])}}"><i class="fa fa-newspaper"></i>{{ __('localization.order_btn')}}</a> </li>
            <li><a href="{{route('myAddress',[ 'lang' => App::getLocale()])}}"><i class="fa fa-map-marked-alt"></i>{{ __('localization.address_btn')}}</a> </li>
            <li><a href="{{route('myFavorites',[ 'lang' => App::getLocale()])}}"><i class="fa fa-heart"></i>{{ __('localization.wishlist_btn')}}</a> </li>
            <li><a href="{{route('changePassword',[ 'lang' => App::getLocale()])}}"><i class="fa fa-lock"></i>{{ __('localization.c_password_btn')}}</a> </li>
            <li><a href="{{route('feedback',[ 'lang' => App::getLocale()])}}"><i class="fa fa-comment-dots"></i>{{ __('localization.feedback_btn')}}</a> </li>
            <li><a href="{{route('logout',[ 'lang' => App::getLocale()])}}"><i class="fa fa-power-off"></i>{{ __('localization.logout_btn')}}</a> </li>
        </ul>
    </div>
</div><!--dashboard_menu-->