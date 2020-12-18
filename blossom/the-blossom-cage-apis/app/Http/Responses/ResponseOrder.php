<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

/**
 * Description of ResponseOrder
 *
 * @author qadeer
 */
use App\Http\Responses\BaseResponse;
use Illuminate\Database\Eloquent\Collection;

class ResponseOrder extends BaseResponse {

    protected $orders;
    protected $lang;
    protected $count;

    function __construct(Collection $orders, string $lang, int $count) {

        $this->orders = $orders;
        $this->lang = $lang;
        $this->count = $count;
    }

    /**
     * prepareResponse method
     * prepare response for orders
     * @return array
     */
    public function prepareResponse() {

        $response = [];

        foreach ($this->orders as $key => $order) {
            $response[$key]['uuid'] = $order->uuid;
            $response[$key]['order_id'] = $order->order_token;
            $response[$key]['date'] = date('d-m-Y', strtotime($order->created_at));
            $response[$key]['transaction_status'] =   $order->transaction_status;
            $response[$key]['total_amount'] = (double) $order->total_amount;
            $response[$key]['status_id'] = $order->transaction_status != 'rejected' ? $order->order_status_id : 6;
            $response[$key]['order_currency'] = $order->order_currency;
            $response[$key]['converted_total_amount'] = (double) $order->converted_total_amount;
            $response[$key]['payment_mehtod'] = $this->preparePaymentMethod($order);
            $response[$key]['items'] = $this->prepareItemResponse($order);
            $response[$key]['message'] = $this->preparePaymentMessage($order);
        }
        $order_response['orders'] = $response;

        $order_response['count'] = $this->count;
        return $this->jsonSuccessResponse($this->getMessageData('success', $this->lang)['general_success'], $order_response);
    }

    protected function prepareItemResponse($order) {
        $items = [];
        foreach ($order->items as $key => $item) {
            $items[$key]['title'] = $this->lang == 'ar' ? $item->item->ar_title : $item->item->en_title;
            $items[$key]['image'] = $item->item->image->image;
        }
        return $items;
    }

    /**
     *
     * @param type $order
     * @return string
     */
    protected function preparePaymentMethod($order) {
        if ($this->lang == 'ar') {
            if ($order->cod == 1) {
                $response = 'النقدية عند التسليم سمك القد';
            } else {
                $response = 'Paytabas';
            }
        } else {
            if ($order->cod == 1) {
                $response = 'Cash on delivery COD';
            } else {
                $response = 'Paytabas';
            }
        }
        return $response;
    }

    /**
     *
     * @param type $order
     * @return string
     */
    protected function preparePaymentMessage($order) {

        $message = '';
        if ($order->transaction_status == 'rejected') {
            $message = $this->getMessageData('error', $this->lang)['payment_under_review'];
        }
        return $message;
    }

}
