<?php

namespace App\Http\Controllers;

use App\Http\Services\BlackListEmail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Services\Item;
use App\Http\Services\Cart;
use App\Http\Services\Checkout;
use App\Http\Services\Order;
use App\Http\Services\Profile;
use App\Http\Services\Auth\Signin;
use App\Http\Services\Auth\Signup;
use App\Http\Services\Feedback;
use App\Http\Services\Favorite;
use App\Http\Services\Home;
use App\Http\Services\ProfileImage;
use App\Http\Services\OrderPayment;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    use \App\Http\Traits\CommonService;

    public function itemService() {
        return new Item();
    }

    public function signinService() {
        return new Signin();
    }

    public function signupService() {
        return new Signup();
    }

    public function getCart() {
        return new Cart();
    }

    public function checkout() {
        return new Checkout();
    }

    public function Order() {
        return new Order();
    }

    public function profile() {
        return new Profile();
    }

    public function feedback() {
        return new Feedback();
    }

    public function favorite() {
        return new Favorite();
    }

    public function home() {
        return new Home();
    }

    public function profileImage() {
        return new ProfileImage();
    }

    public function orderPayment() {
        return new OrderPayment();
    }
    public function getBlackListEmailService() {
        return new BlackListEmail();
    }

}
