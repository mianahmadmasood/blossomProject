<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " >
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">


    </div>
    <div class="kt-header__topbar">
       
        <div class="kt-header__topbar-item kt-header__topbar-item--user">    
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{Auth::user()->first_name}}</span>
                    <img class="kt-hidden" alt="Pic" src="{{config('paths.home_url') . config('paths.small-profiles-thumb') . Auth::user()->image}}" />
                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{strtoupper(substr(Auth::user()->first_name, 0,1))}}</span>
                </div>
            </div>

            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{config('paths.home_url') . config('paths.large-profiles-thumb') . Auth::user()->image}})">
                    <div class="kt-user-card__avatar">  
                        <img class="kt-hidden" alt="Pic" src="{{config('paths.home_url') . config('paths.medium-profiles-thumb') . Auth::user()->image}}" />
                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    </div>
                    <div class="kt-user-card__name">

                        {{Auth::user()->first_name}}

                    </div>
                </div>
                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">

                    <a href="{{route('userProfile')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                My Profile
                            </div>
                            <div  class="kt-notification__item-time">
                                Account settings and more
                            </div>
                        </div>
                    </a>
                    <a href="{{route('userPasswordUpate')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="fa fa-key kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                Change Password
                            </div>
                            <div  class="kt-notification__item-time">
                                Change your password and more
                            </div>
                        </div>
                    </a>
                    <div class="kt-notification__custom">
                        <a href="{{route('signout')}}" class="btn btn-label-brand btn-sm btn-bold">Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end: User Bar -->	
    </div>
    <!-- end:: Header Topbar -->
</div>