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

class OrderEmails extends Config
{

    /**
     * send email containing order details
     */
    public function sendOrderReciepietEmailToUser($order, $lang)
    {

        $data['order'] = $order->toarray();
        $data['shipping_address'] = $order->shipping_address->toarray();
        $data['billing_address'] = $order->billing_address->toarray();
        $data['items'] = $this->prepareItemsData($order->order_items);
        $data['email'] = $order->recipient_email;
//        $data['email'] = 'ahmad.masood@ilsainteractive.com';
//        $data['status'] = $order->order_status_id;

        if ($order->user->email_status != 'bounced' || $order->user->email_status != 'compliant') {

            if ($order->order_status_id != 5) {
                if ($lang == 'ar') {
                    $data['subject'] = $order->order_token . 'ترتيب المستلم: #';
                    $data['link'] = env('DEEP_LINK') . 'ar/orders/show/' . $order->uuid;
                    return $this->sendEmail('orderRecipietAR', $data);
                } else {
                    $data['subject'] = 'Order Recipiet: #' . $order->order_token;
                    $data['link'] = env('DEEP_LINK') . 'en/orders/show/' . $order->uuid;
                    return $this->sendEmail('orderRecipiet', $data);
                }
            } else {

                if ($lang == 'ar') {
                    $data['subject'] = $order->order_token . 'تلقي أجل إلغاء: #';
                    $data['link'] = env('DEEP_LINK') . 'ar/orders/show/' . $order->uuid;
                    return $this->sendEmail('orderRecipietAR', $data);
                } else {
                    $data['subject'] = 'Cancelled Order Recipiet: #' . $order->order_token;
                    $data['link'] = env('DEEP_LINK') . 'en/orders/show/' . $order->uuid;
                    return $this->sendEmail('orderRecipiet', $data);
                }

            }
        }

        return true;
    }


    /**
     * send email containing order details
     */
    public function sendOrderReciepietEmailToAdmin($order, $request_params)
    {

        $employee = $this->getUserModel()->getEmployeeByColumnValue('id', \Auth::user()->id);
        $data['order'] = $order->toarray();
        $data['employee'] = $employee->toarray();
        $data['shipping_address'] = $order->shipping_address->toarray();
        $data['items'] = $this->prepareItemsData($order->order_items);
        $data['email'] = $this->emails['admin_email'];
        $data['status'] = $order->order_status_id;
        $data['subject'] = 'Order Recipiet: #' . $order->order_token;
        $data['link'] = env('DEEP_LINK_ADMIN') . 'orders/detail/' . $order->uuid;
        if ($order->user->email_status != 'bounced' || $order->user->email_status != 'compliant') {
            return $this->sendEmail('admin-emails.orderRecipiet', $data);
        }else{
            return true ;
        }
    }

    /**
     * send email containing order details
     */
    public function sendOrderReciepietEmailToEmployee($order, $request_params)
    {
        $employee = $this->getUserModel()->getEmployeeByColumnValue('id', $request_params['employee_id']);
        $data['order'] = $order->toarray();
        $data['shipping_address'] = $order->shipping_address->toarray();
        $data['billing_address'] = $order->billing_address->toarray();
        $data['items'] = $this->prepareItemsData($order->order_items);
        $data['email'] = $employee->email;
        $data['status'] = $order->order_status_id;
        $data['subject'] = 'New Order Assignment: #' . $order->order_token;
        $data['link'] = env('DEEP_LINK_ADMIN') . 'orders/detail/' . $order->uuid;
        if ($order->user->email_status != 'bounced' || $order->user->email_status != 'compliant') {
            return $this->sendEmail('employee-emails.orderRecipiet', $data);
        }else{
            return true ;
        }
    }

    /**
     * send email containing order details
     */
    public function sendOrderReciepietEmailToEmployeeChangeStatus($order, $request_params)
    {
        $employee = $this->getUserModel()->getEmployeeByColumnValue('id', $request_params['employee_id']);
        $data['order'] = $order->toarray();
        $data['shipping_address'] = $order->shipping_address->toarray();
        $data['billing_address'] = $order->billing_address->toarray();
        $data['items'] = $this->prepareItemsData($order->order_items);
        $data['email'] = $employee->email;
        $data['status'] = $order->order_status_id;
        $data['subject'] = 'Order Assignment: #' . $order->order_token;
        $data['link'] = env('DEEP_LINK_ADMIN') . 'orders/detail/' . $order->uuid;
        if ($order->user->email_status != 'bounced' || $order->user->email_status != 'compliant') {
            return $this->sendEmail('employee-emails.orderRecipiet', $data);
        }else{
            return true;
        }
    }

    /**
     *
     * @param type $items
     * @return type
     */
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
