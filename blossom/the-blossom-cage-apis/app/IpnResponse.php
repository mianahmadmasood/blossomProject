<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpnResponse extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    public $table = "ipn_response";
    protected $fillable = [
        'transaction_id',
        'shipping_address',
        'shipping_city',
        'shipping_country',
        'shipping_state',
        'shipping_postalcode',
        'phone_num',
        'customer_name',
        'email',
        'response_code',
        'detail',
        'reference_id',
        'invoice_id',
        'amount',
        'currency',
        'order_id',
        'customer_email',
        'customer_phone',
        'transaction_amount',
        'transaction_currency',
        'first_4_digits',
        'last_4_digits',
        'card_brand',
        'secure_sign',
        'force_accept_datetime',
        'refund_req_amounts',
    ];
    public $timestamps = true;

    /**
     * 
     * @param type $column
     * @param type $value
     * @return type
     */
    public function getResponeByColumnValue($column, $value) {

        $data = $this->where($column, '=', $value)->first();
        return !empty($data) ? $data->toArray() : [];
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    public function saveTransactoinData($data) {
        return $this->insert($data);
    }

}
