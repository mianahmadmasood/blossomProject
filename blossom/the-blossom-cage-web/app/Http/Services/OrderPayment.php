<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of OrderPayment
 *
 * @author qadeer
 */

use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use Session;

class OrderPayment extends Config
{

    /**
     * show success page
     * @return view
     */
    public function success()
    {

        $request_params = Input::all();
        \Log::info($request_params);
        app()->setLocale(Session::get('locale'));
        $cod = session()->get('cod');
        if ($cod == true) {
            return $this->processCODsuccess();
        }
        if (!empty($request_params['response_code']) && $request_params['response_code'] == 100 && !empty($request_params['transaction_id'])) {
            return $this->paymentAccepted($request_params);
        } else if(!empty($request_params['response_code']) && $request_params['response_code'] != 100) {
            return $this->paymentRejected($request_params);
        }else{

            return redirect()->route('searchItem', ['lang' => Session::get('locale')]);
        }

    }

    /**
     * process redirection after COD
     * Order Placement
     * @return type
     */
    protected function processCODsuccess()
    {
        $order_token = Session::get('order_token');
        $order_id = Session::get('order_id');
        session()->forget('cod');
        session()->forget('old_order_id');
        $this->clreaCart();
        return view('pages.orderSucess', compact('order_token', 'order_id'));
    }

    /**
     * clear cart
     *
     */
    protected function clreaCart()
    {
        Session::forget('items');
        Session::forget('total');
        Session::forget('order_token');
    }

    /**
     * payment Rejected
     * @param type $request_params
     * @return type
     */
    protected function paymentRejected($request_params)
    {
        $order_token = Session::get('order_token');
        $order_number = $this->getOrderModel()->where('order_token', $request_params['order_id'])->first();
        $order_id = Session::get('order_uuid');
        $locale = Session::get('locale');
        return redirect()->route('orderDetails', ['lang' => $locale, 'uuid' => $order_number->uuid])->with('error_message', $request_params['response_message']);
    }

    /**
     * payment Accepted
     * @param type $request_params
     * @return type
     */
    protected function paymentAccepted($request_params)
    {

//        $order_token = Session::get('order_token');
//        $order_id = Session::get('order_id');
        $locale = Session::get('locale');
//        if (empty($order_token)) {
//            return redirect()->route('searchItem', ['lang' => $locale]);
//        }
        $update_transaction = $this->updateOrderTransaction($request_params);

        if ($update_transaction['success'] == true) {
            session()->forget('items');
            session()->forget('total');
            session()->forget('order_token');
            session()->forget('old_order_id');
            $order_token = $update_transaction['data']['order_token'];
            $order_id = $update_transaction['data']['uuid'];
            return view('pages.orderSucess', compact('order_token', 'order_id'));
        }
        return redirect()->back()->with('error_message', $this->getMessageData('error', $locale)['general_error']);
    }

    /**
     * payment Suspicious
     * @param type $request_params
     * @return type
     */
    protected function paymentSuspicious($request_params)
    {

//        $order_token = Session::get('order_token');
//        $order_id = Session::get('order_id');
        $locale = Session::get('locale');
//        if (empty($order_token)) {
//            return redirect()->route('searchItem', ['lang' => $locale]);
//        }
        $update_transaction = $this->updateOrderTransaction($request_params);
        if ($update_transaction['success'] == true) {
            Session::forget('items');
            Session::forget('total');
            Session::forget('order_token');
            Session::forget('old_order_id');
            Session::save();
            $order_token = $update_transaction['data']['order_token'];
            $order_id = $update_transaction['data']['uuid'];
            $message = $this->getMessageData('error', $locale)['transaction_under_review'];
            return view('pages.orderError', compact('order_token', 'order_id', 'message'));
        }
        return redirect()->back()->with('error_message', $this->getMessageData('error', $locale)['general_error']);
    }

    /**
     * updateOrderTransaction
     * update order response from pay tabs
     */
    protected function updateOrderTransaction($request_params)
    {


        $request_data = [
            'form_params' => $request_params,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
            ]
        ];
        return $this->guzzleRequest('orders/update', 'PUT', $request_data);
    }

}
