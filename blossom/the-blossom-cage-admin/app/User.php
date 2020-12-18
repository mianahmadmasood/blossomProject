<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'user_name', 'phone_no', 'image', 'email', 'password', 'user_token', 'role_id', 'warehouse_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Gel related orders
     */
    public function assignedOrders()
    {
        return $this->hasMany(OrderAssignment::class, 'employee_id', 'id');
    }

    public function customerOrders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function device()
    {
        return $this->hasOne(UserDevice::class, 'user_id', 'id');
    }

    public function setting()
    {
        return $this->hasOne(ProfileSettings::class, 'user_id', 'id');
    }

    /**
     *
     * @param type $searchText
     * @return type
     */
    public function getEmployees($searchText = null)
    {
        return $this->where('role_id', 3)
            ->where(function ($sql) use ($searchText) {
                if ($searchText) {
                    $sql->where('email', 'like', "%$searchText%");
                    $sql->orWhere('phone_no', 'like', "%$searchText%");
                    $sql->orWhere('first_name', 'like', "$searchText%");
                    $sql->orWhere('last_name', 'like', "%$searchText");
                }
            })
            ->withCount('assignedOrders')
            ->with(array('assignedOrders.order' => function ($query) {
                $query->where('order_status_id', '<>', '3');
            }))
//                        ->orderBy('id', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->where('archive', 0)
//                        ->where('is_active', 1)
            ->paginate(10);
    }

    /**
     *
     * @param type $searchText
     * @return type
     */
    public function getCustomers($searchText = null)
    {

        return $this->where('role_id', 2)
            ->where(function ($sql) use ($searchText) {
                if ($searchText) {
                    $sql->where('email', 'like', "%$searchText%");
                    $sql->orWhere('phone_no', 'like', "%$searchText%");
                    $sql->orWhere('first_name', 'like', "%$searchText%");
                    $sql->orWhere('last_name', 'like', "%$searchText%");
                }
            })
            ->withCount('customerOrders')
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getActiveEmployees($user_id = null)
    {

        if ($user_id !== null) {
            return $this->where('role_id', 3)->orderBy('id', 'DESC')->where('id', '<>', $user_id)->where('archive', 0)->get();
        }
        return $this->where('role_id', 3)->orderBy('id', 'DESC')->where('archive', 0)->get();
    }

    /**
     * getUserByColumnValue method
     * get user by given values
     * @param type $col
     * @param type $val
     * @return type
     */
    public function getEmployeeOrder($col, $val)
    {

        return $this->where($col, $val)
            ->whereHas('assignedOrders', function ($sql) {
                $sql->whereHas('order', function ($innerSql) {
//                                $innerSql->where('order_status_id','=' ,'3');
//                                $innerSql->where('order_status_id','=' ,'4');
                });
            })->with('assignedOrders', 'assignedOrders.order')
            ->where('role_id', 3)
            ->get();
    }

    /**
     * getUserByColumnValue method
     * get user by given values
     * @param type $col
     * @param type $val
     * @return type
     */
    public function getEmployeeByColumnValue($col, $val)
    {
        return $this->where($col, $val)->where('role_id', 3)->first();
    }

    public function getCustomerByColumnValue($col, $val)
    {
        return $this->where($col, $val)->where('role_id', 2)->first();
    }

    /**
     * getUserByColumnValue method
     * get user by given values
     * @param type $col
     * @param type $val
     * @return type
     */
    public function getUserByColumnValue($col, $val)
    {
        return $this->where($col, $val)->with('setting')->first();
    }

}
