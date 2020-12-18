<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAssignment extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'orders_assignment';

    /**
     * The model's attribute for mass assignment
     *
     * @var array
     */
    protected $fillable = ['employee_id', 'order_id', 'comment'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the related employee
     * 
     */
    public function employee() {

        return $this->belongsTo(User::class, 'employee_id');
    }

//    /**
//     * Get the related employee
//     * 
//     */
//    public function order() {
//
//        return $this->belongsTo(Order::class, 'order_id');
//    }
    /**
     * Get the related employee
     * 
     */
    public function order() {

        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    /**
     * get assigned orders of an employee
     * @param type $employee_id
     * @return type
     */
    public function getOrdersByEmployeeId($employee_id) {
        return $this->where('employee_id', $employee_id)->with('order')->orderBy('id', 'DESC')->get();
    }

    /**
     * 
     * @param type $employee_id
     * @return type
     */
    public function getCompletedAssignments($employee_id) {
        return $this->where('employee_id', $employee_id)
                        ->whereHas('order', function ($sql) {
                            $sql->where('order_status_id', '=', 4);
                        })
                        ->with('order.status')
                        ->orderBy('id', 'DESC')
                        ->get();
    }

    /**
     * 
     * @param type $employee_id
     * @return type
     */
    public function getPendingAssignments($employee_id) {
        return $this->where('employee_id', $employee_id)
                        ->whereHas('order', function ($sql) {
                            $sql->where('order_status_id', '<>', 4);
                        })
                        ->with('order.status')
                        ->orderBy('id', 'DESC')
                        ->get();
    }

    /**
     * get assigned orders of an employee
     * @param type $employee_id
     * @return type
     */
    public function calculateCompletedOrders($employee_id) {
        return $this->where('employee_id', $employee_id)->whereHas('order', function ($sql) {

                            $sql->where('order_status_id', 4);
                        })->withCount('order')
                        ->get();
    }

    /**
     * get assigned orders of an employee
     * @param type $employee_id
     * @return type
     */
    public function calculateUnCompletedOrders($employee_id) {
        return $this->where('employee_id', $employee_id)->whereHas('order', function ($sql) {

                            $sql->where('order_status_id', '<>', 4);
                        })->withCount('order')
                        ->get();
    }

}
