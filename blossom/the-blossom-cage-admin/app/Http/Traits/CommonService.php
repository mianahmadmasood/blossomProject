<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

use Illuminate\Support\Facades\Response;
use DateTime;
use Mail;
use GuzzleHttp\Client;
use App\CodeException;
use mysql_xdevapi\Exception;


trait CommonService {

    protected $emails = [
//        'admin_email' => 'ahmad.masood@ilsainteractive.com',
        'admin_email' => 'admin@maggsha.com',
        'support_email' => 'info@maggsha.com',
        'site_title' => 'Maggsha',
        'regx' => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD',
    ];

    /**
     * 
     * @param \Exception $ex
     */
    public function exception(\Exception $ex) {
        return view('errors.exceptions', compact('ex'));
    }

    public function jsonErrorResponse($error) {
        $response = array();
        $response['success'] = "false";
        $response['message'] = $error;
        return Response::json($response);
    }

    public function jsonSuccessResponse($msg, $data = []) {
        $response['success'] = true;
        $response['data'] = $data;
        $response['message'] = $msg;
        return Response::json($response);
    }

    public function jsonSuccessResponseWithoutData($msg) {
        $response = array();
        $response['success'] = "true";
        $response['message'] = $msg;
        return Response::json($response);
    }

    public function prepareSlug($title) {
        $r_spaces_b = (ltrim($title));
        $text = (trim($r_spaces_b));
//        $text = str_replace(' ', '', $text);
        $clean_strin = preg_replace('/[^A-Za-z0-9\-]/', ' ', $text);
//        $clean_strin = preg_replace('/[^\x{0600}-\x{06FF}A-Za-z0-9 !@#$%^&*()]/u', ' ', $text);
        $slug = str_replace(' ', '_', $clean_strin);
        return strtolower($slug);
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
          
            return true;
        }
    }

    /**
     * 
     * @param type $datetime
     * @param type $timezone
     * @param type $tz2
     * @return type
     */
    public function datetimeConvertToAnotherTimezone($datetime, $timezone, $tz2) {
        $date = new DateTime($datetime, new \DateTimeZone($timezone));
        $date->setTimezone(new \DateTimeZone($tz2));
        $result = $date->format('Y-m-d H:i:s');
        date_default_timezone_set('UTC');
        return $result;
    }
    /**
     *
     * @param type $datetime
     * @param type $timezone
     * @param type $tz2
     * @return type
     */
    public function guzzleRequest($slug, $method, $params = NULL) {

        try {

            $URL = $slug;
            $client = new \GuzzleHttp\Client();
            $res = $client->request($method, $URL, ['form_params'=>$params]);

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

    public function calculateSalePrice($request_params)
    {


        if(!empty($request_params['sale_price']) && !empty($request_params['discounted_type'])){
            $discount_type=$request_params['discounted_type'];
            if($discount_type != 'fixed'){
                $request_params['discount']=$request_params['sale_price'];

                $percentage = (($request_params['sale_price']/100)*$request_params['price']);

                $dec = ($request_params['price'] - $percentage);
//                $result=(($dec/$request_params['price'])*100);
//                $result =($request_params['price'] * 100.0) / (100 + $request_params['sale_price']);

                $request_params['sale_price']=$dec;
        }else{

            $dec = ($request_params['price'] - $request_params['sale_price']);
            $request_params['discount']=$request_params['sale_price'];
            $request_params['sale_price']=$dec;
        }
     }else{
            $request_params['discount']=0;
            $request_params['sale_price']=0;
            $request_params['discounted_type']=null;
        }

        return $request_params;
    }

}
