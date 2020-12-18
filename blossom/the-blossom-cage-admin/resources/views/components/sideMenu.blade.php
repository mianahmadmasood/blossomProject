<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            @if(Auth::check() && Auth::user()->role_id == 1)
            <a href="{{route('dashboard')}}">
                <img height="50" width="180" alt="Logo" src="{!! asset('public/theme-images/logo-light.png') !!}"/>
            </a>
            @else
                <a href="{{route('employeeDashboard')}}">
                <img height="50" width="180" alt="Logo" src="{!! asset('public/theme-images/logo-light.png') !!}"/>
                </a>
            @endif
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                <span>
                    <svg xmlns="httpss://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                            <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
                            <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "/>
                        </g>
                    </svg>
                </span>
                <span>
                    <svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero"/>
                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "/>
                        </g>
                    </svg>
                </span>
            </button>
            <!--
               <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
            -->
        </div>
    </div>
    <!-- end:: Aside -->	<!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div
            id="kt_aside_menu" class="kt-aside-menu "   data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                @if(Auth::check() && Auth::user()->role_id == 1)
                <li class="kt-menu__item " aria-haspopup="true" >
                    <a  href="{{route('dashboard')}}" class="kt-menu__link ">
                        <span class="kt-menu__link-text"><i class="fa fa-database kt-font-brand mr-2"></i> Dashboard</span>
                    </a>
                </li>
                    <li class="kt-menu__section ">
                       <span class="kt-menu__link-text">
                            Home Setting
                        </span>

                    </li>
                    <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-home kt-font-brand mr-2"></i>
                        </span>
                            <span class="kt-menu__link-text">Home Setting</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200" style="display: none; overflow: hidden;">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                             
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getBanners')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Home Banners</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getTrendyItems')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Home TrendyItems</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('gettopSaleProduct')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Home Sale Products</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('gettopCategories')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Home Top Categories</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('gettopBrands')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Home Top Brands</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getfalshDeals')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Home Flash Deals</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text"> Employees</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                             <i class="fa fa-users kt-font-brand mr-2 "></i>
                        </span>
                        <span class="kt-menu__link-text">Employees </span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="display: none; overflow: hidden;">
                        <span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('allEmployees')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('createEmployee')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Create</span></a></li>

                        </ul>
                    </div>
                </li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text"> Chbib Store</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                             <i class="fa fa-store kt-font-brand mr-2 "></i>
                        </span>
                        <span class="kt-menu__link-text">Stores </span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="display: none; overflow: hidden;">
                        <span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getWarehouses')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('createWarehouse')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Create</span></a></li>

                        </ul>
                    </div>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text"> Categories</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-list-alt kt-font-brand mr-2 "></i>
                        </span>
                        <span class="kt-menu__link-text">Categories Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="display: none; overflow: hidden;">
                        <span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('createCategory')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Add Category</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getCategories')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List Categories</span></a></li>
{{--                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getArchivedCategories')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text"> Archive Categories</span></a></li>--}}
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('createSubCategory')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Add Sub Category</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getSubCategories')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List Sub Categories</span></a></li>
{{--                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getArchivedSubCategories')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text"> Archive Sub Categories</span></a></li>--}}

                        </ul>
                    </div>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text"> Brands</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-list-alt kt-font-brand mr-2 "></i>
                        </span>
                        <span class="kt-menu__link-text">Brands Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="display: none; overflow: hidden;">
                        <span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('createbrand')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Add Brand</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getBrands')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List Brands</span></a></li>
{{--                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getDeletedBrands')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Archive Brands</span></a></li>--}}

                        </ul>
                    </div>
                </li>
                    <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text"> Accessories</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                             <i class="fa fa-address-book kt-font-brand mr-2 "></i>
                        </span>
                        <span class="kt-menu__link-text">Accessories Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="display: none; overflow: hidden;">
                        <span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('createaccessorie')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Add Accessorie</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getAccessories')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List Accessories</span></a></li>
{{--                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getDeletedAccessories')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Archive Accessories</span></a></li>--}}

                        </ul>
                    </div>
                </li>

                <li class="kt-menu__section ">
                        <h4 class="kt-menu__section-text"> Colors</h4>
                        <i class="kt-menu__section-icon flaticon-more-v2"></i>
                    </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-list-alt kt-font-brand mr-2 "></i>
                        </span>
                            <span class="kt-menu__link-text">Colors Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200" style="display: none; overflow: hidden;">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('createcolor')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Add Color</span></a></li>
                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('getColors')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List Colors</span></a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Product</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-book-reader kt-font-brand mr-2 "></i>

                        </span>
                        <span class="kt-menu__link-text">Product Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="display: none; overflow: hidden;">
                        <span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('createItem')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Add</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('allItem')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Live Products</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('allPendingItem')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Product Draft Listing</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('allOutOfStock')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Out of stock Products Listing</span></a></li>
{{--                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('allDeletedItem')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Products Archive</span></a></li>--}}
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Orders</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                             <i class="fa fa-atom kt-font-brand mr-2 "></i>

                        </span>
                        <span class="kt-menu__link-text">Orders Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="display: none; overflow: hidden;">
                        <span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('orders', ['type' => 'new'])}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">New Orders  </span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('orders', ['type' => 'accepted'])}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Accepted Orders</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('orders', ['type' => 'dispatched'])}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Dispatched Orders</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('orders', ['type' => 'completed'])}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Completed Orders</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('orders', ['type' => 'cancelled'])}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Cancelled Orders</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('orders', ['type' => 'rejected'])}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Rejected Orders</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Customers</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-list-alt kt-font-brand mr-2 "></i>

                        </span>
                        <span class="kt-menu__link-text">Customers Detail</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="display: none; overflow: hidden;">
                        <span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('allCustomers')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Feedback</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                             <i class="fa fa-bullhorn kt-font-brand mr-2 "></i>

                        </span>
                        <span class="kt-menu__link-text">Feedback</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="display: none; overflow: hidden;">
                        <span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('feedBack')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Users Feedback</span></a></li>
                        </ul>
                    </div>
                </li>
                @endif
                @if(Auth::check() && Auth::user()->role_id == 3)
                <li class="kt-menu__item " aria-haspopup="true" >
                    <a  href="{{route('employeeDashboard')}}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon"><svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon id="Bound" points="0 0 24 0 24 24 0 24"></polygon>
                                    <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" id="Shape" fill="#000000" fill-rule="nonzero"></path>
                                    <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" id="Path" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </span>
                        <span class="kt-menu__link-text">Dashboard</span>
                    </a>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text"> Profile</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <i class="kt-font-brand flaticon2-gear"></i>
                        </span>
                        <span class="kt-menu__link-text">Profile </span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="display: none; overflow: hidden;">
                        <span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('userPasswordUpate')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Change Password</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="{{route('userProfile')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Edit Profile</span></a></li>
                        </ul>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>