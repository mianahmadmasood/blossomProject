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

use App\BlackEmail;
use App\User;
use App\Order;
use App\Accessories;
use App\ItemAccessories;
use App\Colors;
use App\itemColorImages;
use App\Item;
use App\Category;
use App\Brands;
use App\HomeFeeds;
use App\ItemImage;
use App\ItemSize;
use App\ItemVariant;
use App\ItemColor;
use App\ItemVideo;
use App\ItemManual;
use App\OrderItem;
use App\OrderItemAccessries;
use App\OrderStatus;
use App\OrderAddress;
use App\Countries;
use App\UserDevice;
use App\UserProfile;
use App\Feedback;
use App\OrderStatusLog;
use App\IpnResponse;
use App\UserFavoriteItem;
use App\ProfileSettings;
use App\ItemOtherUnit;
use App\Http\Services\Shipping;
use App\Http\Services\GuestSignup;
use App\Http\Services\OrderEmails;
use App\Http\Services\PhomeNumberValidation;
use App\Http\Services\ItemQuantity;

class Config {

    use \App\Http\Traits\NotificationService;
    use \App\Http\Traits\CommonService;
    use \App\Http\Traits\UploadsService;
    use \App\Http\Traits\PathsService;
    use \App\Http\Traits\MessagesService;
    use \App\Http\Traits\RuleService;

    public function getCommonService() {
        return new CommonService();
    }

    public function getCategoryModel() {
        return new Category();
    }
    public function getBrandModel() {

        return new Brands();
    }

    public function getAccessorieModel() {

        return new Accessories();
    }
    public function getItemAccessorieModel() {
        return new ItemAccessories();
    }

    public function getItemModel() {
        return new Item();
    }

    public function getItemImageModel() {
        return new ItemImage();
    }

    public function getItemSizeModel() {
        return new ItemSize();
    }

    public function getItemVariantModel() {
        return new ItemVariant();
    }

    public function getItemColorModel() {
        return new ItemColor();
    }
    public function getItemColorImageModel() {
        return new itemColorImages();
    }

    public function getItemManualModel() {
        return new ItemManual();
    }

    public function getItemVideoModel() {
        return new ItemVideo();
    }

    public function getOrderModel() {
        return new Order();
    }

    public function getOrderItemModel() {
        return new OrderItem();
    }
    public function getOrderItemAccessriesModel() {
        return new OrderItemAccessries();
    }

    public function getOrderLogModel() {
        return new OrderStatusLog();
    }

    public function getOrderStatusModel() {
        return new OrderStatus();
    }

    public function getOrderAddressModel() {
        return new OrderAddress();
    }

    public function getUserModel() {
        return new User();
    }

    public function getUserDeviceModel() {
        return new UserDevice();
    }

    public function getUserProfileModel() {
        return new UserProfile();
    }

    public function getFeedbackModel() {
        return new Feedback();
    }

    public function getUserFavoriteItemModel() {
        return new UserFavoriteItem();
    }

    public function guestUserSignup() {
        return new GuestSignup();
    }

    public function getIpnModel() {
        return new IpnResponse();
    }

    public function shippingMethod() {
        return new Shipping();
    }

    public function getSettingModel() {
        return new ProfileSettings();
    }

    public function getEmailService() {
        return new OrderEmails();
    }

    public function getPhoneValidator() {
        return new PhomeNumberValidation();
    }

    public function getQuantityControl() {
        return new ItemQuantity();
    }
    public function getHomeFeedModel() {
        return new HomeFeeds();
    }
    public function getCountryModel() {
        return new Countries();
    }
    public function getBlackEmailModel() {
        return new BlackEmail();
    }

}
