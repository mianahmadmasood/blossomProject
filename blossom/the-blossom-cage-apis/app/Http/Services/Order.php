<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this te                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     mplate file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of OrderService
 *
 * @author qadeer
 */

use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DB;

class Order extends Config
{

    /**
     * placeOrder method prepares and save
     * all necessary data about order and related tables
     * @return type
     */
    public function placeOrder()
    {

        $request_params = Input::all();

        $validation = Validator::make($request_params, $this->place_order_rules, $this->selectRulesLang($rules = 'place_order_rules', $request_params['lang']));
        if ($validation->fails()) {
            return $this->jsonErrorResponse($validation->errors()->first());
        }

        if ($request_params['payment_method'] != 1 && $request_params['order_currency'] == 'SAR' && $request_params['converted_total_amount'] > 18702.75) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['payment_greater_then_sar']);
        }
        if ($request_params['payment_method'] != 1 && $request_params['order_currency'] == 'USD' && $request_params['converted_total_amount'] > 4987.31) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['payment_greater_then_usd']);
        }

        $quantity_response_outstock = $this->getQuantityControl()->checkItemsQuantity($request_params['items']);

        if ($quantity_response_outstock['success'] == true) {
            $data['items'] = $quantity_response_outstock['items'];
            return $this->jsonSuccessResponse($this->getMessageData('error', $request_params['lang'])['products_outof_stock'], $data, 601);
        }
//        dd($request_params);
        return $this->processOrderData($request_params);
    }

    /**
     *
     * @param string $request_params
     * @return type
     */
    protected function processOrderData($request_params)
    {

        if (!empty($request_params['phone_no'])) {
            $phone_validation = $this->getPhoneValidator()->checkphoneNumberValidation($request_params['phone_no']);
            if ($phone_validation === false) {
                return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['phone_invalid']);
            }
            $detais = $this->getPhoneValidator()->getPhoneNumberDetails($request_params['phone_no']);
            if (!empty($detais)) {
                $request_params['phone_no'] = '+' . $detais['countryCode'] . $detais['nationNumber'];
            } else {
                return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['service_unavailable'], 503);
            }
        }
        if (!empty($request_params['shipping_phone_no'])) {
            $phone_validation = $this->getPhoneValidator()->checkphoneNumberValidation($request_params['shipping_phone_no']);
            if ($phone_validation === false) {
                return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['shipping_phone_invalid']);
            }
            $detais = $this->getPhoneValidator()->getPhoneNumberDetails($request_params['shipping_phone_no']);
            if (!empty($detais)) {
                $request_params['shipping_phone_no'] = '+' . $detais['countryCode'] . $detais['nationNumber'];
            } else {
                return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['service_unavailable'], 503);
            }
        }

        if ($request_params['is_same_billing'] == 0) {

            if (!empty($request_params['billing_phone_no'])) {
                $phone_validation = $this->getPhoneValidator()->checkphoneNumberValidation($request_params['billing_phone_no']);
                if ($phone_validation === false) {
                    return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['billing_phone_invalid']);
                }
                $detais = $this->getPhoneValidator()->getPhoneNumberDetails($request_params['billing_phone_no']);
                if (!empty($detais)) {
                    $request_params['billing_phone_no'] = '+' . $detais['countryCode'] . $detais['nationNumber'];
                } else {
                    return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['service_unavailable'], 503);
                }
            }
        }
        return $this->processUserCreation($request_params);
    }

    /**
     * procesOrderProcess method
     * @param type $request_params
     * @return type
     */
    public function processUserCreation($request_params)
    {


        DB::beginTransaction();
        if (!empty($request_params['user'])) {
            $request_params['user_data'] = $request_params['user'];
        }
        if (!empty($request_params['is_guest_login']) && $request_params['is_guest_login'] == 1) {

            $find_user = $this->getUserModel()->getUserByColumnValue('email', $request_params['email']);
            
            if (!empty($find_user)) {
                $this->guestUserSignup()->updateUserDevice($request_params);
                $request_params['user_data'] = $find_user;

            } else {

                return $this->makeGuestUserAndPlaceOrder($request_params);
            }
        }
        if (empty($request_params['user_data'])) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['authenticate']);
        }
        $save_order = $this->getOrderModel()->create($this->preapreOrderData($request_params));
        if ($save_order) {
            $quantity_response_outstock = $this->getQuantityControl()->checkItemsQuantity($request_params['items']);
            if ($quantity_response_outstock['success'] == true) {
                $data['items'] = $quantity_response_outstock['items'];
                return $this->jsonSuccessResponse($this->getMessageData('error', $request_params['lang'])['products_outof_stock'], $data, 601);
            }
            return $this->processOrderItems($request_params, $save_order);
        }
    }

    /**
     * make guest user and place order
     * @param type $request_params
     * @return type
     */
    protected function makeGuestUserAndPlaceOrder($request_params)
    {

            
        $make_user = $this->guestUserSignup()->signUpGuestUser($request_params);

        // if ($make_user == false) {
        //     DB::rollback();
        //     return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['invalid_email']);
        // }
        $request_params['user_data'] = $make_user;
        $request_params['makeGuestUser'] = 1;
        $save_order = $this->getOrderModel()->create($this->preapreOrderData($request_params));
        if ($save_order) {
            $quantity_response_outstock = $this->getQuantityControl()->checkItemsQuantity($request_params['items']);
            if ($quantity_response_outstock['success'] == true) {
                $data['items'] = $quantity_response_outstock['items'];
                return $this->jsonSuccessResponse($this->getMessageData('error', $request_params['lang'])['products_outof_stock'], $data, 601);
            }
            return $this->processOrderItems($request_params, $save_order);
        }
    }

    /**
     * preapreOrderData method prepare data
     * for order table
     * @param type $reques_params
     * @return array
     */
    public function preapreOrderData($request_params)
    {

        $order = [];
        $order['user_id'] = isset($request_params['user_data']->id)?$request_params['user_data']->id:3;
        $order['order_token'] = $this->randomStrings(10);
        $order['transaction_id'] = NULL;
        $order['transaction_status'] = $request_params['payment_method'] == 1 ? 'succeeded' : 'pending';
        $order['archive'] = $request_params['payment_method'] == 1 ? 0 : 1;
        $order['cod'] = $request_params['payment_method'];
        $order['order_status_id'] = 1;
        $order['recipient_first_name'] = $request_params['first_name'];
        $order['recipient_last_name'] = $request_params['last_name'];
        $order['recipient_phone_no'] = $request_params['shipping_phone_no'];
        $order['recipient_email'] = $request_params['email'];
        $order = $this->prepareOrderDataCon($order, $request_params);

        return $order;
    }

    /**
     *
     * @param type $order
     * @param type $request_params
     * @return type
     */
    public function prepareOrderDataCon($order, $request_params)
    {
        $awb_number = $this->shippingMethod()->addShipment($order, $request_params);
        $order['awb_number'] = !empty($awb_number) ? $awb_number : NULL;
        $order['total_amount'] = $request_params['total_amount'];
        $order['tax_amount'] = $request_params['tax_amount'];
        $order['shipping_amount'] = $request_params['shipping_amount'];
        $order['order_currency'] = !empty($request_params['order_currency']) ? $request_params['order_currency'] : 'SAR';
        $order['converted_shipping_amount'] = !empty($request_params['converted_shipping_amount']) ? $request_params['converted_shipping_amount'] : $order['shipping_amount'];
        $order['converted_tax_amount'] = !empty($request_params['converted_tax_amount']) ? $request_params['converted_tax_amount'] : $request_params['shipping_amount'];
        $order['converted_total_amount'] = !empty($request_params['converted_total_amount']) ? $request_params['converted_total_amount'] : $request_params['tax_amount'];
        return $order;
    }

    /**
     * processOrderItems method
     * prepares items of the order
     * @param type $request_params
     * @param type $order
     * @return type
     */
    public function processOrderItems($request_params, $order)
    {

        $order_items = $item_ids = $itemAccessories = [];
        $item_ids = $this->prepareItemIds($request_params['items']);
        $items = $this->getItemModel()->getItemsByUids($item_ids);
//        foreach ($items as $key => $item) {
        foreach ($request_params['items'] as $key => $r_item) {
            $item = $this->getItemModel()->where('uuid', $r_item['uuid'])->first();
            $order_items['uuid'] = \Uuid::generate()->string;
            $order_items['order_id'] = $order->id;
            $order_items['item_id'] = $item->id;
//                if ($r_item['uuid'] == $item->uuid) {
//                    $order_items['quantity'] = $r_item['quantity'];
            $order_items['price'] = $r_item['price'];
            $order_items['color_id'] = !empty($r_item['color_id']) ? $r_item['color_id'] : null;
            $order_items['color_name'] = !empty($r_item['color_name']) ? $r_item['color_name'] : null;
            $order_items['color_code'] = !empty($r_item['color_code']) ? $r_item['color_code'] : null;
            $order_items['quantity'] = !empty($r_item['quantity']) ? $r_item['quantity'] : null;
            $order_items['color_image'] = !empty($r_item['color_image']) ? $r_item['color_image'] : null;
            $order_items['undiscounted_price'] = !empty($r_item['undiscounted_price']) ? $r_item['undiscounted_price'] : $r_item['price'];
            $order_items['undiscounted_converted_price'] = !empty($r_item['undiscounted_converted_price']) ? $r_item['undiscounted_converted_price'] : $r_item['converted_price'];
            $order_items['converted_price'] = $r_item['converted_price'];
            $order_items['converted_currency'] = $r_item['converted_currency'];
            $save_order_items = $this->getOrderItemModel()->create($order_items);
//                  dd($save_order_items->id);
            if (!empty($r_item['orderItemAccessories'])) {
                foreach ($r_item['orderItemAccessories'] as $itemAccessorie) {
//                          dd($itemAccessorie);
                    $itemAccessories['order_id'] = $order->id;
                    $itemAccessories['item_id'] = $item->id;
                    $itemAccessories['order_item_id'] = $save_order_items->id;
                    $itemAccessories['quantity'] = !empty($itemAccessorie['accessoires_qty']) ? $itemAccessorie['accessoires_qty'] : 1;
                    $itemAccessories['price'] = (double)$itemAccessorie['price'];
                    $itemAccessories['accessories_id'] = $itemAccessorie['id'];
                    $itemAccessories['en_title'] = $itemAccessorie['en_title'];
                    $itemAccessories['ar_title'] = $itemAccessorie['ar_title'];
                    $itemAccessories['image'] = $itemAccessorie['image'];
                    $itemAccessories['must_purchase'] = !empty($itemAccessorie['must_purchase']) ? $itemAccessorie['must_purchase'] : 0;
                    $save_order_items_accessories = $this->getOrderItemAccessriesModel()->create($itemAccessories);
                }
            }
//              }
//            }
        }

        if ($save_order_items || $save_order_items_accessories) {
            return $this->processOrderLog($request_params, $order);
        }
    }

    /**
     *
     * @param type $item
     * @param type $r_item
     */
    protected function handleRemaingItems($item, $r_item)
    {

        $remaining_stock = (int)$item->quantity - (int)$r_item['quantity'];

        if ($remaining_stock < $item->cart_quantity) {
            if ($remaining_stock == 0) {
                $item->is_sold = 1;
                $item->availability = 0;
            }
            $item->quantity = $remaining_stock;
            $item->cart_quantity = $remaining_stock;
        } else {
            $item->quantity = $remaining_stock;
        }

        return $item->save();
    }

    /**
     * prepareItemIds method
     * @param type $items
     * @return type
     */
    public function prepareItemIds($items)
    {

        $ids = [];

        foreach ($items as $item) {
            $ids[] = $item['uuid'];
        }

        return $ids;
    }

    /**
     * processOrderLog method
     * insert log of a order
     * @param type $request_params
     * @param type $order
     * @return type
     */
    public function processOrderLog($request_params, $order)
    {

        $log = [];
        $log['order_id'] = $order->id;
        $log['user_id'] =  isset($request_params['user_data']->id)?$request_params['user_data']->id:3;
        $log['order_status_id'] = 1;
        $log['comment'] = isset($request_params['user_data']->first_name)?$request_params['user_data']->first_name . $request_params['user_data']->last_name . ' has just placed an order':'placed an order';
        $save_log = $this->getOrderLogModel()->create($log);
        if ($save_log) {

            return $this->processOrderShippingAddress($request_params, $order);
        }
    }

    /**
     * processOrderShippingAddress method
     * prepares addresses for the order
     * @param type $request_params
     * @param type $order
     * @return type
     */
    public function processOrderShippingAddress($request_params, $order)
    {

        $address = [];
        $address['order_id'] = $order->id;
        $address['type'] = 'shipping';
//        $address['country_id'] = !empty($request_params['country_id']) ? $request_params['country_id'] : NULL;
//        $address['city_id'] = !empty($request_params['city_id']) ? $request_params['city_id'] : NULL;
        $address['first_name'] = !empty($request_params['shipping_first_name']) ? $request_params['shipping_first_name'] : NULL;
        $address['last_name'] = !empty($request_params['shipping_last_name']) ? $request_params['shipping_last_name'] : NULL;
        $address['phone_no'] = !empty($request_params['shipping_phone_no']) ? $request_params['shipping_phone_no'] : NULL;
        $address['email'] = !empty($request_params['shipping_email']) ? $request_params['shipping_email'] : NULL;

        $address['lat'] = !empty($request_params['shipping_lat']) ? $request_params['shipping_lat'] : NULL;
        $address['lng'] = !empty($request_params['shipping_lng']) ? $request_params['shipping_lng'] : NULL;
        $address['full_address'] = $request_params['shipping_full_address'];
        $address['state'] = !empty($request_params['shipping_state']) ? $request_params['shipping_state'] : '';
        $address['zip_code'] = $request_params['shipping_zip_code'];
        $address['city'] = !empty($request_params['shipping_city_id']) ? $request_params['shipping_city_id'] : $request_params['shipping_city'];
        $address['country'] = !empty($request_params['shipping_country_id']) ? $request_params['shipping_country_id'] : $request_params['shipping_country'];
        $save_shipping = $this->getOrderAddressModel()->create($address);
        if ($save_shipping) {

            return $this->processOrderBillingAddress($request_params, $order, $address);
        }
    }

    /**
     * processOrderBillingAddress method
     * prepares billing address
     * @param type $request_params
     * @param type $order
     * @param string $address
     * @return type
     */
    public function processOrderBillingAddress($request_params, $order, $address)
    {

        if (isset($request_params['is_same_billing']) && $request_params['is_same_billing'] == true) {
            $address['type'] = 'billing';
            $save_billing = $this->getOrderAddressModel()->create($address);
        } else {
//        dd($request_params);
            $b_address = [];
            $b_address['order_id'] = $order->id;
            $b_address['type'] = 'billing';
            $b_address['first_name'] = !empty($request_params['billing_first_name']) ? $request_params['billing_first_name'] : NULL;
            $b_address['last_name'] = !empty($request_params['billing_last_name']) ? $request_params['billing_last_name'] : NULL;
            $b_address['phone_no'] = !empty($request_params['billing_phone_no']) ? $request_params['billing_phone_no'] : NULL;
            $b_address['email'] = !empty($request_params['billing_email']) ? $request_params['billing_email'] : NULL;
            $b_address['lat'] = !empty($request_params['billing_lat']) ? $request_params['billing_lat'] : NULL;
            $b_address['lng'] = !empty($request_params['billing_lng']) ? $request_params['billing_lng'] : NULL;
            $b_address['full_address'] = $request_params['billing_full_address'];
//            $b_address['city'] = $request_params['billing_city'];
            $b_address['state'] = !empty($request_params['billing_state']) ? $request_params['billing_state'] : $request_params['billing_city'];
            $b_address['zip_code'] = !empty($request_params['billing_zip_code']) ? $request_params['billing_zip_code'] : NULL;
//            $b_address['country'] = $request_params['billing_country'];
            $b_address['city'] = !empty($request_params['billing_city_id']) ? $request_params['billing_city_id'] : $request_params['billing_city'];
            $b_address['country'] = !empty($request_params['billing_country_id']) ? $request_params['billing_country_id'] : $request_params['billing_country'];

            $save_billing = $this->getOrderAddressModel()->create($b_address);
        }
        if ($save_billing) {
            DB::commit();
            return $this->finalizeOrderProcess($request_params, $order);
        }
    }

    /**
     * finalize the process
     * sends email
     * send notifications to user
     * @param type $request_params
     * @param type $order
     * @return type
     */
    protected function finalizeOrderProcess($request_params, $order)
    {

      
        $complete_order = $this->getOrderModel()->getOrderDetailsByColVal('id', $order->id);

        if ($complete_order->cod == 1) {
            // $this->getEmailService()->sendOrderReciepietEmailToUser($order, $request_params);
            // $this->getEmailService()->sendOrderReciepietEmailToAdmin($order, $request_params);
        }
        if(!isset( $request_params['makeGuestUser']) && !empty( $request_params['makeGuestUser']) &&  $request_params['makeGuestUser'] == 1){
        $response['user_token'] = $request_params['user_data']->user_token;
        }
        $response['order_id'] = $complete_order->uuid;
        $response['order_token'] = $complete_order->order_token;
        return $this->jsonSuccessResponse($this->getMessageData('success', $request_params['lang'])['order_placed'], $response);
    }

    /**
     * convertCurrency method covert currency as per user need
     * @return type
     */
    public function convertCurrency()
    {

        $request_params = Input::all();
        $response = $this->fixirConverter($request_params['amount'], $request_params['from_cur'], $request_params['to_cur']);
        if ($response['success']) {
            $data['converted_currency_amount'] = (double)$response['converted_amount'];
            $data['amount'] = $request_params['amount'];
            $data['from_cur'] = $request_params['from_cur'];
            $data['to_cur'] = $request_params['to_cur'];
            return $this->jsonSuccessResponse($this->getMessageData('success', $request_params['lang'])['currency_change'], $data);
        }
        return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['general_error']);
    }

}
