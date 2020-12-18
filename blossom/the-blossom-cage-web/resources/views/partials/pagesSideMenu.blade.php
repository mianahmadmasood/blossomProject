@if(Auth::check())
<div class="col-md-3">
    <div class="profileLft">
        <div class="customer-profile">
            @if(Auth::user()->image)
            <a href="JavaScript:Void(0)"><img class="img-fluid rounded-circle" src="{{config('paths.medium_profile') . Auth::user()->image}}"></a>
            @else
            <a href="JavaScript:Void(0)"><img class="img-fluid rounded-circle" src="{{asset('public/images/user.png')}}"></a>
            @endif
            <h5>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
            <p>{{Auth::user()->email}}</p>
            @if(\Request::route()->getName() == 'myProfile')
            <a style="cursor: pointer" id="editProfileMenu" ><i class="fa fa-edit"></i> {{ __('localization.edit_profile')}}</a>
            @endif
        </div><!--customer-profile    -->
        <div class="dropdown profile_nav">
            <ul>
                <li><a href="{{route('myProfile', [ 'lang' => App::getLocale()])}}"><i class="icon icon-user"></i> {{ __('localization.my_profile')}}<i class="fa fa-chevron-right RIco"></i></a></li>
                <li><a href="{{route('myOrders', [ 'lang' => App::getLocale()])}}"><i class="fa fa-newspaper"></i> {{ __('localization.my_orders')}}<i class="fa fa-chevron-right RIco"></i></a> </li>
                <li><a href="{{route('myAddress', [ 'lang' => App::getLocale()])}}"><i class="fa fa-map-marked-alt"></i> {{ __('localization.address_btn')}}<i class="fa fa-chevron-right R                                        Ico"></i></a> </li>
                <li><a href="{{route('myFavorites', [ 'lang' => App::getLocale()])}}"><i class="fa fa-heart"></i> {{ __('localization.wishlist_btn')}}<i class="fa fa-chevron-right RIco"></i></a> </li>
                <li><a href="{{route('changePassword', [ 'lang' => App::getLocale()])}}"><i class="fa fa-lock"></i> {{ __('localization.c_password_btn')}}<i class="fa fa-chevron-right RIco"></i></a> </li>
                <li><a href="{{route('feedback', [ 'lang' => App::getLocale()])}}"><i class="fa fa-comment-dots"></i> {{ __('localization.feedback_btn')}}<i class="fa fa-chevron-right RIco"></i></a> </li>
                <li><a href="{{route('logout', [ 'lang' => App::getLocale()])}}"><i class="fa fa-power-off"></i> {{ __('localization.logout_btn')}}</a> </li>
            </ul>
        </div>
    </div><!--profileLft-->
</div>	
@endif