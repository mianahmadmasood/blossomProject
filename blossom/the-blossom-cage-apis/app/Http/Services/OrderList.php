<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of OrderList
 *
 * @author qadeer
 */
use App\Http\Responses\ResponseSingleOrder;
use Illuminate\Support\Facades\Input;
use App\Http\Responses\ResponseOrder;
use App\Http\Services\Config;

class OrderList extends Config {

    /**
     * Injecting related response class
     * @return ResponseItem
     */
    public function jsonResponse($orders, $lang, $orders_count) {
        return new ResponseOrder($orders, $lang, $orders_count);
    }

    /**
     * Injecting related response class
     * @return ResponseItem
     */
    public function jsonResponseSingle($order, $lang) {
        return new ResponseSingleOrder($order, $lang);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $request_params = Input::all();

        if (empty($request_params['user']) && !empty($request_params['email'])) {
            $guest_user = $this->getUserModel()->getUserByColumnValue('email', $request_params['email']);
            if (empty($guest_user)) {
                return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
            } else {
                $request_params['user'] = $guest_user;
            }
        }
        if (empty($request_params['user'])) {
            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
        }
        $request_params['page_no'] = empty($request_params['page_no']) ? 1 : $request_params['page_no'];
        $request_params['user_id'] = $request_params['user']->id;
        $request_params['limit'] = $this->limits['order_limt'];
        $request_params['offset'] = ($request_params['limit'] * $request_params['page_no']) - $this->limits['order_limt'];
        $orders = $this->getOrderModel()->getOrdersList($request_params);

        $orders_count = $this->getOrderModel()->getOrdersListCount($request_params);
        return $this->jsonResponse($orders, $request_params['lang'], $orders_count)->prepareResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $request_params = Input::all();
        $order = $this->getOrderModel()->getOrderDetailsByColVal('uuid', $id);
        if (empty($order)) {

            return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_records_found']);
        }

        return $this->jsonResponseSingle($order, $request_params['lang'])->prepareResponse();
    }

}
