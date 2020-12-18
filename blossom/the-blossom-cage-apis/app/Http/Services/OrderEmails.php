<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of OrderEmails
 * this class is used to send emails to
 * admin and user of this order
 * @author qadeer
 */

use App\Http\Services\Config;
use Mail;

class OrderEmails extends Config
{

    /**
     * send email containing order details
     */
    public function sendOrderReciepietEmailToUser($order, $request_params)
    {
        try {
            $data['order'] = $order->toarray();
            $data['shipping_address'] = $order->shipping_address->toarray();
            $data['billing_address'] = $order->billing_address->toarray();
            $data['items'] = $this->prepareItemsDataaccessoires($order->items, $request_params);
//        $data['email'] = 'ahmad.masood@ilsainteractive.com';
            $data['email'] = $order->recipient_email;

            if ($order->user->email_status != 'bounced' || $order->user->email_status != 'compliant') {
                if ($request_params['lang'] == 'ar') {

                    $data['subject'] = $order->order_token . 'ترتيب المستلم: #';
                    $data['link'] = env('DEEP_LINK') . 'ar/orders/show/' . $order->uuid;
                    return $this->sendEmail('orderRecipietAR', $data);
                } else {
                    $data['subject'] = 'Order Recipiet: #' . $order->order_token;
                    $data['link'] = env('DEEP_LINK') . 'en/orders/show/' . $order->uuid;
                    return $this->sendEmail('orderRecipiet', $data);
                }
            }
            return true;

        } catch (\Exception $ex) {
            $respons_save_inpaytab['response'] = '-sql-exception-' . $ex;
            DB::table('respons_paytab')->insert($respons_save_inpaytab);
            return true;
        }
    }

    /**
     * send email containing order details
     */
    public function sendOrderReciepietEmailToAdmin($order, $request_params)
    {

        $data['order'] = $order->toarray();
        $data['shipping_address'] = $order->shipping_address->toarray();
        $data['billing_address'] = $order->billing_address->toarray();
        $data['items'] = $this->prepareItemsDataaccessoires($order->items, $request_params);
        $data['email'] = $this->emails['admin_email'];
        $data['subject'] = 'New Order: #' . $order->order_token;
        $data['link'] = env('DEEP_LINK_ADMIN') . 'orders/detail/' . $order->uuid;
        return $this->sendEmailWithoutException('admin-emails.orderRecipiet', $data);
    }

    /**
     * send email containing order details
     */
    public function sendOrderReciepietEmailToUserUpdate($order, $request_params)
    {


        $data['order'] = $order->toarray();
        $data['shipping_address'] = $order->shipping_address->toarray();
        $data['billing_address'] = $order->billing_address->toarray();
        $data['items'] = $this->prepareItemsData($order->items);
//        $data['email'] = 'ahmad.masood@ilsainteractive.com';
        $data['email'] = $order->recipient_email;
        if ($order->user->email_status != 'bounced' || $order->user->email_status != 'compliant') {

            if ($request_params['lang'] == 'ar') {
                $data['subject'] = $order->order_token . 'ترتيب المستلم: #';
                $data['link'] = env('DEEP_LINK') . 'ar/orders/show/' . $order->uuid;
                return $this->sendEmailWithoutException('orderRecipietAR', $data);
            } else {
                $data['subject'] = 'Order Recipiet: #' . $order->order_token;
                $data['link'] = env('DEEP_LINK') . 'en/orders/show/' . $order->uuid;
                return $this->sendEmailWithoutException('orderRecipiet', $data);
            }
        }

        return true;
    }

    /**
     * send email containing order details
     */
    public function sendOrderReciepietEmailToAdminUpdate($order, $request_params)
    {

        $data['order'] = $order->toarray();
        $data['shipping_address'] = $order->shipping_address->toarray();
        $data['billing_address'] = $order->billing_address->toarray();
        $data['items'] = $this->prepareItemsData($order->items);
        $data['email'] = $this->emails['admin_email'];
        $data['subject'] = 'New Order: #' . $order->order_token;
        $data['link'] = env('DEEP_LINK_ADMIN') . 'orders/detail/' . $order->uuid;
        return $this->sendEmailWithoutException('admin-emails.orderRecipiet', $data);
    }

    /**
     *
     * @param type $items
     * @return type
     */
    protected function prepareItemsDataaccessoires($items, $request_params)
    {

        $response = [];
        foreach ($items as $key => $item) {
            $response[$key]['en_title'] = $item->item->en_title;
            $response[$key]['ar_title'] = $item->item->ar_title;
            $response[$key]['quantity'] = $item->quantity;
            $response[$key]['price'] = $item->converted_price;
            $response[$key]['currency'] = $item->converted_currency;
            $response[$key]['image'] = $item->item->image->image;
            $response[$key]['color_code'] = $request_params['items'][$key]['color_code'];
            $response[$key]['color_name'] = $request_params['items'][$key]['color_name'];
            if (!empty($request_params['items'][$key]['orderItemAccessories'])) {
                $response[$key]['orderItemAccessories'] = $request_params['items'][$key]['orderItemAccessories'];
            }

        }
        return $response;
    }

    /**
     * send email without exception
     * @param type $template
     * @param type $data
     * @param type $attachment
     * @return boolean
     */
    protected function sendEmailWithoutException($template, $data, $attachment = null)
    {
        try {

            $support_email = $this->emails['support_email'];
            $site_title = $this->emails['site_title'];
            Mail::send('emails.' . $template, ['data' => $data], function ($message) use ($support_email, $site_title, $data) {
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

    protected function prepareItemsData($items)
    {

        $response = [];
        foreach ($items as $key => $item) {
            $response[$key]['en_title'] = $item->item->en_title;
            $response[$key]['ar_title'] = $item->item->ar_title;
            $response[$key]['quantity'] = $item->quantity;
            $response[$key]['price'] = $item->converted_price;
            $response[$key]['currency'] = $item->converted_currency;
            $response[$key]['image'] = $item->item->images[0]->image;
            $response[$key]['color_code'] = $item->color_name;
            $response[$key]['color_name'] = $item->color_code;
            $response[$key]['orderItemAccessories'] = $this->prepareItemAccessoriesDetails($item->id);

        }
        return $response;
    }

    protected function prepareItemAccessoriesDetails($itemId)
    {

        $response = [];
        $order_item_accessoires = \App\OrderItemAccessries::where('order_item_id', $itemId)->where('archive', 0)->get();
        if (!empty($order_item_accessoires)) {
            foreach ($order_item_accessoires as $key => $order_item_accessoire) {
                $response[$key]['accessories_id'] = $order_item_accessoire->accessories_id;
                $response[$key]['en_title'] = $order_item_accessoire->en_title;
                $response[$key]['ar_title'] = $order_item_accessoire->ar_title;
                $response[$key]['price'] = $order_item_accessoire->price;
                $response[$key]['image'] = $order_item_accessoire->image;
                $response[$key]['quantity'] = $order_item_accessoire->quantity;
                $response[$key]['must_purchase'] = $order_item_accessoire->must_purchase;
            }
        }
        return $response;
    }


}
