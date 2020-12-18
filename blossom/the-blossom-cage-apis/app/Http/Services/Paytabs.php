<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Paytabs
 *
 * @author qadeer
 */

use Illuminate\Support\Facades\Input;
use App\Http\Services\Config;
use DB;

class Paytabs extends Config
{

    /**
     * update transaction data
     * transaction data returned by patabs
     * @return type
     */
    public function updateTransactionData()
    {

        $request_params = Input::all();
        $order_data = [];

        DB::beginTransaction();
        $order = $this->getOrderModel()->getOrderDetailsByColVal('order_token', $request_params['order_id']);
        if (!empty($order)) {
            $order->transaction_id = $request_params['transaction_id'];
            $order->transaction_status = !empty($request_params['response_code']) ? $this->responseString($request_params) : NULL;
            $order->transaction_response_code = !empty($request_params['response_code']) ? $request_params['response_code'] : NULL;
            $order->transaction_response_detail = !empty($request_params['detail']) ? $request_params['detail'] : NULL;
            $order->last_4_digits = !empty($request_params['last_4_digits']) ? $request_params['last_4_digits'] : NULL;
            $order->first_4_digits = !empty($request_params['first_4_digits']) ? $request_params['first_4_digits'] : NULL;
            $order->card_brand = !empty($request_params['card_brand']) ? $request_params['card_brand'] : NULL;
            $order->trans_date = !empty($request_params['trans_date']) ? $request_params['trans_date'] : NULL;
            $order->secure_sign = !empty($request_params['secure_sign']) ? $request_params['secure_sign'] : NULL;
            $order->archive = 0;
            if ($order->save()) {
                $this->getEmailService()->sendOrderReciepietEmailToUserUpdate($order, $request_params);
                $this->getEmailService()->sendOrderReciepietEmailToAdminUpdate($order, $request_params);
                DB::commit();
                $order_data = $order->toArray();
                return $this->jsonSuccessResponse($this->getMessageData('success', $request_params['lang'])['payment_success'], $order_data);
            } else {
                DB::rollback();
                return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['general_error']);
            }
        }
        return $this->jsonErrorResponse($this->getMessageData('error', $request_params['lang'])['no_order_found']);
    }

    public function responseString($request_params)
    {
        if ($request_params['response_code'] == 100 || $request_params['response_code'] == 112 || $request_params['response_code'] == 113 || $request_params['response_code'] == 115 || $request_params['response_code'] == 116) {
            return 'succeeded';
        }
        return 'rejected';
    }

    /**
     * storeTransactionData prepares and save IPN data to database
     * @param type $request
     * @return type
     */
    public function storeTransactionData($request)
    {
        try {

            $request_params = $request->all();
            $order_data = [];
            \Log::info('Paytab IPN response');
            \Log::info($request_params);
            $order = $this->getOrderModel()->getOrderDetailsByColVal('order_token', $request_params['order_id']);

            //if empty order return false
            if (empty($order)) {
                return "not saved";
            }

            if ($request_params['response_code'] == 100 || $request_params['response_code'] == 5001 || $request_params['response_code'] == 5002) {
                $payment_status = 'succeeded';
            } elseif ($request_params['response_code'] == 5004 || $request_params['response_code'] == 5000) {
                $payment_status = 'rejected';
            } else {
                $payment_status = 'rejected';
            }
            $order_data['transaction_id'] = $request_params['transaction_id'];
            $order_data['transaction_status'] = $payment_status;
            $order_data['last_4_digits'] = !empty($request_params['last_4_digits']) ? $request_params['last_4_digits'] : NULL;
            $order_data['first_4_digits'] = !empty($request_params['first_4_digits']) ? $request_params['first_4_digits'] : NULL;
            $order_data['card_brand'] = !empty($request_params['card_brand']) ? $request_params['card_brand'] : NULL;

//            $order_data['trans_date'] = ;
            $order_data['trans_date'] = !empty($request_params['trans_date']) ? $request_params['trans_date'] : NULL;
//            $order_data['trans_date'] = !empty($request_params['trans_date']) ? $request_params['trans_date'] : NULL;
//            $order_data['secure_sign'] = !empty($request_params['secure_sign']) ? $request_params['secure_sign'] : NULL;
            $order_data['secure_sign'] = 5894467615196606804011;

            $order_data['archive'] = 0;

//            $update_order = $this->getOrderModel()->where('id','=',(int)$order->id)->update($order_data);

            \DB::enableQueryLog();
            $update_order = $this->getOrderModel()->where('id', $order->id)->update($order_data);
            $LOG = \DB::getQueryLog();


            if ($update_order) {
                $respons_save_inpaytab['response'] = json_encode($LOG);
                DB::table('respons_paytab')->insert($respons_save_inpaytab);
            } else {
                $respons_save_inpaytab['response'] = "Data has not been saved";
                DB::table('respons_paytab')->insert($respons_save_inpaytab);
            }
            $transaction_data = $this->prepareTransactionData($request_params);
            $save_response = $this->getIpnModel()->saveTransactoinData($transaction_data);
            return 'ok';
        } catch (\Illuminate\Database\QueryException $ex) {
            $respons_save_inpaytab['response'] = '-sql-exception-' . $ex->getMessage();
            DB::table('respons_paytab')->insert($respons_save_inpaytab);
        } catch (\Exception $ex) {
            $respons_save_inpaytab['response'] = '-sql-' . $ex->getMessage();
            DB::table('respons_paytab')->insert($respons_save_inpaytab);
            return $this->storeException($ex);
        }
    }
//    public function storeTransactionData($request)
//    {
//        try {
//
//            $request_params = $request->all();
//            $order_data = [];
//            \Log::info('Paytab IPN response');
//            \Log::info($request_params);
//            $order = $this->getOrderModel()->getOrderDetailsByColVal('order_token', $request_params['order_id']);
//
//            //if empty order return false
//            if (empty($order)) {
//                return "not saved";
//            }
//
//            if ($request_params['response_code'] == 100 || $request_params['response_code'] == 5001 || $request_params['response_code'] == 5002) {
//                $payment_status = 'succeeded';
//            } elseif ($request_params['response_code'] == 5004 || $request_params['response_code'] == 5000) {
//                $payment_status = 'rejected';
//            } else {
//                $payment_status = 'rejected';
//            }
//            $order->transaction_id = $request_params['transaction_id'];
//            $order->transaction_status = $payment_status;
//            $order->transaction_response_code = !empty($request_params['response_code']) ? $request_params['response_code'] : NULL;
//            $order->transaction_response_detail = !empty($request_params['detail']) ? $request_params['detail'] : NULL;
//            $order->last_4_digits = !empty($request_params['last_4_digits']) ? $request_params['last_4_digits'] : NULL;
//            $order->first_4_digits = !empty($request_params['first_4_digits']) ? $request_params['first_4_digits'] : NULL;
//            $order->card_brand = !empty($request_params['card_brand']) ? $request_params['card_brand'] : NULL;
//            $order->trans_date = !empty($request_params['trans_date']) ? $request_params['trans_date'] : NULL;
//            $order->secure_sign = !empty($request_params['secure_sign']) ? $request_params['secure_sign'] : NULL;
//            $order->archive = 0;
//            if ($order->save()) {
//                $respons_save_inpaytab['response'] = json_encode($request_params);
//                DB::table('respons_paytab')->insert($respons_save_inpaytab);
//            } else {
//                $respons_save_inpaytab['response'] = "Data has not been saved";
//                DB::table('respons_paytab')->insert($respons_save_inpaytab);
//            }
//            $transaction_data = $this->prepareTransactionData($request_params);
//            $save_response = $this->getIpnModel()->saveTransactoinData($transaction_data);
//            return 'ok';
//        } catch (\Illuminate\Database\QueryException $ex) {
//            $respons_save_inpaytab['response'] = '-sql-exception-' . $ex->getMessage();
//            DB::table('respons_paytab')->insert($respons_save_inpaytab);
//        } catch (\Exception $ex) {
//            $respons_save_inpaytab['response'] = '-sql-' . $ex->getMessage();
//            DB::table('respons_paytab')->insert($respons_save_inpaytab);
//            return $this->storeException($ex);
//        }
//    }

    /**
     * prepareTransactionData method prepares IPN response array to save on EC2
     * @param type $request_params
     * @return array
     */
    public function prepareTransactionData($request_params)
    {
        $data = [];
        $data['uuid'] = \Uuid::generate()->string;
        $data['transaction_id'] = !empty($request_params['transaction_id']) ? $request_params['transaction_id'] : NULL;
        $data['shipping_address'] = !empty($request_params['shipping_address']) ? $request_params['shipping_address'] : NULL;
        $data['shipping_city'] = !empty($request_params['shipping_city']) ? $request_params['shipping_city'] : NULL;
        $data['shipping_country'] = !empty($request_params['shipping_country']) ? $request_params['shipping_country'] : NULL;
        $data['shipping_state'] = !empty($request_params['shipping_state']) ? $request_params['shipping_state'] : NULL;
        $data['shipping_postalcode'] = !empty($request_params['shipping_postalcode']) ? $request_params['shipping_postalcode'] : NULL;
        $data['phone_num'] = !empty($request_params['phone_num']) ? $request_params['phone_num'] : NULL;
        $data['email'] = !empty($request_params['email']) ? $request_params['email'] : NULL;
        $data['customer_name'] = !empty($request_params['customer_name']) ? $request_params['customer_name'] : NULL;
        $data = $this->breackDownPrepareData($data, $request_params);
        return $data;
    }

    /**
     * breackDownPrepareData method continue  prepares IPN response array to save on EC2
     * @param type $data
     * @param type $request_params
     * @return array
     */
    public function breackDownPrepareData($data, $request_params)
    {
        $data['response_code'] = !empty($request_params['response_code']) ? $request_params['response_code'] : NULL;
        $data['detail'] = !empty($request_params['detail']) ? $request_params['detail'] : NULL;
        $data['reference_id'] = !empty($request_params['reference_id']) ? $request_params['reference_id'] : NULL;
        $data['invoice_id'] = !empty($request_params['invoice_id']) ? $request_params['invoice_id'] : NULL;
        $data['amount'] = !empty($request_params['amount']) ? $request_params['amount'] : NULL;
        $data['currency'] = !empty($request_params['currency']) ? $request_params['currency'] : NULL;
        $data['order_id'] = !empty($request_params['order_id']) ? $request_params['order_id'] : NULL;
        $data['customer_email'] = !empty($request_params['customer_email']) ? $request_params['customer_email'] : NULL;
        $data['customer_phone'] = !empty($request_params['customer_phone']) ? $request_params['customer_phone'] : NULL;
        $data['transaction_amount'] = !empty($request_params['transaction_amount']) ? $request_params['transaction_amount'] : NULL;
        $data['transaction_currency'] = !empty($request_params['transaction_currency']) ? $request_params['transaction_currency'] : NULL;
        $data['last_4_digits'] = !empty($request_params['last_4_digits']) ? $request_params['last_4_digits'] : NULL;
        $data['first_4_digits'] = !empty($request_params['first_4_digits']) ? $request_params['first_4_digits'] : NULL;
        $data['card_brand'] = !empty($request_params['card_brand']) ? $request_params['card_brand'] : NULL;
        $data['secure_sign'] = !empty($request_params['secure_sign']) ? $request_params['secure_sign'] : NULL;
        $data['force_accept_datetime'] = !empty($request_params['force_accept_datetime']) ? $request_params['force_accept_datetime'] : NULL;
        $data['refund_req_amount'] = !empty($request_params['refund_req_amount']) ? $request_params['refund_req_amount'] : NULL;
        return $data;
    }

}
