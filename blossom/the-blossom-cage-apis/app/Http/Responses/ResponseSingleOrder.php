<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

/**
 * Description of ResponseSingleOrder
 *
 * @author qadeer
 */

use App\Http\Responses\BaseResponse;
use Illuminate\Database\Eloquent\Model;

class ResponseSingleOrder extends BaseResponse
{

    protected $order;
    protected $lang;

    function __construct(Model $order, string $lang)
    {

        $this->order = $order;
        $this->lang = $lang;
    }

    public function prepareResponse()
    {

        $response = [];
        $response['uuid'] = $this->order->uuid;
        $response['order_id'] = $this->order->order_token;
        $response['date'] = date('Y-m-d', strtotime($this->order->created_at));
        $response['payment_mehtod'] = $this->preparePaymentMethod($this->order);
        $response['shipping_service'] = 'SMSA';
        $response['message'] = $this->preparePaymentMessage();
        $response = $this->prepareResponseConrinue($response);
        $response = $this->prepareResponseCurrency($response);
        $response = $this->prepareItemDetails($response);
        $message = $this->getMessageData('success', $this->lang)['general_success'];
        return $this->jsonSuccessResponse($message, $response);
    }

    /**
     * prepareResponseConrinue method
     * @param type $response
     * @return type
     */
    protected function prepareResponseConrinue($response)
    {

       $shippingData=$this->prepareResponseCountryCity($this->order->shipping_address->country,$this->order->shipping_address->city);

        $response['status_id'] =  $this->order->transaction_status != 'rejected' ? $this->order->order_status_id : 6;
        $response['recipient_phone_no'] = $this->order->recipient_phone_no;
        $response['recipient_first_name'] = $this->order->recipient_first_name;
        $response['recipient_last_name'] = $this->order->recipient_last_name;
        $response['recipient_email'] = $this->order->recipient_email;
        $response['total_amount'] = (double)$this->order->total_amount;
        $response['tax_amount'] = (double)$this->order->tax_amount;
        $response['cod'] = $this->order->cod;
        $response['shipping_amount'] = (double)$this->order->shipping_amount;
        $response['shipping_first_name'] = !empty($this->order->shipping_address->first_name)?$this->order->shipping_address->first_name :$this->order->recipient_first_name;
        $response['shipping_last_name'] = !empty($this->order->shipping_address->last_name)?$this->order->shipping_address->last_name :$this->order->recipient_last_name;
        $response['shipping_phone_no'] = !empty($this->order->shipping_address->phone_no)?$this->order->shipping_address->phone_no :$this->order->recipient_phone_no;
        $response['shipping_email'] = !empty($this->order->shipping_address->email)?$this->order->shipping_address->email :$this->order->recipient_email;
        $response['shipping_address'] = $this->order->shipping_address->full_address;
        $response['shipping_zipcode'] = $this->order->shipping_address->zip_code;
        $response['shipping_city'] =   $this->lang == 'ar' ? $shippingData['city']->ar_name : $shippingData['city']->en_name;
        $response['shipping_state'] =  $this->order->shipping_address->state;
        $response['shipping_country'] =  $shippingData['country']->en_name;
        $response['shipping_country_ar'] =  $shippingData['country']->ar_name;
        $billingData=$this->prepareResponseCountryCity($this->order->billing_address->country,$this->order->billing_address->city);
        $response['billing_first_name'] = !empty($this->order->billing_address->first_name)?$this->order->billing_address->first_name :$this->order->recipient_first_name;
        $response['billing_last_name'] = !empty($this->order->billing_address->last_name)?$this->order->billing_address->last_name :$this->order->recipient_last_name;
        $response['billing_phone_no'] = !empty($this->order->billing_address->phone_no)?$this->order->billing_address->phone_no :$this->order->recipient_phone_no;
        $response['billing_email'] = !empty($this->order->billing_address->email)?$this->order->billing_address->email :$this->order->recipient_email;
        $response['billing_address'] = $this->order->billing_address->full_address;
        $response['billing_zipcode'] = $this->order->billing_address->zip_code;
        $response['billing_city'] =   $this->lang == 'ar' ? $billingData['city']->ar_name : $billingData['city']->en_name;
        $response['billing_state'] =  $this->order->billing_address->state;
        $response['billing_country'] =  $billingData['country']->en_name;
        $response['billing_country_ar'] =  $billingData['country']->ar_name;

        $response['transaction_id'] = !empty($this->order->transaction_id) ? $this->order->transaction_id : '';
        $response['transaction_status'] = $this->order->transaction_status;
        return $response;
    }

    /**
     * prepareResponseConrinue method
     * @param type $response
     * @return type
     */
    protected function prepareResponseCurrency($response)
    {
        $response['order_currency'] = $this->order->order_currency;
        $response['converted_shipping_amount'] = (double)$this->order->converted_shipping_amount;
        $response['converted_tax_amount'] = (double)$this->order->converted_tax_amount;
        $response['converted_total_amount'] = (double)$this->order->converted_total_amount;
        $response['user_email'] = $this->order->user->email;
        return $response;
    }
    /**
     * prepareResponseConrinue method
     * @param type $response
     * @return type
     */
    protected function prepareResponseCountryCity($country,$city)
    {
        $data['country'] = \App\Countries::where('id',  $country)->where('archive', 0)->first();
        $data['city'] = \App\Cities::where('id',  $city)->where('archive', 0)->first();

        return $data;
    }

    /**
     * prepareItemDetails method
     * @param type $response
     * @return type
     */
    protected function prepareItemDetails($response)
    {

        $response['items'] = [];


        foreach ($this->order->items as $key => $order_item) {

            $response['items'][$key]['uuid'] = $order_item->item->uuid;
            $response['items'][$key]['slug'] = $order_item->item->slug;
            $response['items'][$key]['title'] = $this->lang == 'ar' ? $order_item->item->ar_title : $order_item->item->en_title;
            $response['items'][$key]['price'] = (double)$order_item->price;
            $response['items'][$key]['color_code'] = $order_item->color_code;
            $response['items'][$key]['color_name'] = $order_item->color_name;
            $response['items'][$key]['color_image'] = $order_item->color_image;
            $response['items'][$key]['converted_price'] = (double)$order_item->converted_price;
            $response['items'][$key]['converted_currency'] = $order_item->converted_currency;
            $response['items'][$key]['quantity'] = $order_item->quantity;
            $response['items'][$key]['image'] = $order_item->item->image->image;
            $response['items'][$key]['orderItemAccessories'] = $this->prepareItemAccessoriesDetails($order_item->id);
        }
        return $response;
    }

    protected function prepareItemAccessoriesDetails($itemId)
    {

        $response = [];
        $order_item_accessoires = \App\OrderItemAccessries::where('order_item_id', $itemId)->where('archive', 0)->get();
        if (!empty($order_item_accessoires)) {
            foreach ($order_item_accessoires as $key => $order_item_accessoire) {
                $response[$key]['accessories_id'] = $order_item_accessoire->accessories_id;
                $response[$key]['en_title'] = $order_item_accessoire->en_title;
                $response[$key]['ar_title'] = $order_item_accessoire->ar_title;
                $response[$key]['price'] = $order_item_accessoire->price;
                $response[$key]['image'] = $order_item_accessoire->image;
                $response[$key]['quantity'] = $order_item_accessoire->quantity;
                $response[$key]['must_purchase'] = $order_item_accessoire->must_purchase;
            }
            $keys = array_column($response, 'must_purchase');
            array_multisort($keys, SORT_DESC, $response);
        }
//        dd($response);
        return $response;
    }

    /**
     *
     * @param type $order
     * @return string
     */
    protected function preparePaymentMethod($order)
    {
        if ($this->lang == 'ar') {
            if ($order->cod == 1) {
                $response = 'النقدية عند التسليم سمك القد';
            } else {
                $response = 'بيتابس';
            }
        } else {
            if ($order->cod == 1) {
                $response = 'Cash on delivery COD';
            } else {
                $response = 'Paytabs';
            }
        }
        return $response;
    }

    /**
     *
     * @param type $order
     * @return string
     */
    protected function preparePaymentMessage()
    {

        $message = '';

        if ($this->order->transaction_status == 'rejected') {
            $message = $this->getMessageData('error', $this->lang)['payment_under_review'];
        }
        return $message;
    }

}
