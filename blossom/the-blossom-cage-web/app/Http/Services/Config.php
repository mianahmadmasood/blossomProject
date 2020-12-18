<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author qadeer
 */

namespace App\Http\Services;

use App\UserDevice;
use App\User;
use App\Order;
use App\UserProfile;
use App\Http\Services\Home;
use App\Http\Services\PhomeNumberValidation;
use App\Http\Services\Checkout;

class Config {

    use \App\Http\Traits\CommonService;
    use \App\Http\Traits\MessagesService;
    use \App\Http\Traits\RuleService;
    use \App\Http\Traits\PathsService;

    public function getUserDeviceModel() {
        return new UserDevice();
    }

    public function getUserModel() {
        return new User();
    }

    public function getUserProfileModel() {
        return new UserProfile();
    }

    public function getHomeService() {
        return new Home();
    }

    public function getOrderModel() {
        return new Order();
    }

    public function getPhoneValidator() {
        return new PhomeNumberValidation();
    }
    public function getCheckoutService() {
        return new Checkout();
    }

}
