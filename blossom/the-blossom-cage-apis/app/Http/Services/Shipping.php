<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Shipping
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use SmsaSDK\Smsa;

class Shipping extends Config {

    /**
     * get AWB number
     * @param type $order
     * @param type $request_params
     * @return type
     */
    public function addShipment($order, $request_params) {

        $shipmentParams = $this->prepareParameter($order, $request_params);
        $shipment = Smsa::addShip($shipmentParams);
        $awbNumber = $shipment->getAddShipResult();
        return $awbNumber;
    }

    /**
     * params for add shipment
     * @param type $order
     * @param type $request_params
     * @return type
     */
    protected function prepareParameter($order, $request_params) {


        $shipmentData = [
            'passKey' => env('SMSA_PASSKEY'), // shipment reference in your application
            'sentDate' => date('Y-m-d'), // shipment reference in your application
            'idNo' => $order['order_token'], // shipment reference in your application
            'cZip' => $request_params['shipping_zip_code'], // shipment reference in your application
            'refNo' => $order['order_token'], // shipment reference in your application
            'cPOBox' => $request_params['shipping_full_address'], // shipment reference in your application
            'cName' => $request_params['shipping_first_name'], // customer name
            'cntry' => 'SA', // shipment country
            'cCity' => $request_params['shipping_city'], // shipment city, try: Smsa::getRTLCities() to get the supported cities
            'cMobile' => $request_params['shipping_phone_no'], // customer mobile
            'cTel1' => $request_params['shipping_phone_no'], // customer mobile
            'cTel2' => $request_params['shipping_phone_no'], // customer mobile
            'cAddr1' => $request_params['shipping_full_address'], // customer address
            'cAddr2' => $request_params['shipping_full_address'], // customer address 2
            'sName' => 'Chbib Environmnetal Care Co Ltd.',
            'sContact' => '+966114602086',
            'sAddr1' => 'PO BOX 87096 Riyadh, 11642, Saudi Arabia',
            'sAddr2' => 'PO BOX 87096 Riyadh, 11642, Saudi Arabia',
            'sCity' => 'Riyadh',
            'sPhone' => '+966114602086',
            'sCntry' => 'SA',
            'prefDelvDate' => date('Y-m-d'),
            'gpsPoints' => '24.7260928,46.6878873',
            'shipType' => 'DLV', // shipment type
            'PCs' => 1, // quantity of the shipped pieces
            'cEmail' => $request_params['email'], // customer email
            'custVal' => $request_params['shipping_amount'], // payment amount if it's cash on delivery, 0 if not cash on delivery
            'carrCurr' => $request_params['order_currency'], // payment amount if it's cash on delivery, 0 if not cash on delivery
            'carrValue' => $request_params['shipping_amount'], // payment amount if it's cash on delivery, 0 if not cash on delivery
            'custCurr' => $request_params['order_currency'], // payment amount if it's cash on delivery, 0 if not cash on delivery
            'insrCurr' => $request_params['order_currency'],
            'insrAmt' => 0,
            'codAmt' => $order['cod'] == 0 ? 0 : $request_params['total_amount'],
            'weight' => 8,
            'itemDesc' => 'First testing', // extra description will be printed
        ];
        return $shipmentData;
    }

}
