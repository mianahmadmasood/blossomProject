<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use Mail;
use GuzzleHttp\Client;

trait CommonService {

    public $limits = [
        'order_limt' => 10,
        'items_limt' => 24,
        'items_featured_limit' => 12,
    ];
    protected $emails = [

//        'admin_email' => 'admin@Blossomcage.com',
//        'admin_email' => 'ahmad.masood@ilsainteractive.com',
//        'admin_email' => 'qadeer.sipra@ilsainteractive.com',
//        'admin_email' => 'ahmad.masood@ilsainteractive.com',
        'admin_email' => 'meer.aali@ilsainteractive.com',
//        'admin_email' => 'muhammmad.abdullah@ilsainteractive.com',
        'support_email' => 'info@Blossomcage.com',
        'site_title' => 'Blossomcage',
    ];

    /**
     * jsonErrorResponse method
     * @param type $error
     * @param type $code
     * @return Response
     */
    public function jsonErrorResponse($error, $code = 2044) {
        $response = [];
        $response['success'] = false;
        $response['message'] = $error;
        $response['status_code'] = $code;
        return Response::json($response);
    }

    /**
     * jsonSuccessResponse method
     * @param type $msg
     * @param type $data
     * @param type $code
     * @return type
     */
    public function jsonSuccessResponse($msg, $data = [], $code = 200) {
        $response = [];
        $response['success'] = true;
        $response['data'] = $data;
        $response['message'] = $msg;
        $response['status_code'] = $code;
        return Response::json($response);
    }

    /**
     * jsonSuccessResponseWithoutData method
     * @param type $msg
     * @return type
     */
    public function jsonSuccessResponseWithoutData($msg, $code = 200) {
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
    public function storeException($ex) {

        $this->saveException($ex);
        return $this->jsonErrorResponse($ex->getMessage() . $ex->getLine() . $ex->getFile());
    }

    /**
     * saveExceptionInDatabase method
     * @param type $ex
     */
    public function saveException($ex) {

        $code_exception = new \App\CodeException();
        \DB::beginTransaction();
        $exception['exception_file'] = $ex->getFile();
        $exception['exception_line'] = $ex->getLine();
        $exception['exception_message'] = $ex->getMessage();
        $exception['exception_url'] = Request::url();
        $exception['user_id'] = !empty(Request::get('user')) ? Request::get('user')->id : 0;
        $exception['exception_code'] = $ex->getCode();
        $code_exception->create($exception);
        \DB::commit();
    }

    public function randomStrings($length_of_string) {

// String of all alphanumeric character
        $str_result = '0123456789ABCDEF';

// Shufle the $str_result and returns substring
// of specified length
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }

    /**
     * sendEmail method
     * @param type $template
     * @param type $data
     * @param type $attachment
     * @return boolean
     */
    public function sendEmail($template, $data, $attachment = null) {
        try {
            $support_email = $this->emails['support_email'];
            $site_title = $this->emails['site_title'];
            Mail::send('emails.' . $template, ['data' => $data], function($message) use ($support_email, $site_title, $data) {
                $message->from($support_email, $site_title);
                $message->subject($data['subject']);
                $message->to($data['email']);
                if (!empty($attachment)) {
                    $message->attach($attachment);
                }
            });
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     *
     * @param type $amount
     * @param type $from_currency
     * @param type $to_currency
     * @return type
     */
    public function fixirConverter($amount, $from_currency, $to_currency) {
        try {
            $responnse = [];
            $key = 'edd0fc7d0d84095e46ba183cfe6701d0';
            $from_Currency = urlencode($from_currency);
            $to_Currency = urlencode($to_currency);
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => "http://data.fixer.io/api/latest?access_key=" . $key . "&base=" . $from_Currency . "&symbols=" . $to_Currency,
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
    public function freeConverter($amount, $from_currency, $to_currency) {

        $from_Currency = urlencode($from_currency);
        $to_Currency = urlencode($to_currency);
        $query = "{$from_Currency}_{$to_Currency}";

        $json = file_get_contents("http://free.currconv.com/api/v7/convert?q={$query}" . "&apiKey=259d66e2a7cccb4d60dd");
        $obj = json_decode($json, true);
        $val = $obj['results']["$query"]['val'];
        $total = $val * $amount;
        return number_format($total, 2, '.', '');
    }

}
