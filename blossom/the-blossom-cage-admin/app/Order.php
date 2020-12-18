<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The model's attribute for mass assignment
     *
     * @var array
     */
    protected $fillable = ['user_id', 'order_status_id', 'discount', 'discount_type', 'coupon_code', 'transaction_id', 'shipping_amount', 'transaction_status','transaction_response_code','transaction_response_detail', 'total_amount', 'tax_amount'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the related item to the order
     * 
     */
    public function order_items() {

        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function assignedOrders() {

        return $this->belongsTo( OrderAssignment::class, 'order_id');
    }

    /**
     * Get the related logs
     * 
     */
    public function logs() {

        return $this->hasMany(OrderStatusLog::class, 'order_id');
    }

    /**
     * Get the related status
     * 
     */

    public function status() {

        return $this->hasOne(OrderStatus::class, 'id', 'order_status_id');
    }

    /**
     * Get the related users
     * 
     */
    public function user() {

        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * get shipping address 
     * 
     */
    public function shipping_address() {

        return $this->hasOne(OrderAddress::class, 'order_id', 'id')->where('type', 'shipping');
    }

    /**
     * get  billing address 
     * 
     */
    public function billing_address() {

        return $this->hasOne(OrderAddress::class, 'order_id', 'id')->where('type', 'billing');
    }

    /**
     * get assigned employee record
     * 
     */
    public function assignment() {
        return $this->hasOne(OrderAssignment::class, 'order_id', 'id');
    }
    /**
     * get assigned employee record
     *
     */
    public function receiverUser() {

        return $this->hasMany(ReceiverUsers::class, 'order_id', 'id');
    }

    /**
     * get assigned employee record
     * 
     */
    public function assignments() {
        return $this->hasOne(OrderAssignment::class, 'order_id', 'id');
    }


    /**
     * getOrders method
     * search and returns orders
     * @param type $type
     * @param type $searchText
     * @return type
     */
    public function getOrders($type, $searchText) {

        return $this->where(function ($sql) use($type, $searchText) {
                            if ($type == 'new') {
                                $sql->orwhere('order_status_id', 1);
//                                $sql->orwhere('transaction_status','!=', 'rejected');
//                                $sql->whereNotNull('transaction_id');
//                                $sql->orwhere('transaction_status', 'succeeded');
//                                $sql->orwhere('transaction_status', 'rejected');
                            }
                            if ($type == 'accepted') {
                                $sql->orwhere('order_status_id', 2);

                            }
                            if ($type == 'dispatched') {
                                $sql->orwhere('order_status_id', 3);
//                                $sql->orwhere('transaction_status','!=', 'rejected');
                            }
                            if ($type == 'completed') {
                                $sql->orwhere('order_status_id', 4);
//                                $sql->orwhere('transaction_status','!=', 'rejected');
                            }
                            if ($type == 'cancelled') {
                                $sql->orwhere('order_status_id', 5);
//                                $sql->orwhere('transaction_status','!=', 'rejected');
                            }if ($type == 'rejected') {
                                $sql->orwhere('transaction_status', 'rejected');
                            }
                            if ($type != 'rejected') {
                                $sql->where('transaction_status','!=' ,'rejected');
                            }
                        })->where(function ($inner) use ($searchText) {
                            if (!empty($searchText)) {
                                $inner->where('order_token', $searchText);
                                $inner->orwhere('awb_number', 'LIKE', '%' . $searchText . '%');
                                $inner->orwhere('recipient_email', 'LIKE', '%' . $searchText . '%');
                                $inner->orwhere('recipient_first_name', 'LIKE', '%' . $searchText . '%');
                                $inner->orwhere('recipient_last_name', 'LIKE', '%' . $searchText . '%');
                                $inner->orwhere('recipient_phone_no', 'LIKE', '%' . $searchText . '%');
                            }
                        })->where(function ($inner) use ($type) {
                            if ($type != 'cancelled') {
                                $inner->where('archive', 0);
                            }
                        })
                        ->with('logs', 'status')
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(10);
    }

    /**
     * getOrders method
     * search and returns orders
     * @return type
     */
    public function getByColumnValue($col, $val) {

        return $this->where($col, $val)
                        ->with(['order_items' => function($sql) {

                                $sql->with(['item' => function ($innerSql) {
                                        $innerSql->with('variants.size');
                                        $innerSql->with('variants.color');
                                    }]);
                            }])
                        ->with(['logs' => function ($sql) {
                                $sql->orderBy('created_at', 'DESC');
                                $sql->with('user');
                            }])
                        ->with('status', 'user.device','receiverUser', 'billing_address', 'shipping_address', 'assignment.employee', 'order_items.item.images', 'user.setting')
                        ->first();
    }

    public function getOrderForShippingUpdate() {
        return $this->where('order_status_id', '!=', 5)
                        ->where('order_status_id', '!=', 4)
                        ->whereNotNull('awb_number')
                        ->where('shipping_status', '=', null)
                        ->whereDate('created_at', '>', '2019-10-07')
                        ->get();
    }
    public function getOrderForShippinglogUpdate($col, $val) {
        return $this->where($col, $val)->where('order_status_id', '!=', 5)
                        ->where('order_status_id', '!=', 4)
                        ->whereNotNull('awb_number')
//                        ->where('shipping_status', '=', null)
//                        ->whereDate('created_at', '>', '2019-10-07')
                        ->first();
    }

}
