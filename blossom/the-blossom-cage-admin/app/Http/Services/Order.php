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
use Auth;
use DB;
Use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class Order extends Config
{
    use \App\Http\Traits\ShippingService;

    /**
     * index method
     * list orders on the basics of type
     * @param type $type
     * @return type
     */
    public function index($type)
    {
        $request_params = \Illuminate\Support\Facades\Input::all();
        $searchText = !empty($request_params['search']) ? base64_decode($request_params['search']) : '';
//        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $orders = $this->getOrderModel()->getOrders($type, $searchText);
        return View('pages.orders.all', compact('orders', 'searchText', 'type'));
    }

    /**
     * show method
     * this method is response for showing order details
     * @param type $id
     * @return type
     */
    public function generatePdf($id)
    {

        $order = $this->getOrderModel()->getByColumnValue('uuid', $id);
        if (!empty($order)) {
            $awbnumber = $this->shippingService()->addShipment($order);
            if (is_numeric($awbnumber) == true) {
                $order->awb_number = $awbnumber;
                $order->save();
                return redirect()->back()->with('success_message', 'Pdf has been generate successfully.');
            } else {
                return redirect()->back()->with('error_message', 'Smsa shiping ' . $awbnumber);
            }
        }
    }

    /**
     * show method
     * this method is response for showing order details
     * @param type $id
     * @return type
     */
    public function downloadPdf($id)
    {

        $order = $this->getOrderModel()->getByColumnValue('uuid', $id);
        if (!empty($order)) {
            return $this->shippingService()->getPdfFile($order);
        }
    }

    /**
     * show method
     * this method is response for showing order details
     * @param type $id
     * @return type
     */
    public function show($id)
    {

        $order = $this->getOrderModel()->getByColumnValue('uuid', $id);

        if ($order->assignment) {
            $total_completed_order = $this->getOrderAssignmentModel()->calculateCompletedOrders($order->assignment->employee_id);
            $total_inprocess_order = $this->getOrderAssignmentModel()->calculateUnCompletedOrders($order->assignment->employee_id);
            $employees = $this->getUserModel()->getActiveEmployees($order->assignment->employee_id);
            return view('pages.orders.details', compact('order', 'total_completed_order', 'total_inprocess_order', 'employees'));
        } else {
            $employees = $this->getUserModel()->getActiveEmployees();
            return view('pages.orders.details', compact('order', 'employees'));
        }
    }

    /**
     * show method
     * this method is response for showing order details
     * @param type $id
     * @return type
     */
    public function showorderdetail($id)
    {

        $order = $this->getOrderModel()->getByColumnValue('uuid', $id);

        if ($order->assignment) {
            $total_completed_order = $this->getOrderAssignmentModel()->calculateCompletedOrders($order->assignment->employee_id);
            $total_inprocess_order = $this->getOrderAssignmentModel()->calculateUnCompletedOrders($order->assignment->employee_id);
            $employees = $this->getUserModel()->getActiveEmployees($order->assignment->employee_id);
            return view('pages.customers.orderdetails', compact('order', 'total_completed_order', 'total_inprocess_order', 'employees'));
        } else {
            $employees = $this->getUserModel()->getActiveEmployees();
            return view('pages.customers.orderdetails', compact('order', 'employees'));
        }
    }

    /**
     * changeStatus method
     * changes the status of an order
     * @param type $request
     * @return type
     */
    public function changeStatus($request)
    {
        $request_params = $request->except('_token');
        DB::beginTransaction();
        if (Auth::user()->role_id == 1) {
            return $this->adminOrderChnge($request_params);
        } elseif (Auth::user()->role_id == 3) {
            return $this->employeeOrderChnge($request_params);
        }
    }

    /**
     * changeStatus method
     * changes the status of an order
     * @param type $request
     * @return type
     */
    public function shippingStatus($request)
    {

        $request_params = $request->except('_token');
        $order = $this->getOrderModel()->getOrderForShippinglogUpdate('id', $request_params['id']);
        if (is_numeric($order->awb_number)) {
            $current_status = $this->getShppimentStatus($order);
            if ($current_status !== null) {
                 $this->updateShippingStatus($current_status, $order);
            }
        }

        $html = View::make('partials.shippingStatus', compact('order'))->render();
        return $this->jsonSuccessResponse('Order log found', $html);


    }

    /**
     *
     * @param type $request_params
     * @return type
     */

    public function adminOrderChnge($request_params)
    {


        $notfify_user = false;
        $order = $this->getOrderModel()->getByColumnValue('id', $request_params['order_id']);
        if (!empty($request_params['order_status']) && $request_params['order_status'] != $order['order_status_id']) {
            return redirect()->back()->with('error_message', 'You order status has been already changed.');
        }
        if (!empty($request_params['status_id']) && $request_params['status_id'] == '5') {
            return $this->cancalledOrder($request_params);
        }
        if ($order->order_status_id == 1) {
            if (empty($request_params['employee_id']) || empty($request_params['status_id'])) {
                return redirect()->back()->with('error_message', 'Please select employee and status for assignment.');
            } else {
                $this->getOrderAssignmentModel()->create($request_params);
                // $this->getOrderEmailService()->sendOrderReciepietEmailToEmployee($order, $request_params);
                $notfify_user = true;
            }
        }
        if ($order->order_status_id == 2 && $order->assignment && empty($request_params['employee_id'])) {
            return redirect()->back()->with('error_message', 'Please select employee to whom you want assign the order.');
        } else {
            $this->getOrderAssignmentModel()->where('order_id', $order->id)->delete();
            $this->getOrderAssignmentModel()->create($request_params);
        }
        if (!empty($request_params['status_id'])) {
            $order->order_status_id = $request_params['status_id'];
            $order->save();
        }
        return $this->processChangeStatus($request_params, $order, $notfify_user);
    }

    public function cancalledOrder($request_params)
    {

        $order = $this->getOrderModel()->getByColumnValue('id', $request_params['order_id']);
        $order->order_status_id = $request_params['status_id'];
        $order->save();


        if (isset($order['transaction_id'])) {
            return $this->submitRefund($order);
        }

        // $this->getOrderEmailService()->sendOrderReciepietEmailToUser($order, $order->user->lang);
        return $this->processChangeStatus($request_params, $order, true);
    }


    public function submitRefund($inputs)
    {

        $ipn_response = $this->getIpnResponse()->getResponeByColumnValue('transaction_id', $inputs['transaction_id']);
        if (empty($ipn_response)) {
            $request_params = self::prepareDetailRequestParams($inputs);
            $transaction_details = $this->guzzleRequest('https://www.paytabs.com/apiv2/verify_payment_transaction', 'POST', $request_params);
            $ipn_response = $transaction_details;
        }

        if (empty($ipn_response)) {
            return redirect()->back()->with('error_message', 'We are unable to verify your transaction details.');
        }

        if ($ipn_response['response_code'] != 100) {

            \App\Order::where('id', '=', $inputs['id'])->update(['transaction_status' => 'refunded_pending']);
            // $this->getOrderEmailService()->sendOrderReciepietEmailToUser($inputs, $inputs->user->lang);
            return $this->processChangeStatus($request_params, $inputs, true);

//            return redirect()->back()->with('error_message', $ipn_response['result']);
        }


        return self::refundShipmentProcess($ipn_response, $inputs);
    }

    /**
     * prepareDetailRequestParams method
     * @param type $p_id
     * @return type
     */
    public static function prepareDetailRequestParams($inputs)
    {
        $reqData['merchant_email'] = config('paths.merchant_email');
        $reqData['secret_key'] = config('paths.paytabs_secret_key');
        $reqData['transaction_id'] = $inputs->transaction_id;
        $reqData['order_id'] = $inputs->id;
        return $reqData;
    }

    /**
     * prepareRequestParamsForRefund method
     * @param type $p_id
     * @return type
     */
    public function prepareRequestParamsForRefund($inputs)
    {
        $reqData['merchant_email'] = config('paths.merchant_email');
        $reqData['secret_key'] = config('paths.paytabs_secret_key');
        $reqData['transaction_id'] = $inputs->transaction_id;
        $reqData['refund_amount'] = $inputs->total_amount;
        $reqData['refund_reason'] = 'qty not available';
        $reqData['order_id'] = $inputs->id;
        return $reqData;
    }


    public function refundShipmentProcess($ipn_response, $inputs)
    {
        $request_params = self::prepareRequestParamsForRefund($inputs);
        $create_charge = $this->guzzleRequest('https://www.paytabs.com/apiv2/refund_process', 'POST', $request_params);
        if ($create_charge['response_code'] == 812) {
            $update_order = \App\Order::where('id', '=', $inputs['id'])->update(['transaction_status' => 'refunded']);
            if ($update_order) {
                return redirect()->back()->with('success_message', $create_charge['result']);
            }
        } else {
            \App\Order::where('id', '=', $inputs['id'])->update(['transaction_status' => 'refunded_pending']);
//            return redirect()->back()->with('error_message', $create_charge['result']);
        }

        // $this->getOrderEmailService()->sendOrderReciepietEmailToUser($inputs, $inputs->user->lang);
        return $this->processChangeStatus($request_params, $inputs, true);
//        return redirect()->back()->with('success_message', 'Payment refund scheduled successfully');
    }


    /**
     *
     * @param type $request_params
     * @return type
     */
    public function employeeOrderChnge($request_params)
    {

        $order = $this->getOrderModel()->getByColumnValue('id', $request_params['order_id']);
        if (!empty($request_params['order_status']) && $request_params['order_status'] != $order['order_status_id']) {
            return redirect()->back()->with('error_message', 'You order status has been already changed.');
        }
        if (!empty($request_params['order_status']) && Auth::user()->id != $order->assignment->employee_id) {
            return redirect()->back()->with('error_message', 'You order  has been assignment other Employee.');
        }

        if (empty($request_params['status_id'])) {
            return redirect()->back()->with('error_message', 'Please select the order status.');
        }

        if ($request_params['status_id'] == 3) {
            self::prepareRequestParamsForDispatched($order, $request_params['picker']);
        } elseif ($request_params['status_id'] == 4) {
            self::prepareRequestParamsForDelivered($order, $request_params['receiver']);
        }
        $order->order_status_id = $request_params['status_id'];
        $order->save();

        return $this->processChangeStatus($request_params, $order, true);
    }


    /**
     * prepareRequestParamsForDispatched method
     * @param type $p_id
     * @return type
     */
    public function prepareRequestParamsForDispatched($order, $inputs)
    {
        $inputs['order_id'] = $order->id;
        $this->getReceiverUsersModel()->create($inputs);
        return true;
    }

    /**
     * prepareRequestParamsForDelivered method
     * @param type $p_id
     * @return type
     */
    public function prepareRequestParamsForDelivered($order, $inputs)
    {
        $inputs['order_id'] = $order->id;
        $this->getReceiverUsersModel()->create($inputs);
        return true;
    }

    /**
     *
     * @param type $request_params
     * @param type $order
     * @return type
     */
    protected function processChangeStatus($request_params, $order, $notify_user)
    {


        if ($notify_user) {
            $this->sendNotification($order);
            // $this->getOrderEmailService()->sendOrderReciepietEmailToUser($order, $order->user->lang);
            if (Auth::user()->role_id !== 1) {
                // $this->getOrderEmailService()->sendOrderReciepietEmailToAdmin($order, $request_params);
            }
        } else {
            if ($request_params['status_id'] != '5') {
                // $this->getOrderEmailService()->sendOrderReciepietEmailToEmployeeChangeStatus($order, $request_params);
            }
        }
        return $this->processOrderStatusLog($request_params, $order);
    }

    /**
     * processOrderStatusLog method
     * prepares and saves log of an order
     * @param type $request_params
     * @return type
     */
    public function processOrderStatusLog($request_params, $order)
    {

        $log = [];
        $log['user_id'] = \Auth::user()->id;
        $log['order_id'] = $request_params['order_id'];
        $log['employee_id'] = !empty($request_params['employee_id']) ? $request_params['employee_id'] : null;
        $log['order_status_id'] = !empty($request_params['status_id']) ? $request_params['status_id'] : $order->order_status_id;
        $log['comment'] = !empty($request_params['status_id']) ? $this->prepareCommentForLog($request_params['status_id']) : 'Admin has assigned order to other employee';
        $create_log = $this->getOrderLogModel()->create($log);

        if ($create_log) {
            DB::commit();
            if ($order->order_status_id != 5) {
                return redirect()->back()->with('success_message', 'Order status has been changed successfully.');
            } else {
                return redirect()->back()->with('success_message', 'Order  has been cancelled successfully.');
            }
        }
        DB::rollBack();
        return redirect()->back()->with('error_message', 'Internal server error');
    }

    /**
     * prepareCommentForLog method
     * prepares comment for order logs
     * @param type $status
     * @return string
     */
    public function prepareCommentForLog($status)
    {

        $message = '';

        switch ($status) {
            case 2:
                $message = \Auth::user()->first_name . " has made order status accepted.";
                break;
            case 3:
                $message = \Auth::user()->first_name . " has made order status dispatched.";
                break;
            case 4:
                $message = \Auth::user()->first_name . " has made order status delivered.";
                break;
            default:
                $message = \Auth::user()->first_name . " changed order status";
        }
        return $message;
    }

}
