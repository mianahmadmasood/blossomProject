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

class Home extends Config {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

//        $item_stock = $this->getItemModel()->getFreshItemsCountAll();
////
////        foreach ($item_stock as $item) {
////            $total_sold_item = $item->ordersItems->sum('quantity');
////            $item->quantity = $total_sold_item + $item->quantity;
////            $item->save();
////        }
////        exit;
        $stats = [];
        $stats['items_count'] = $this->getItemModel()->where('archive', 0)->where('is_approved', 1)->count();
        $stats['pending_items_count'] = $this->getItemModel()->where('archive', 0)->where('is_approved', 0)->count();

        $stats['orders_new_count'] = $this->getOrderModel()->where('order_status_id', 1)->where('transaction_status','!=' ,'rejected')->where('archive', 0)->count();
        $stats['orders_accepted_count'] = $this->getOrderModel()->where('order_status_id', 2)->where('transaction_status','!=' ,'rejected')->where('archive', 0)->count();
        $stats['orders_dispatched_count'] = $this->getOrderModel()->where('order_status_id', 3)->where('transaction_status','!=' ,'rejected')->where('archive', 0)->count();
        $stats['orders_completed_count'] = $this->getOrderModel()->where('order_status_id', 4)->where('transaction_status','!=' ,'rejected')->where('archive', 0)->count();
        $stats['orders_cancelled_count'] = $this->getOrderModel()->where('order_status_id', 5)->where('transaction_status','!=' ,'rejected')->count();
        $stats['orders_rejected_count'] = $this->getOrderModel()->where('transaction_status', 'rejected')->where('archive', 0)->count();

        $stats['logs'] = $this->processTimezonesLogs($stats);
        return view('landing.dashboard', compact('stats'));
    }
    public function updateCountryCity() {

        $allEmployee = $this->getOrderAddressModel()->get();
//
        foreach ($allEmployee as $employee) {
            $request_params['city']=1;
            $request_params['country']=1;
            $employee = $this->getOrderAddressModel()->where('id', $employee->id)->update($request_params);

        }


//        $allEmployee = $this->getUserProfileModel()->get();
//
//        foreach ($allEmployee as $employee) {
//            $request_params['city']=1;
//            $request_params['country']=1;
//            $employee = $this->getUserProfileModel()->where('id', $employee->id)->update($request_params);
//
//        }


        return 'success';
    }
    public function updatelogStatus() {

        $orderStatusLogs = \DB::table('order_statuses_log')->get();
        foreach ($orderStatusLogs as $orderStatusLog) {
            $getOrderStatus = $this->getOrderStatusModel()->where('id',$orderStatusLog->order_status_id)->first();
            $request_params['status_activity']=$getOrderStatus->en_title;
            $orderStatus = \DB::table('order_statuses_log')->where('id', $orderStatusLog->id)->update($request_params);
        }
        return 'success';
    }
    public function updatesalePrice() {

        $items = $this->getItemModel()->get();
        foreach ($items as $item) {
            $getitem = $this->getItemModel()->where('id',$item->id)->first();
            $dec=$getitem->price -  $getitem->sale_price;
            $request_params['discount']=$getitem->sale_price > 0 ? $getitem->sale_price :0;
            $request_params['sale_price']=$dec;

            $orderStatus = $this->getItemModel()->where('id', $item->id)->update($request_params);
        }
        return 'success';
    }

    /**
     * prepare time of the activity
     * @return type
     */
    protected function processTimezonesLogs() {

        $logs_con = [];
        $logs = $this->getOrderLogModel()->limit(12)->orderBy('id', 'DESC')->get();
        foreach ($logs as $key => $log) {
            $logs_con[$key]['time'] = $this->datetimeConvertToAnotherTimezone($log->created_at, 'UTC', 'Asia/Riyadh');
            $logs_con[$key]['comment'] = $log->comment;
        }
        return $logs_con;
    }

}
