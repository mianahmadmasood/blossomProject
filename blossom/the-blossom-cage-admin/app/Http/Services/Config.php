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

use App\HomeFeeds;
use App\Accessories;
use App\Colors;
use App\ItemAccessories;
use App\itemColorImages;
use App\Warehouses;
use App\Category;
use App\IpnResponse;
use App\Item;
use App\ItemImage;
use App\ItemOtherUnit;
use App\ItemSize;
use App\ItemVariant;
use App\ItemColor;
use App\ItemVideo;
use App\ItemManual;
use App\ItemSpecification;
use App\Brands;
use App\Order;
use App\OrderItem;
use App\OrderStatusLog;
use App\OrderStatus;
use App\OrderAssignment;
use App\OrderAddress;
use App\ProfileSettings;
use App\Feedback;
use App\ReceiverUsers;
use App\UserFavoriteItem;
use App\ItemQuantityLog;
use App\User;
use App\Http\Services\Shipping;
use App\Http\Services\OrderEmails;
use App\Http\Services\ItemQuantityLogs;

class Config {

    use \App\Http\Traits\NotificationService;
    use \App\Http\Traits\UploadsService;
    use \App\Http\Traits\CommonService;
    use \App\Http\Traits\PathsService;
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
    public function getHomeFeedModel() {
        return new HomeFeeds();
    }
    public function getAccessorieModel() {

        return new Accessories();
    }
    public function getItemAccessorieModel() {
        return new ItemAccessories();
    }
    public function getColorModel() {
        return new Colors();
    }
    public function getitemColorImagesModel() {
        return new itemColorImages();
    }
    public function getWarehouseModel() {
        return new Warehouses();
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
    public function getItemOtherUnitModel() {
        return new ItemOtherUnit();
    }

    public function getItemColorModel() {
        return new ItemColor();
    }

    public function getItemManualModel() {
        return new ItemManual();
    }

    public function getItemVideoModel() {
        return new ItemVideo();
    }

    public function getItemSpecificationModel() {
        return new ItemSpecification();
    }

    public function getOrderModel() {
        return new Order();
    }

    public function getOrderItemModel() {
        return new OrderItem();
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

    public function getOrderAssignmentModel() {
        return new OrderAssignment();
    }

    public function shippingService() {
        return new Shipping();
    }

    public function getSettingsModel() {
        return new ProfileSettings();
    }

    public function getReceiverUsersModel()
    {
        return new ReceiverUsers();
    }

    public function getFeedbackModel() {
        return new Feedback();
    }

    public function getOrderEmailService() {
        return new OrderEmails();
    }

    public function getUserFavItemsModel() {
        return new UserFavoriteItem();
    }

    public function getIpnResponse() {
        return new IpnResponse();
    }

    public function getItemQuantityLogModel() {
        return new ItemQuantityLog();
    }

    public function getItemQuantityLogService() {
        return new ItemQuantityLogs();
    }

}
