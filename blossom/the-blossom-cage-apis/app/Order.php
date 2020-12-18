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

    protected $fillable = [
        "order_token", "awb_number", "user_id", "order_status_id", "discount",
        "discount_type","coupon_code", "transaction_id", "transaction_status",
        "transaction_response_code", "transaction_response_detail", "last_4_digits",
        "first_4_digits", "card_brand", "trans_date", "secure_sign", "total_amount",
        "tax_amount", "shipping_amount", "shipping_status", "shipping_details","order_currency",
        "converted_shipping_amount","converted_tax_amount","converted_total_amount",
        "cod", "recipient_first_name", "recipient_last_name", "recipient_phone_no","recipient_email"
    ];



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
    public function items() {

        return $this->hasMany(OrderItem::class, 'order_id');
    }

    /**
     * Get the related item to the order
     *
     */
    public function status() {

        return $this->hasOne(OrderStatus::class, 'id', 'order_status_id');
    }
    public function orderAddress() {

        return $this->hasOne(OrderAddress::class, 'id', 'order_id');
    }


    /**
     * Get the related logs
     *
     */
    public function logs() {

        return $this->hasMany(OrderItem::class, 'order_id');
    }

    /**
     * Get the related logs
     *
     */
    public function shipping_address() {

        return $this->hasOne(OrderAddress::class, 'order_id')->where('type', 'shipping');
    }

    /**
     * Get the related logs
     *
     */
    public function billing_address() {

        return $this->hasOne(OrderAddress::class, 'order_id')->where('type', 'billing');
    }

    /**
     * Get the related logs
     *
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * getOrderList method
     * fetch and paginate record
     * @param type $request_params
     * @return type
     */
    public function getOrdersList($request_params) {

        return $this->where('user_id', '=', $request_params['user_id'])
                        ->where('archive', 0)
                        ->where(function ($sql) use($request_params) {
                            if (!empty($request_params['type']) && $request_params['type'] == 'current') {
                                $sql->whereNotIn('order_status_id', [4]);
                            }
//                            $sql->where(function ($innersql) {
//                                $innersql->where('transaction_status', 'succeeded');
//                                $innersql->orwhere('transaction_status', 'rejected');
//                            });
                        })
                        ->with('items.item.image')
                        ->orderBy('id', 'desc')
                        ->limit($request_params['limit'])
                        ->offset($request_params['offset'])
                        ->get();
    }

    /**
     * getOrderList method
     * fetch and paginate record
     * @param type $request_params
     * @return type
     */
    public function getOrdersListCount($request_params) {

        return $this->where('user_id', '=', $request_params['user_id'])
                        ->where('archive', 0)
                        ->where(function ($sql) use($request_params) {
                            if (!empty($request_params['type']) && $request_params['type'] == 'current') {
                                $sql->whereNotIn('order_status_id', [4]);
                            }
                            $sql->where(function ($innersql) {
                                $innersql->where('transaction_status', 'succeeded');
                                $innersql->orwhere('transaction_status', 'rejected');
                            });
                        })
                        ->with('items.item.image')
                        ->orderBy('id', 'desc')
                        ->count();
    }

    /**
     * getOrderDetailsByColVal method
     * @return type
     */
    public function getOrderDetailsByColVal($col, $val) {
        return $this->where($col, $val)
                        ->with('user.device')
                        ->with('orderAddress.country','orderAddress.city')
                        ->with('items.item.image')
                        ->with('shipping_address', 'billing_address')
                        ->first();
    }

    public function updatOrderResponse($order_update_for_ids,$order_data) {
        return $this->where('id',$order_update_for_ids)->update($order_data);
    }

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }
}
