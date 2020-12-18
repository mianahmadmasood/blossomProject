<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Home
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Auth;
use GuzzleHttp\Client;

class Home extends Config {

    protected $headers;

    function __construct() {
        if (Auth::check()) {
            $this->headers = [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => Auth::user()->user_token
            ];
        } else {
            $this->headers = [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale')
            ];
        }
    }

    /**
     * getCategories get get category for home page
     *
     * @return type
     */
    public function getCategories() {

        $request_data['headers'] = $this->headers;
        $response = $this->guzzleRequest('categories', 'GET', $request_data);
        $request_data['headers'] = $this->headers;
        $response_items = $this->guzzleRequest('items/featured/list', 'GET', $request_data);
        $response_brands = $this->guzzleRequest('brands', 'GET', $request_data);
        $featured_items = $response_items['data']['items'];
        $brands = $response_brands['data']['brands'];
        if ($response['success'] == true) {
            return view('pages.home', compact('response', 'featured_items','brands'));
        } else {
            return redirect()->route('home', ['lang' => session()->get('locale')])->with('error_message', $response['message']);
        }
    }

    public function index() {
        Session::forget('homefeedsDate');
     
        $request_params = Input::all();
        if (!empty($request_params['pages'])) {

            $url = 'items/featured/list?' . $request_params['page_no'];
        } else {
            $url = 'items/featured/list';
        }
        $request_data['headers'] = $this->headers;
        $response = $this->guzzleRequest($url, 'GET', $request_data);
        
        $response['homefeeds'] = $this->guzzleRequest('homefeeds', 'GET', $request_data);
        $homefeedsCategories=!empty($response['homefeeds']['data']['homefeedsCategories'])?$response['homefeeds']['data']['homefeedsCategories']:null;
        Session::put('homefeedsDate', $homefeedsCategories);
       
        
        if ($response['success'] == true) {
           
            return View('welcome', compact('response'));
        } else {
            return redirect()->route('contact', ['lang' => session()->get('locale')])->with('error_message', $response['message']);
        }
    }

    /**
     *
     * @return type
     */


    public function localeCurrentValue() {
        $request_params = Input::except('_token');
        $new_locale = Session::get('old_locale');
        return $this->jsonSuccessResponse('locale Current Value has been changed', ['new_locale'=>$new_locale]);
    }



    public function getrocketapi() {
        $this->headers = [
            'apikey' => 'l/7k0yV3zh/bmfDrTB/h+SjBPRyatqQqGLp5EHDaIGI=',
            'lang' => Session::get('locale')
        ];

        $url = 'http://localhost/testshipingrates/api/test';
        $request_data['headers'] = $this->headers;
        $client = new Client(['base_uri' => config('config.apis_url')]);
        $res = $client->request('GET', $url, $request_data);
        $status = $res->getStatusCode();

        if ($status == 200) {
            $resBodyContents = $res->getBody()->getContents();
            $resBodyContents = json_decode($resBodyContents, true);
            return $resBodyContents;
        } else {
            return $this->jsonErrorResponse('Server responded with a status code of ' . $status);
        }
    }


    public function changeLocale() {

        $request_params = Input::except('_token');
        Session::forget('old_locale');

        if ($request_params['lang'] == 'ar') {
            $old_locale = 'en';
        } else {
            $old_locale = 'ar';
        }

        $new_locale = strtolower($request_params['lang']);
        Session::put('old_locale', $new_locale);
        $array = explode('/', $request_params['url']);
        foreach ($array as $index) {
            if ($index == $old_locale) {
                $index = $new_locale;
            }
            $new_array[] = $index;
        }
        $final_url = implode('/', $new_array);
        return $this->jsonSuccessResponse('locale has been changed', ['url' => $final_url,'new_locale'=>$new_locale]);
    }

    /**
     * change web currency
     * @return type
     */
    public function changeCurrency() {

        $request_params = Input::except('_token');
        if ($request_params['currency'] == 'SAR') {
            $old_curr = 'USD';
        } else {
            $old_curr = 'SAR';
        }
        if ($request_params['currency'] === 'USD') {
            $currency_unit = $this->fixirConverter(1, 'SAR', 'USD');
            Session::put('cur_currency', 'USD');
            Session::put('amount_per_unit', $currency_unit['converted_amount']);
        } else {
            Session::put('cur_currency', 'SAR');
            Session::put('amount_per_unit', 1);
        }
        $this->calculateTotalAmount();
        $this->calculateShippingAmount();
        $this->calculateTaxAmount();
        return $this->jsonSuccessResponse('locale has been changed', ['url' => $request_params['url']]);
    }

    /**
     * render about us page
     * @return type
     */
    public function about() {

        $request_data['headers'] = $this->headers;
        $response_items = $this->guzzleRequest('items/featured/list', 'GET', $request_data);
        if ($response_items['success'] == true) {
            $featured_items = array_slice($response_items['data']['items'], 0, 4);
            return view('about', compact('featured_items'));
        } else {
            return redirect()->route('home', ['lang' => session()->get('locale')])->with('error_message', $response_items['message']);
        }
    }

}
