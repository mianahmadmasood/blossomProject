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
    public function getShppimentDetails($order) {

        $details = Smsa::getTracking(['awbNo' => $order->awb_number]);

        return $details->getGetTrackingResult()->getAny();
    }

    /**
     * get AWB number
     * @param type $order
     * @param type $request_params
     * @return type
     */
    public function getPdfFile($order) {

        $details = Smsa::getPDF(['awbNo' => $order->awb_number]);
        $pdf_base64 = $details->getGetPDFResult();
        $filename = $order->order_token . '.pdf';
        $headers = [
            'Content-type' => 'applicaton/pdf',
            'Content-Disposition' => 'attachment; filename=' . $filename,
        ];

        return \Response::make($pdf_base64, 200, $headers);
    }




    /**
     * get AWB number
     * @param type $order
     * @param type $request_params
     * @return type
     */
    public function addShipment($order) {

        $shipmentParams = $this->prepareParameter($order);
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
    protected function prepareParameter($order) {

        $shippingData=$this->prepareResponseCountryCity($order->shipping_address->country,$order->shipping_address->city);

//        dd($shippingData['city']->en_name);
        $shipmentData = [
            'passKey' => env('SMSA_PASSKEY'), // shipment reference in your application
            'sentDate' => date('Y-m-d'), // shipment reference in your application
            'idNo' => $order['order_token'], // shipment reference in your application
            'cZip' => $order->shipping_address->zip_code, // shipment reference in your application
            'refNo' => $order['order_token'], // shipment reference in your application
            'cPOBox' => $order->shipping_address->full_address, // shipment reference in your application
            'cName' => $order->recipient_first_name, // customer name
            'cntry' => 'SA', // shipment country
            'cCity' => $shippingData['city']->en_name, // shipment city, try: Smsa::getRTLCities() to get the supported cities
            'cMobile' => $order->recipient_phone_no, // customer mobile
            'cTel1' => $order->recipient_phone_no, // customer mobile
            'cTel2' => $order->recipient_phone_no, // customer mobile
            'cAddr1' => $order->shipping_address->full_address, // customer address
//            'cAddr2' => $order->shipping_address->full_address, // customer address 2
            'cAddr2' => '', // customer address 2
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
            'cEmail' => $order->recipient_email, // customer email
            'custVal' => $order->shipping_amount, // payment amount if it's cash on delivery, 0 if not cash on delivery
            'carrCurr' => $order->order_currency, // payment amount if it's cash on delivery, 0 if not cash on delivery
            'carrValue' => $order->shipping_amount, // payment amount if it's cash on delivery, 0 if not cash on delivery
            'custCurr' => $order->order_currency, // payment amount if it's cash on delivery, 0 if not cash on delivery
            'insrCurr' => $order->order_currency,
            'insrAmt' => 0,
            'codAmt' => $order->cod == 0 ? 0 : $order->total_amount ,
            'weight' => 8,
            'itemDesc' => 'First testing', // extra description will be printed
        ];
        return $shipmentData;
    }

    public function prepareResponseCountryCity($country,$city)
    {
        $data['country'] = \App\Countries::where('id',  $country)->where('archive', 0)->first();
        $data['city'] = \App\Cities::where('id',  $city)->where('archive', 0)->first();
        return $data;
    }

}
