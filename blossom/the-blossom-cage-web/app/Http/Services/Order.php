<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Order
 *
 * @author qadeer
 */

use App\Http\Services\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Services\Checkout;
use Auth;

class Order extends Config
{

    protected $headers;
    protected $checkoutService;

    function __construct()
    {
        $this->headers = [
            'apikey' => config('config.apikey'),
            'lang' => Session::get('locale')
        ];
        $this->checkoutService = new Checkout();
    }

    /**
     * placeOrder method
     * use to place order
     * @return type
     */
    public function placeOrder()
    {
        $request_params = Input::except('_token');

        if(empty($request_params)) {
               return redirect()->back()->withInput($request_params)->with('error_message', $this->getMessageData('error', session()->get('locale'))['general_error_on_checkout_page']);
        }
        if (!Auth::check()) {
            $request_params['is_guest_login'] = 1;
        }
        if (empty(session()->get('items'))) {
            return redirect()->route('home', ['lang' => session()->get('locale')])->with('error_message', $this->getMessageData('error', session()->get('locale'))['add_item']);
        }
        //PREPARING ITEM INFORMATION DATA
        $items_arr = $this->prepareItemsDetails();

        //PLACING ORDER PARAMS
        $request_params = $this->prepareOrderParams($request_params, $items_arr);
        $this->putShippingInSession($request_params);
        return $this->processPlaceOrder($request_params);
    }

    /**
     * prepares items details to book order
     * @return array
     */
    protected function prepareItemsDetails()
    {

        $items_arr = [];
        $items_in_bag = Session::get('items');
//        dd($items_in_bag);
        foreach ($items_in_bag as $key => $item) {
            $items_arr[$key]['uuid'] = $item['uuid'];
            $items_arr[$key]['quantity'] = $item['quantity'];
            $items_arr[$key]['price'] = $item['price'];
            $items_arr[$key]['color_id'] = !empty($item['color_id']) ? $item['color_id'] : null;
            $items_arr[$key]['color_name'] = !empty($item['color_name']) ? $item['color_name'] : null;
            $items_arr[$key]['color_code'] = !empty($item['color_code']) ? $item['color_code'] : null;
            $items_arr[$key]['color_quantity'] = !empty($item['color_quantity']) ? $item['color_quantity'] : null;
            $items_arr[$key]['color_image'] = !empty($item['color_image']) ? $item['color_image'] : null;
            $items_arr[$key]['undiscounted_price'] = !empty($item['undiscounted_price']) ? $item['undiscounted_price'] : $item['price'];
            $items_arr[$key]['undiscounted_converted_price'] = !empty($item['undiscounted_price']) ? $item['undiscounted_price'] * Session::get('amount_per_unit') : $item['price'] * Session::get('amount_per_unit');
            $items_arr[$key]['converted_price'] = $item['price'] * Session::get('amount_per_unit');
            $items_arr[$key]['converted_currency'] = Session::get('cur_currency');
            $items_arr[$key]['orderItemAccessories'] = !empty($item['orderItemAccessories']) ? $item['orderItemAccessories'] : null;
            $items_arr[$key]['image'] = !empty($item['image']) ? $item['image'] : null;
            $items_arr[$key]['weight'] = !empty($item['weight']) ? $item['weight'] : null;
            $items_arr[$key]['weight_unit'] = !empty($item['weight_unit']) ? $item['weight_unit'] : null;
            $items_arr[$key]['lenght'] = !empty($item['lenght']) ? $item['lenght'] : null;
            $items_arr[$key]['height'] = !empty($item['height']) ? $item['height'] : null;
            $items_arr[$key]['width'] = !empty($item['width']) ? $item['width'] : null;
            $items_arr[$key]['orientation_unit'] = !empty($item['orientation_unit']) ? $item['orientation_unit'] : null;
            $items_arr[$key]['en_title'] = !empty($item['en_title']) ? $item['en_title'] : null;
        }
        return array_values($items_arr);
    }

    /**
     * prepareOrderParams method
     * @param type $request_params
     * @param type $items_arr
     * @return type
     */
    protected function prepareOrderParams($request_params, $items_arr)
    {
//        dd($request_params);
        $request_params['items'] = $items_arr;
        $request_params['shipping_amount'] = Session::get('bc_shipping_cost');
        $request_params['tax_amount'] = Session::get('bc_tax_amount');
        $request_params['total_amount'] = Session::get('bc_currency_total') + Session::get('bc_shipping_cost') + Session::get('bc_tax_amount');
        $request_params['payment_method'] = $request_params['payment_method'];
        if (!empty($request_params['shipping_country'])) {
            $countryArray = explode('-', $request_params['shipping_country']);
            if (session()->get('locale') == 'ar') {
                $request_params['shipping_country'] = $countryArray[2];
            } else {
                $request_params['shipping_country'] = $countryArray[1];
            }
            $request_params['shipping_country_id'] = $countryArray[0];
        }
        if (!empty($request_params['shipping_city'])) {
            $cityArray = explode('-', $request_params['shipping_city']);
            if (session()->get('locale') == 'ar') {
                $request_params['shipping_city'] = $cityArray[2];
            } else {
                $request_params['shipping_city'] = $cityArray[1];
            }
            $request_params['shipping_city_id'] = $cityArray[0];
        }
        if (!empty($request_params['billing_country'])) {
            $countryArray = explode('-', $request_params['billing_country']);
            if (session()->get('locale') == 'ar') {
                $request_params['billing_country'] = $countryArray[2];
            } else {
                $request_params['billing_country'] = $countryArray[1];
            }
            $request_params['billing_country_id'] = $countryArray[0];
        }
        if (!empty($request_params['billing_city'])) {
            $cityArray = explode('-', $request_params['billing_city']);
            if (session()->get('locale') == 'ar') {
                $request_params['billing_city'] = $cityArray[2];
            } else {
                $request_params['billing_city'] = $cityArray[1];
            }
            $request_params['billing_city_id'] = $cityArray[0];
        }

        if (Session::get('cur_currency') !== 'SAR') {
            $request_params['order_currency'] = Session::get('cur_currency');
            $request_params['converted_shipping_amount'] = Session::get('shipping_cost');
            $request_params['converted_tax_amount'] = Session::get('tax_amount');
            $request_params['converted_total_amount'] = Session::get('total') + Session::get('shipping_cost') + Session::get('tax_amount');
        } else {
            $request_params['order_currency'] = Session::get('cur_currency');
            $request_params['converted_shipping_amount'] = Session::get('bc_shipping_cost');
            $request_params['converted_tax_amount'] = Session::get('bc_tax_amount');
            $request_params['converted_total_amount'] = Session::get('bc_currency_total') + Session::get('bc_shipping_cost') + Session::get('bc_tax_amount');
        }
        return $request_params;
    }

    /**
     * put shipping address to session
     * @param type $request_params
     * @return boolean
     */
    public function putShippingInSession($request_params)
    {

        if (isset($request_params['payment_method'])) {
            Session::forget('payment_method');
        }

        if (!empty($request_params['is_guest_login']) && $request_params['is_guest_login'] == 1) {

            Session::put('first_name', $request_params['first_name']);
            Session::put('last_name', $request_params['last_name']);
            Session::put('email', $request_params['email']);
            Session::put('phone_no', $request_params['phone_no']);
        }

        Session::put('shipping_first_name', $request_params['shipping_first_name']);
        Session::put('shipping_first_name', $request_params['shipping_last_name']);
        Session::put('shipping_first_name', $request_params['shipping_phone_no']);
        Session::put('shipping_country', $request_params['shipping_country']);
        Session::put('shipping_full_address', $request_params['shipping_full_address']);
        Session::put('shipping_zip_code', $request_params['shipping_zip_code']);
        Session::put('shipping_state', $request_params['shipping_state']);
        Session::put('shipping_city', $request_params['shipping_city']);

        Session::put('payment_method', $request_params['payment_method']);
        if (!empty($request_params['old_order_id'])) {
            $this->getOrderModel()->where('uuid', $request_params['old_order_id'])->update(['archive' => 1]);
        }
        return true;
    }

    /**
     * prepareRequestParamsForGuest method
     * prepares data for quest user
     * @param type $request_params
     * @return array
     */
    public function prepareRequestParamsForGuest($request_params)
    {

        $request_data = [
            'form_params' => $request_params,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
            ]
        ];

        return $request_data;
    }

    /**
     * prepareRequestForAuthUser method
     * prepares data for auth user
     * @param type $request_params
     * @return array
     */
    public function prepareRequestForAuthUser($request_params)
    {

        $request_data = [
            'form_params' => $request_params,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => Auth::user()->user_token
            ]
        ];

        return $request_data;
    }

    /**
     * processPlaceOrder method
     * continue to place orders
     * @param type $request_params
     * @return type
     */
    public function processPlaceOrder($request_params)
    {
        if (!empty($request_params['is_guest_login']) && $request_params['is_guest_login'] == 1) {
            $request_data = $this->prepareRequestParamsForGuest($request_params);
        } else {
            $request_data = $this->prepareRequestForAuthUser($request_params);
        }
        $order_response = $this->guzzleRequest('orders/store', 'POST', $request_data);
        if(!empty($request_params['checkboxG4Api'])) {
            $order_respons = $this->rocketApi($request_params);
        }
        if ($order_response['success'] == true && $order_response['status_code'] == 601) {
            $this->checkoutService->updateCartQuantity($order_response['data']['items']);
            Session::put('outof_stock_items', $order_response['data']['items']);
            return redirect()->route('viewBag', ['lang' => Session::get('locale')]);
        } else if ($order_response['success'] == true && $order_response['status_code'] == 602) {
            return $this->processOrderForSucess($request_params, $order_response);
        } elseif ($order_response['success'] == true && $order_response['status_code'] == 200) {
            return $this->processOrderForSucess($request_params, $order_response);
        } else {
            return redirect()->back()->withInput($request_params)->with('error_message', $order_response['message']);
        }
    }

    /**
     * processOrderForSucess method
     * @param type $params
     * @param type $response
     * @return mixed
     */
    protected function processOrderForSucess($params, $response)
    {

        session()->put('order_id', $response['data']['order_id']);
        session()->put('order_token', $response['data']['order_token']);
        $payment_method = (int)$params['payment_method'];
        if ($payment_method === 1) {
            session()->put('cod', true);
            return redirect()->route('orderSucess', ['lang' => Session::get('locale')]);
        } elseif ($payment_method === 0) {
            session()->put('old_order_id', $response['data']['order_id']);
            return redirect()->route('orderDetails', ['lang' => Session::get('locale'), 'uuid' => $response['data']['order_id']]);
        } else {
            return redirect()->back()->with('error_message', $this->getMessageData('error', session()->get('locale'))['general_error']);
        }
    }

    /**
     * index method
     * @return type
     */
    public function index()
    {

        $request_params = Input::all();
        $request_data = [
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
                'usertoken' => Auth::user()->user_token
            ]
        ];
        if (!empty($request_params['page_no'])) {
            $response = $this->guzzleRequest('orders?page_no=' . $request_params['page_no'], 'GET', $request_data);
        } else {
            $response = $this->guzzleRequest('orders/', 'GET', $request_data);
        }
        if ($response['success'] == true) {
            return View('pages.myOrders', compact('response'));
        }
        return redirect()->back()->with('error_message', $response['message']);
    }

    /**
     * show method
     * show order details
     * @return type
     */
    public function show($lang, $id)
    {

        $request_data = [
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
            ]
        ];
        $response = $this->guzzleRequest('orders/show/' . $id, 'GET', $request_data);

        if (Auth::check() && Auth::user()->email !== $response['data']['user_email']) {
            return redirect()->route('home', ['lang' => session()->get('locale')])->with('error_message', $this->getMessageData('error', session()->get('locale'))['order_belongs']);
        }
        if ($response['success'] == true) {
            $phone_details = $this->getPhoneValidator()->getPhoneNumberDetails($response['data']['recipient_phone_no']);
            $country_code = $this->getCountryCode($response['data']['shipping_country']);

            $response['country_iso'] = $country_code;
            $response['countryCode'] = !empty($phone_details) ? $phone_details['countryCode'] : NULL;
            $response['nationNumber'] = !empty($phone_details) ? $phone_details['nationNumber'] : NULL;
            if(session()->get('locale') == 'ar'){
                $response['data']['shipping_country'] =  $response['data']['shipping_country_ar'];
            }
            return View('pages.orderDetails', compact('response'));
        }
        return redirect()->back()->with('error_message', $response['message']);
    }

    /**
     *
     * @param type $coutry
     * @return type
     */
    protected function getCountryCode($name)
    {

        $code = '';
        $countries_josn = file_get_contents(public_path('countries.json'));
        $countries = json_decode($countries_josn);
        foreach ($countries as $country) {
            if ($country->name == $name) {
                $code = $country->iso3;
            }
        }
        return $code;
    }

}
