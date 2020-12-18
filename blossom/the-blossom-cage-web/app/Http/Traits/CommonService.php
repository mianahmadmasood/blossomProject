<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

use Illuminate\Support\Facades\Response;
use GuzzleHttp\Client;
use App\CodeException;
use Illuminate\Support\Facades\Session;

trait CommonService
{

    public function pageNotFound($message)
    {
        echo "<pre>";
        print_r($message);
        exit;
    }

    public function jsonErrorResponse($error, $code = 204)
    {
        $response = [];
        $response['success'] = false;
        $response['message'] = $error;
        $response['status_code'] = $code;
        return Response::json($response);
    }

    public function jsonSuccessResponse($msg, $data = [], $code = 200)
    {
        $response = [];
        $response['success'] = true;
        $response['data'] = $data;
        $response['message'] = $msg;
        $response['status_code'] = $code;
        return Response::json($response);
    }

    public function jsonSuccessResponseWithoutData($msg, $code = 200)
    {
        $response = [];
        $response['success'] = true;
        $response['message'] = $msg;
        $response['status_code'] = $code;

        return Response::json($response);
    }

    /**
     * storeException method
     * @param type $ex
     */
    public function storeException($ex)
    {
        $this->saveException($ex);
        return redirect()->route('home', ['lang' => session()->get('locale')])->with('error_message', $ex->getMessage());
    }

    /**
     * saveExceptionInDatabase method
     * @param type $ex
     */
    public function saveException($ex)
    {

        $exceptions = new CodeException();
        $exception['exception_file'] = $ex->getFile();
        $exception['exception_line'] = $ex->getLine();
        $exception['exception_message'] = $ex->getMessage();
        $exception['exception_url'] = \Request::url();
        $exception['exception_code'] = $ex->getCode();
        $exception['user_id'] = !empty(\Auth::user()->id) ? \Auth::user()->id : 0;
        $exceptions->create($exception);
    }

    public function guzzleRequest($slug, $method, $params = NULL)
    {

        try {

            $URL = config('config.apis_url') . $slug;
            $client = new Client(['base_uri' => config('config.apis_url')]);
            $res = $client->request($method, $URL, $params);
            $status = $res->getStatusCode();
            if ($status == 200) {
                $resBodyContents = $res->getBody()->getContents();
                $resBodyContents = json_decode($resBodyContents, true);

                return $resBodyContents;
            } else {
                return $this->jsonErrorResponse('Server responded with a status code of ' . $status);
            }
        } catch (RequestException $e) {
            $req = Psr7\str($e->getRequest());
            return $this->jsonErrorResponse($req);
        }
    }

    /**
     *
     * @param type $amount
     * @param type $from_currency
     * @param type $to_currency
     * @return type
     */
    public function fixirConverter($amount, $from_currency, $to_currency)
    {
        try {
            $responnse = [];
            $key = config('paths.fixir_key');
            $from_Currency = urlencode($from_currency);
            $to_Currency = urlencode($to_currency);
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => "https://data.fixer.io/api/latest?access_key=" . $key . "&base=" . $from_Currency . "&symbols=" . $to_Currency,
                // You can set any number of default request options.
                'timeout' => 2.0,
            ]);

            $res = $client->request("GET");
            $resBodyContents = $res->getBody()->getContents();
            $obj = json_decode($resBodyContents, true);
            if ($obj['success'] == true) {
                $one_unit = $obj['rates']["$to_Currency"];
            }
            if (!empty($one_unit) && $one_unit != 0) {
                $responnse['success'] = true;
                $responnse['converted_amount'] = number_format($amount * $one_unit, 2, '.', '');
            } else {
                $responnse['success'] = false;
                $responnse['message'] = $obj['error']['type'];
            }
            return $responnse;
        } catch (\Exception $ex) {
            $responnse['success'] = false;
            $responnse['message'] = $ex->getMessage();
        }
    }

    /**
     * freeConverter method is associated with a free currency converter
     * @param type $amount
     * @param type $from_currency
     * @param type $to_currency
     * @return type
     */
    public function freeConverter($amount, $from_currency, $to_currency)
    {

        $from_Currency = urlencode($from_currency);
        $to_Currency = urlencode($to_currency);
        $query = "{$from_Currency}_{$to_Currency}";

        $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}" . "&apiKey=259d66e2a7cccb4d60dd");
        $obj = json_decode($json, true);
        $val = $obj['results']["$query"]['val'];
        $total = $val * $amount;
        return number_format($total, 2, '.', '');
    }

    /**
     * calculateTotalAmount method calculate shopping total
     *
     * @return type
     */
    public function calculateTotalAmount()
    {

        $total = 0;
        $base_currency_total = 0;
        $items_in_bag = Session::get('items');

        if (!empty($items_in_bag)) {
            foreach ($items_in_bag as $item) {
                $priceAccessoiresMust = 0;
                $priceAccessoires = 0;
                if (!empty($item['orderItemAccessories'])) {
                    foreach ($item['orderItemAccessories'] as $orderItemAccessorie) {
                        if (Session::get('cur_currency') === 'USD') {
                            if(!empty($orderItemAccessorie['must_purchase']) && $orderItemAccessorie['must_purchase'] == 1) {
                                $priceAccessoiresMust = $priceAccessoiresMust + $item['quantity'] * ($orderItemAccessorie['price'] * Session::get('amount_per_unit'));
                            }else{
                                $priceAccessoires = $priceAccessoires + 1 * ($orderItemAccessorie['price'] * Session::get('amount_per_unit'));
                            }
                        } else {
                            if(!empty($orderItemAccessorie['must_purchase']) && $orderItemAccessorie['must_purchase'] == 1) {
                                $priceAccessoiresMust = $priceAccessoiresMust + $item['quantity'] * ($orderItemAccessorie['price'] * Session::get('amount_per_unit'));
                            }else{
                                $priceAccessoires = $priceAccessoires + 1 * ($orderItemAccessorie['price'] * Session::get('amount_per_unit'));
                            }
                        }
                    }
                }

                if (Session::get('cur_currency') === 'USD') {
                    $price = $item['quantity'] * ($item['price'] * Session::get('amount_per_unit'));
                } else {
                    $price = $item['quantity'] * $item['price'];
                }

                $base_currency_total = $base_currency_total + ($item['price'] * $item['quantity']) + $priceAccessoiresMust + $priceAccessoires;
                $total = round($total + $price + $priceAccessoiresMust + $priceAccessoires, 2);

            }
        }

        Session::put('total', $total);
        Session::put('bc_currency_total', $base_currency_total);
        return $total;
    }

    /**
     * calculateTotalAmount method calculate shopping total
     *
     * @return type
     */
    public function calculateShippingAmount()
    {


        $kgs = 1;
        $total_cost = 0;
        $bc_shipping_cost = 0;
        $shipping_threshold = config('paths.shipping_threshold');
        $shipping_cost = config('paths.shipping_cost');
        $items_in_bag = Session::get('items');
        if (!empty($items_in_bag)) {
            foreach ($items_in_bag as $item) {
                if ($item['weight_unit'] == 'g') {
                    $kgs = 0.001;
                }
                $i_weight = $item['weight'] * $kgs;
                $total_i_weight = $i_weight * $item['quantity'];
                if ($total_i_weight > $shipping_threshold) {
                    $item_shipping_cost = $shipping_cost + ($total_i_weight - $shipping_threshold);
                } else {
                    $item_shipping_cost = $shipping_cost;
                }
                $bc_shipping_cost = $bc_shipping_cost + $item_shipping_cost;
                $item_shipping_cost = $item_shipping_cost * Session::get('amount_per_unit');
                $total_cost = $total_cost + $item_shipping_cost;
                $total_cost = round($total_cost, 2);
                $bc_shipping_cost = round($bc_shipping_cost, 2);
            }
        }

        Session::put('shipping_cost', $total_cost);
        Session::put('bc_shipping_cost', $bc_shipping_cost);
        return $total_cost;
    }

    /**
     * calculateTaxAmount method calculate tax
     *
     * @return type
     */
    protected function calculateTaxAmount()
    {

        //TAX ratio
        $tax_ratio = config('paths.tax') / 100;
        //Total amount as per current currency
        $total = Session::get('total') + Session::get('shipping_cost');
        //base currency total amount
        $bc_total = Session::get('bc_currency_total') + Session::get('bc_shipping_cost');
        //Tax amount for current currency
        $total_tax = round(($tax_ratio * $total), 2);
        //Tax amount for base currency
        $bc_total_tax = round(($tax_ratio * $bc_total), 2);
        Session::put('tax_amount', $total_tax);
        Session::put('bc_tax_amount', $bc_total_tax);
        return $total_tax;
    }

    public function rocketApi($request_params){

        $url = 'http://ec2-52-59-80-9.eu-central-1.compute.amazonaws.com/api/storeApi';
        $request_data = [
            'form_params' => $request_params,
            'headers' => [
                'apikey' => 'l/7k0yV3zh/bmfDrTB/h+SjBPRyatqQqGLp5EHDaIGI=',
                'lang' => Session::get('locale')
            ]
        ];

        $client = new Client(['base_uri' => config('config.apis_url')]);
        $res = $client->request('POST', $url, $request_data);
        $status = $res->getStatusCode();
        if ($status == 200) {
            $resBodyContents = $res->getBody()->getContents();
            $resBodyContents = json_decode($resBodyContents, true);
            return $resBodyContents;
        } else {
            return $this->jsonErrorResponse('Server responded with a status code of ' . $status);
        }
    }

}
