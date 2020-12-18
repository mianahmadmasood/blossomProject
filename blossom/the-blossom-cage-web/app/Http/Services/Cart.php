<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of ShoppingBag
 *
 * @author qadeer
 */

use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class Cart extends Config
{

    protected $headers;
    protected $lang;

    function __construct()
    {

        $this->headers = [
            'apikey' => config('config.apikey'),
            'lang' => Session::get('locale')
        ];

        $this->lang = Session::get('locale');
    }

    /**
     * Catching the item from front end and store into session
     */
    public function storeItem()
    {

        $request_prams = Input::all();
        $request_prams = $this->perpareItemAccessories($request_prams);
//        die(var_dump($request_prams));
        if (!empty(session::get('items'))) {
            $put_item = $this->putItemIntoSessionWithExistantItemscheck($request_prams);
        } else {
            $put_item = $this->putItemIntoSession($request_prams);
        }
        if ($put_item) {
//            die(var_dump($put_item));
            return $this->processItemStore();
        }
        return $this->jsonErrorResponse($this->getMessageData('error', $this->lang)['general_error']);
    }

    /**
     * Catching the item from front end and store into session
     */
    public function perpareItemAccessories($request_prams)
    {

        if (!empty($request_prams['itemAccessoires'])) {
            foreach ($request_prams['itemAccessoires'] as $key => $row) {
                $itemAccessoiresArray = explode('-', $row);
                $request_prams['orderItemAccessories'][$key]['id'] = $itemAccessoiresArray[0];
                $request_prams['orderItemAccessories'][$key]['en_title'] = $itemAccessoiresArray[1];
                $request_prams['orderItemAccessories'][$key]['ar_title'] = $itemAccessoiresArray[2];
                $request_prams['orderItemAccessories'][$key]['price'] = $itemAccessoiresArray[3];
                $request_prams['orderItemAccessories'][$key]['accessoires_qty'] = $request_prams['quantity'];
                $request_prams['orderItemAccessories'][$key]['image'] = $itemAccessoiresArray[4];
                $request_prams['orderItemAccessories'][$key]['must_purchase'] = $itemAccessoiresArray[5];
            }
            unset($request_prams['itemAccessoires']);
        }
        return $request_prams;
    }

    public function storeItemupdate()
    {

        $request_prams = Input::all();
        if (!empty(session::get('items'))) {
            $put_item = $this->putItemIntoSessionWithExistantItemsUpdate($request_prams);
        } else {
            $put_item = $this->putItemIntoSession($request_prams);
        }
        if ($put_item) {
            return $this->processItemStore();
        }
        return $this->jsonErrorResponse($this->getMessageData('error', $this->lang)['general_error']);
    }

    /**
     * processItemStore method process the code further
     * @param type $request_prams
     * @return type
     */
    public function processItemStore()
    {

        Session::save();
        $data['html'] = $this->prepareHtml();
        $data['total'] = $this->calculateTotalAmount();
        $data['shipping_amount'] = $this->calculateShippingAmount();
        $data['tax_amount'] = $this->calculateTaxAmount();
        $data['total_items'] = count(Session::get('items'));


        return $this->jsonSuccessResponse($this->getMessageData('success', $this->lang)['item_added_to_bag'], $data);
    }

    /**
     * checkItemInCart method , check item should not be duplicated
     * @param type $request_prams
     * @param type $items_in_bag
     * @return boolean
     */
    public function checkItemInCart($request_prams, $items_in_bag)
    {

        if (!empty($items_in_bag)) {
            foreach ($items_in_bag as $item) {

                if ($item['color_id'] == $request_prams['color_id']) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * putItemIntoSession method, put item in fresh session
     * @param type $request_prams
     * @return boolean
     */
    public function putItemIntoSession($request_prams)
    {

        $items_in_bag = [];
        array_push($items_in_bag, $request_prams);
        Session::put('items', $items_in_bag);
        return true;

    }

    /**
     * putItemIntoSessionWithExistantItems , put item with existent item
     * @param type $request_prams
     * @return boolean
     */
    public function putItemIntoSessionWithExistantItemsUpdate($request_prams)
    {

        $items_in_bag = Session::get('items');
        foreach ($items_in_bag as $key => $row) {

            if ($row['slug'] == $request_prams['slug']) {
                unset($items_in_bag[$key]);
            }
        }
        Session::forget('items');
        array_push($items_in_bag, $request_prams);
        Session::put('items', $items_in_bag);
        Session::forget('itemcolorNameforedit');
        Session::forget('itemColorEdit');
        return true;
    }

    /**
     * putItemIntoSessionWithExistantItems , put item with existent item
     * @param type $request_prams
     * @return boolean
     */
    public function putItemIntoSessionWithExistantItems($request_prams)
    {

        $items_in_bag = Session::get('items');
        array_push($items_in_bag, $request_prams);
        Session::put('items', $items_in_bag);
        return true;
    }

    /**
     * putItemIntoSessionWithExistantItems , put item with existent item
     * @param type $request_prams
     * @return boolean
     */
    public function putItemIntoSessionWithExistantItemscheck($request_prams)
    {
//        die(var_dump());

        $items_in_bag = Session::get('items');
        $items_in_bag_qty = 0;
        foreach ($items_in_bag as $key => $row) {
            if ($row['color_id'] == $request_prams['color_id']) {
                $items_in_bag_qty = 1;
                if (!empty($request_prams['orderItemAccessories'])) {
                    $newAccessoires = count($request_prams['orderItemAccessories']);
                    $sessionAccessoires = count($row['orderItemAccessories']);
                    if ($newAccessoires != $sessionAccessoires) {
//                            die(var_dump('$items_in_bag'));
                        $items_in_bag_qty = 2;
                        unset($items_in_bag[$key]);
                    }
                }

            }
        }

        if ($items_in_bag_qty != 1) {
            array_push($items_in_bag, $request_prams);
            Session::put('items', $items_in_bag);
        }
        return true;

    }

    /**
     * prepareHtml method prepares html for shopping bag
     * @param type $item
     * @return string
     */
    public function prepareHtml()
    {

        $html_items_array = [];
        if (!empty(Session::get('items'))) {
            $items = Session::get('items');
            foreach ($items as $key => $item) {


                if (Session::get('locale') == 'ar') {
                    $title = $item['ar_title'];
                    $quaunity = 'كمية';
                } else {
                    $title = $item['en_title'];
                    $quaunity = 'Quantity';
                }
                $link = $link = \URL::to('/') . '/' . Session::get('locale') . '/product/' . $item['slug'];
                $html_items_array[$key] = $this->prepaeHtmlForCart($link, $item, $quaunity, $title);
            }
        } else {
            if (Session::get('locale') == 'ar') {
                $html_items_array[] = '<strong class="d-block text-sm">عربة التسوق فارغة </strong>';
            } else {
                $html_items_array[] = '<strong class="d-block text-sm">Your cart is empty </strong>';
            }
        }

        return array_values($html_items_array);
    }

    /**
     * prepaeHtmlForCart method
     * @param type $link
     * @param type $item
     * @param type $quaunity
     */
    public function prepaeHtmlForCart($link, $item, $quaunity, $title)
    {

        $price_string = '';
        if (Session::get('cur_currency') === 'USD') {
            $price_string = '$' . $item['quantity'] * ($item['price'] * Session::get('amount_per_unit'));
        } else {
            $price_string = $item['price'] . ' SAR';
        }

        $string = '<div class="navbar-cart-product" >
                                            <div class="d-flex align-items-center">
                                                <a href="' . $link . '"> ';
        if (!empty($item['color_image'])) {
            $string .= '<img src=" ' . config('paths.small_itemColor') . $item['color_image'] . '"' . 'class="img-fluid navbar-cart-product-image"></a>';
        } else {
            $string .= '<img src=" ' . $item['image'] . '"' . 'class="img-fluid navbar-cart-product-image"></a>';
        }

        $string .= '<div class="w-100">
                                                    <a id="removeFromBag" href="javascript:void(0)" class="close2 text-sm mr-2" data-value="' . $item['color_id'] . '">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                    <div class="pl-3">
                                                        <a href="' . $link . '"' . 'class = "navbar-cart-product-link">' . $title . '</a>
                            <small class = "d-block text-muted">' . $quaunity . ':' . $item['quantity'] . '</small>
                            <strong class = "d-block text-sm">' . $price_string . ' </strong>
                            </div>
                            </div>
                            </div>
                            </div>';
        return $string;
    }

    /**
     * viewShoppingBag list all the items in the bag
     *
     * @return type
     */
    public function viewShoppingBag()
    {

        $items = Session::get('items');


        if (!empty($items)) {
            $quantity_check = $this->checkQuantityItems($items);
            if ($quantity_check['success'] == true && $quantity_check['status_code'] == 601) {
                $this->getCheckoutService()->updateCartQuantity($quantity_check['data']);
                Session::put('outof_stock_items', $quantity_check['data']);
                return View('pages.cart');
            } else if ($quantity_check['success'] == true && $quantity_check['status_code'] == 602) {
                Session::forget('outof_stock_items');
                return View('pages.cart');
            }
        }
        return view('pages.cart');
    }

    /**
     *
     * @param type $items
     * @return type
     */
    protected function checkQuantityItems($items)
    {

        $request_items['items'] = $items;
        $request_data = [
            'form_params' => $request_items,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
            ]
        ];

        return $this->guzzleRequest('items/check/quantity', 'POST', $request_data);
    }

    /**
     * removeItemFromShoppingbag removes certain item from cart
     * eighter it could be in bag drop down or bag page
     * @return type
     */
    public function removeItemFromShoppingbag()
    {

        $reuest_prams = Input::all();
//        dd($reuest_prams);
        $items_in_bag = Session::get('items');
        if (!empty($reuest_prams['flag']) && $reuest_prams['flag'] == 'checkout_page') {
            if (count($items_in_bag) == 1) {
                return $this->jsonErrorResponse($this->getMessageData('error', $this->lang)['last_item_in_bag']);
            }
        }
        foreach ($items_in_bag as $key => $item) {

            if ($item['color_id'] == $reuest_prams['uuid']) {
                unset($items_in_bag[$key]);
            }
        }
        Session::put('items', array_values($items_in_bag));
        Session::save();
        $data['total_items'] = count(Session::get('items'));
        $data['html'] = $this->prepareHtml();
        $data['total'] = $this->calculateTotalAmount();
        $data['shipping_cost'] = $this->calculateShippingAmount();
        $data['tax_amount'] = $this->calculateTaxAmount();
        return $this->jsonSuccessResponse($this->getMessageData('success', $this->lang)['item_removed_to_bag'], $data);
    }

    /**
     * removeItemAccessoriesFromShoppingbag removes certain item from cart
     * eighter it could be in bag drop down or bag page
     * @return type
     */
    public function removeItemAccessoriesFromShoppingbag()
    {

        $reuest_prams = Input::all();
        $items_in_bag = Session::get('items');
        if (!empty($reuest_prams['flag']) && $reuest_prams['flag'] == 'checkout_page') {
            if (count($items_in_bag) == 1) {
                return $this->jsonErrorResponse($this->getMessageData('error', $this->lang)['last_item_in_bag']);
            }
        }

        foreach ($items_in_bag as $key => $item) {
            if ($item['color_id'] == $reuest_prams['color_id']) {
                foreach ($item['orderItemAccessories'] as $keys =>$itemAccesories) {
                    if ($itemAccesories['id'] == $reuest_prams['accessoriesId']) {
                        unset($items_in_bag[$key]['orderItemAccessories'][$keys]);
                        array_values($items_in_bag[$key]['orderItemAccessories']);
                    }
                }
            }
//            dd($item['orderItemAccessories']);
        }

        Session::put('items', array_values($items_in_bag));
        Session::save();
        $data['total_items'] = count(Session::get('items'));
        $data['html'] = $this->prepareHtml();
        $data['total'] = $this->calculateTotalAmount();
        $data['shipping_cost'] = $this->calculateShippingAmount();
        $data['tax_amount'] = $this->calculateTaxAmount();
        return $this->jsonSuccessResponse($this->getMessageData('success', $this->lang)['item_removed_to_bag'], $data);
    }

    /**
     * updateShoppingbag method updates the items in the bag
     * @return type
     */
    public function updateShoppingbag()
    {

        $total_price = 0;
        $reuest_prams = Input::all();
        $items_in_bag = Session::get('items');
        array_values($items_in_bag);
        foreach ($items_in_bag as $key => $item) {

            if ($item['color_id'] === $reuest_prams['uuid']) {
                $items_in_bag[$key]['quantity'] = $reuest_prams['quantity'];
                $items_in_bag[$key]['orderItemAccessories'] =$this->perpareItemAccessoriesForQty($item,$reuest_prams);
                if (Session::get('cur_currency') === 'USD') {
                    $total_price = ($items_in_bag[$key]['price'] * Session::get('amount_per_unit')) * $reuest_prams['quantity'];
                } else {
                    $total_price = $items_in_bag[$key]['price'] * $reuest_prams['quantity'];
                }
            }
        }
        Session::put('items', $items_in_bag);
        $data['total'] = $this->calculateTotalAmount();
        $data['shipping_cost'] = $this->calculateShippingAmount();
        $data['tax_amount'] = $this->calculateTaxAmount();
        $data['total_price'] = $total_price;
        return $this->jsonSuccessResponse($this->getMessageData('success', $this->lang)['bag_updated'], $data);
    }


    /**
     * Catching the item from front end and store into session
     */
    public function perpareItemAccessoriesForQty($item,$request_prams)
    {

        if (!empty($item['orderItemAccessories'])) {
            foreach ($item['orderItemAccessories'] as $key => $row) {
               if($row['must_purchase'] == 1) {
                   $item['orderItemAccessories'][$key]['accessoires_qty'] = $request_prams['quantity'];
               }
            }
            return $item['orderItemAccessories'];
        }
        return null;
    }


    /**
     * GETTING CART ON PAGE LOAD
     * @return type
     */
    public function getCartData()
    {

        $data['html'] = $this->prepareHtml();
        $data['total_items'] = !empty(Session::get('items')) ? count(Session::get('items')) : 0;
        $data['total'] = $this->calculateTotalAmount();
        $data['shipping_cost'] = $this->calculateShippingAmount();
        $data['tax_amount'] = $this->calculateTaxAmount();
        return $this->jsonSuccessResponse('Process is process successfully', $data);
    }

    /**
     * GETTING CART ON PAGE LOAD
     * @return type
     */
    public function getItemEditColors()
    {
        $request_prams = Input::all();
        $itemcolorname = $request_prams['itemcolorName'];
        $request_prams['itemSlug'];
        Session::put('itemcolorNameforedit', $itemcolorname);
        Session::put('itemColorEdit', 'itemedit');
        $data = [];
        return $this->jsonSuccessResponse('Process is process successfully', $data);
    }

}
