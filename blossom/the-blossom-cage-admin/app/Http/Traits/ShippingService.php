<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

use SmsaSDK\Smsa;

trait ShippingService {

    /**
     * get AWB number
     * @param type $order
     * @param type $request_params
     * @return type
     */
    public function getShppimentStatus($order) {

        $shipping = Smsa::getTracking(['awbNo' => $order->awb_number]);
        $response = $shipping->getGetTrackingResult()->getAny();
        $array_data = $this->xmlToArray($response);
        if (!empty($array_data['NewDataSet']['Tracking'])) {
            return $array_data['NewDataSet']['Tracking'];
        } else {
            return null;
        }
    }

    /**
     * convert shipping xml convert to array
     * @param type $xml
     * @return type
     */
    public function xmlToArray($xml) {
        $xml_obj = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml_obj);
        return json_decode($json, TRUE);
    }

    /**
     * insert record in the logs table
     * @param type $order
     */
    public function updateShippingStatus($current_status,$order) {

        if (($order->shipping_status !== $current_status['Activity']) || ($order->shipping_status === null)) {
            $order->shipping_status = $current_status['Activity'];
            $order->shipping_details = $current_status['Details'];
            $order->save();
            $this->saveShippingStatus($current_status,$order);
            return true;
        }
        return false;
    }
    /**
     * insert record in the logs table
     * @param type $order
     */
    public function saveShippingStatus($current_status,$order) {
        $logs = [];
        $logs['uuid'] = \Uuid::generate()->string;
        $logs['user_id'] = 1;
        $logs['order_id'] = $order->id;
        $logs['order_status_id'] = $order->order_status_id;
        $logs['status_activity'] = $current_status['Activity'];
        $logs['comment'] = $order->shipping_details;
        $logs['location'] = $current_status['Location'];
        $logs['date'] = $current_status['Date'];
        $logs['type'] = 'shipping';
        return \DB::table('order_statuses_log')->insert($logs);
    }

}
