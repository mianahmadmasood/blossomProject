<?php

namespace App\Http\Controllers;



use App\Http\Services\BlackListEmail;
use App\Http\Services\PaytabsServies;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Services\ForgotPassword;
use App\Http\Services\ItemQuantity;
use App\Http\Services\Categories;
use App\Http\Services\OrderList;
use App\Http\Services\Paytabs;
use App\Http\Services\Favorite;
use App\Http\Services\Feedback;
use App\Http\Services\Profile;
use App\Http\Services\Signup;
use App\Http\Services\Login;
use App\Http\Services\Item;
use App\Http\Services\Order;
use App\Http\Services\Colors;
use App\Http\Services\Brands;
use App\Http\Services\HomeFeeds;
use App\Http\Services\GuestSignup;

class Controller extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;
    use \App\Http\Traits\CommonService;

    public function getCategoriesService()
    {
        return new Categories();
    }

    public function getBrandsService()
    {
        return new Brands();
    }

    public function getColorsService()
    {
        return new Colors();
    }

    public function getItemService()
    {
        return new Item();
    }

    public function getOrderService()
    {
        return new Order();
    }

    public function getSignupService()
    {
        return new Signup();
    }

    public function getLoginService()
    {
        return new Login();
    }

    public function getProfileService()
    {
        return new Profile();
    }

    public function getOrderListService()
    {
        return new OrderList();
    }

    public function getFeedbackService()
    {
        return new Feedback();
    }

    public function getFavoriteService()
    {
        return new Favorite();
    }

//    public function getPaytabsService()
//    {
//        return new Paytabs();
//    }
    public function getPaytabsService()
    {
        return new PaytabsServies();
    }

    public function getForgotPasswordService()
    {
        return new ForgotPassword();
    }

    public function getQuantityControllService()
    {
        return new ItemQuantity();
    }

    public function getHomeFeedsService()
    {
        return new HomeFeeds();
    }
    public function getBlackListEmailService()
    {
        return new BlackListEmail();
    }

    public function guestUserSignupService()
    {
        return new GuestSignup();
    }

}
