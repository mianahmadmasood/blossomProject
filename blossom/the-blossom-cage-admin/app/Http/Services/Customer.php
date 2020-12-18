<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Employee
 *
 * @author qadeer
 */

use Illuminate\Support\Facades\Input;
use App\Http\Services\Config;
use Hash;
use DB;
use Auth;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;
use function GuzzleHttp\Promise\promise_for;
use Validator;
use Illuminate\Validation\Rule;

class Customer extends Config
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $request_params = \Illuminate\Support\Facades\Input::all();
        $searchText = !empty($request_params['search']) ? base64_decode($request_params['search']) : '';

//        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $customers = $this->getUserModel()->getCustomers($searchText);
        return view('pages.customers.all', compact('customers', 'searchText'));
    }
    public function indexForbug()
    {
        $customers =  DB::table('respons_paytab')  ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('pages.customers.allForbug', compact('customers'));
    }


    /**
     * show employee details
     * @param type $id
     * @return type
     */
    public function show($id, $type)
    {

        if ($type === 'new_Orders') {
            $type_order = '1';
        } else if ($type === 'accepted_Orders') {
            $type_order = '2';
        } else if ($type === 'delivered_Orders') {
            $type_order = '4';
        } else if ($type === 'canceled_Orders') {
            $type_order = '5';
        } else if ($type === 'displatched_Orders') {
            $type_order = '3';
        } else if ($type === 'completed_Orders') {
            $type_order = '4';
        } else {
            $type_order = '1';
        }


        $cusotmer = $this->getUserModel()->getCustomerByColumnValue('uuid', $id);
        if (empty($cusotmer)) {
            return redirect()->route('allCustomers')->with('error_message', 'No related record is found.');
        }

        $pending_assignments = $this->getOrderModel()
            ->where('order_status_id', '=', $type_order)
//            ->where('order_status_id', '<', 4)

            ->with('status')
            ->where('user_id', $cusotmer->id)
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);

        $new_Orders_count = $this->getOrderModel()
            ->where('order_status_id', '=', 1)
            ->with('status')
            ->where('user_id', $cusotmer->id)
            ->orderBy('updated_at', 'DESC')
            ->count();
        $accepted_Orders_count = $this->getOrderModel()
            ->where('order_status_id', '=', 2)
            ->with('status')
            ->where('user_id', $cusotmer->id)
            ->orderBy('updated_at', 'DESC')
            ->count();
        $displatched_Orders_count = $this->getOrderModel()
            ->where('order_status_id', '=', 3)
            ->with('status')
            ->where('user_id', $cusotmer->id)
            ->orderBy('updated_at', 'DESC')
            ->count();


        $completed_assignment_count = $this->getOrderModel()
            ->where('order_status_id', 4)
            ->where('user_id', $cusotmer->id)
            ->with('status')
            ->orderBy('updated_at', 'DESC')
            ->count();

        $cancelled_assignment_count = $this->getOrderModel()
            ->where('order_status_id', 5)
            ->where('user_id', $cusotmer->id)
            ->with('status')
            ->orderBy('updated_at', 'DESC')
            ->count();

        return view('pages.customers.orders', compact('new_Orders_count','displatched_Orders_count','accepted_Orders_count','completed_assignment_count', 'cancelled_assignment_count', 'pending_assignments', 'cusotmer', 'type', 'id'));
    }

}
