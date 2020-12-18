<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Checkout
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use Illuminate\Support\Facades\Session;
use Auth;

class Checkout extends Config {

    protected $headers;
    protected $lang;

    function __construct() {
        $this->headers = [
            'apikey' => config('config.apikey'),
            'lang' => Session::get('locale')
        ];
        $this->lang = Session::get('locale');
    }

    /**
     * showCheckout method
     * shows checkout page
     * @return type
     */
    public function showCheckout() {

        $user_profile = null;
        if (\Auth::check()) {
            $user_profile = $this->getUserProfileModel()->getByColValue('user_id', \Auth::user()->id);
        }
        $items = Session::get('items');
        if (empty($items)) {
            $message = $this->getMessageData('error', $this->lang)['add_item'];
            return redirect()->back()->with('error_message', $message);
        }
        $is_quantity_avaible = $this->checkQuantityItems($items);

        $address_country_city = $this->getDataCOuntryCity();
        $address_data = $address_country_city['data'];
        if ($is_quantity_avaible['success'] == true && $is_quantity_avaible['status_code'] == 601) {
            $this->updateCartQuantity($is_quantity_avaible['data']);

            Session::put('outof_stock_items', $is_quantity_avaible['data']);
            return redirect()->route('viewBag', ['lang' => Session::get('locale')]);
        } else if ($is_quantity_avaible['success'] == true && $is_quantity_avaible['status_code'] == 602) {
            Session::forget('outof_stock_items');

            return View('pages.checkout', compact('user_profile','address_data'));
        }

        return View('pages.checkout', compact('user_profile','address_data'));

    }

    /**
     *
     * @param type $quantity_check
     */
    public function updateCartQuantity($quantity_check) {

        $items_in_bag = Session::get('items');
        $new_data = $this->prepareCartData($items_in_bag, $quantity_check);
        Session::forget('items');
        Session::put('items', $new_data);
        Session::put('total', $this->calculateTotalAmount());
        Session::put('shipping_cost', $this->calculateShippingAmount());
        Session::put('tax_amount', $this->calculateTaxAmount());
    }

    /**
     *
     * @param type $items_in_bag
     * @param type $quantity_check
     * @return type
     */
    public function prepareCartData($items_in_bag, $quantity_check) {


        foreach ($items_in_bag as $key => $item) {
            foreach ($quantity_check as $o_item) {
                if ($item['uuid'] === $o_item['uuid'] && $item['color_id'] == $o_item['color_id']) {
                    unset($items_in_bag[$key]['quantity']);
                    unset($items_in_bag[$key]['cart_quantity']);
                    $items_in_bag[$key]['quantity'] = $o_item['quantity'];
                    $items_in_bag[$key]['cart_quantity'] = $o_item['cart_quantity'];
                }
            }
        }
        return $items_in_bag;
    }

    /**
     *
     * @param type $items
     * @return type
     */
    protected function checkQuantityItems($items) {

        $request_items['items'] = $items;
        $request_data = [
            'form_params' => $request_items,
            'headers' => [
                'apikey' => config('config.apikey'),
                'lang' => Session::get('locale'),
            ]
        ];

        return $this->guzzleRequest('items/check/quantity', 'POST', $request_data);
    }

    public function getDataCOuntryCity() {

        $request_data = ['headers' => [
            'apikey' => config('config.apikey'),
            'lang' => Session::get('locale')
        ]
        ];

        return $this->guzzleRequest('users/getCountryAndCityInformation', 'GET', $request_data);

    }

}
