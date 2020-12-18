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
use Illuminate\Support\Facades\Request;

class Employee extends Config {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $request_params = \Illuminate\Support\Facades\Input::all();
//        $searchText = !empty($request_params['search']) ? $request_params['search'] : '';
        $searchText = !empty($request_params['search']) ? base64_decode($request_params['search']) : '';
        $employees = $this->getUserModel()->getEmployees($searchText);
        return view('pages.employees.all', compact('employees', 'searchText'));
    }

    /**
     * render view to create employee account
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $warehouses=$this->getWarehouseModel()->getwarehousesForCreate();
        return view('pages.employees.create', compact('warehouses'));
    }

    /**
     * create the employee account in the database
     * @return \Illuminate\Http\Response
     */
    public function store($request) {

        DB::beginTransaction();
        $request_params = $request->except('_token');

        if (!preg_match($this->emails['regx'], $request_params['email'])) {
            return redirect()->back()->withInput($request_params)->with('error_message', 'Plese enter email in correct format.');
        }
        if(!empty($request_params['email'])){
            $requestparams['email'] = $request_params['email'];

            $validator = Validator::make($requestparams, [
                'email' => ['required', Rule::unique('users')->where(function ($query) {
                    return $query->where('role_id', 3)->where('archive','!=', 1);
                })],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput($request_params)->with('error_message', 'The Email has already been taken.');
            }
        }
        if (!empty($request_params['phone_no'])) {
            $str = $request_params['phone_no'];
            if ($str[0] == 0) {
                $str = substr($request_params['phone_no'], 1);
            }

            $phoneNumber = $request_params['countryCode'] . $str;
            $result = $this->checkphoneNumberValidation($phoneNumber);

            if ($result == false) {
                return redirect()->back()->withInput($request_params)->with('error_message', 'Plese enter Valid phone number');
            }
            $requestparams['phone_no'] = $phoneNumber;
            $requestparams['email'] = $request_params['email'];

            $validator = Validator::make($requestparams, [
                        'phone_no' => ['required', Rule::unique('users')->where(function ($query) {
                                        return $query->where('role_id', 3);
                                    })],
            ]);


            if ($validator->fails()) {
                return redirect()->back()->withInput($request_params)->with('error_message', 'The phone number has already been taken.');
            }
            unset($request_params['countryCode']);
            unset($request_params['phone_no']);
            $request_params['phone_no'] = $phoneNumber;
        }

        $request_params['role_id'] = 3;
        $request_params['password_string'] = $request_params['password'];
        $request_params['user_token'] = Hash::make(time());
        $request_params['password'] = Hash::make($request_params['password']);

        $userData = $this->getUserModel()->where('email', $request_params['email'])->where('role_id', 3)->where('archive','=', 1)->first();
       if(empty($userData)) {
           $create_account = $this->getUserModel()->create($request_params);
       }else{
           $request_param=$request_params;
           $request_param['archive']=0;
           unset($request_param['confirm_password']);
           unset($request_param['password_string']);
           $update_account = $this->getUserModel()->where('id', $userData->id)->update($request_param);
       }

        if (isset($create_account) ||  isset($update_account)) {
//            $emai_data = ['email' => 'mianahmadmasood@gmail.com', 'subject' => 'account info', 'password_string' => $request_params['password_string'], 'first_name' => $request_params['first_name'], 'last_name' => $request_params['last_name']];
            $emai_data = ['email' => $request_params['email'], 'subject' => 'account info', 'password_string' => $request_params['password_string'], 'first_name' => $request_params['first_name'], 'last_name' => $request_params['last_name']];
            $this->sendEmail('account', $emai_data);
            DB::commit();
            return redirect()->route('allEmployees')->with('success_message', 'Employee Account has been created successfully.');
        }
    }

    /**
     * 
     * @param type $phoneNumber with country Code
     * @return type
     * phone Number check  in valid or not
     */
    public function checkphoneNumberValidation($phoneNumber) {
        try {
            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            $swissNumberProto = $phoneUtil->parse($phoneNumber);
            $isValid = $phoneUtil->isValidNumber($swissNumberProto);
            if ($isValid == false) {
                return false;
            }
            return $isValid;
        } catch (\Exception $ex) {

            return false;
        }
    }

    /**
     *
     * @param type $id
     * @return type
     */
    public function edit($id) {
        $employeeObject = $this->getUserModel()->getEmployeeByColumnValue('uuid', $id);
        $result = $this->checkphoneNumberValidation($employeeObject->phone_no);
        $warehouses=$this->getWarehouseModel()->getwarehousesForCreate();
        $employee = $employeeObject->toArray();
        if ($result == false) {
            return view('pages.employees.edit', compact('employee','warehouses'));
        }
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $swissNumberProto = $phoneUtil->parse($employeeObject->phone_no);
        $geocoder = \libphonenumber\geocoding\PhoneNumberOfflineGeocoder::getInstance();
        $employee['countryName'] = $geocoder->getDescriptionForNumber($swissNumberProto, "en_US");
        $employee['countryCode'] = $swissNumberProto->getCountryCode();
        $employee['nationNumber'] = $swissNumberProto->getNationalNumber();
        return view('pages.employees.edit', compact('employee','warehouses'));
    }

    /**
     * 
     * @param type $request
     * @return type
     */
    public function update($request) {

        $request_params = $request->except('_token');
        if (isset($request_params['password']) && !empty($request_params['password'])) {
            if (strlen($request_params['password']) < 8) {
                return redirect()->back()->with('error_message', 'password must contain atleast 8 characters.');
            }
            $request_params['password'] = Hash::make($request_params['password']);
        }

        if (!empty($request_params['phone_no'])) {
            $str = $request_params['phone_no'];
            if ($str[0] == 0) {
                $str = substr($request_params['phone_no'], 1);
            }

            $phoneNumber = $request_params['countryCode'] . $str;
            $result = $this->checkphoneNumberValidation($phoneNumber);

            if ($result == false) {
                return redirect()->back()->withInput($request_params)->with('error_message', 'Plese enter Valid phone number');
            }

            unset($request_params['countryCode']);
            unset($request_params['phone_no']);
            $request_params['phone_no'] = $phoneNumber;
        }

        $employee = $this->getUserModel()->getEmployeeByColumnValue('id', $request_params['id']);
        $employee->first_name = $request_params['first_name'];
        $employee->last_name = $request_params['last_name'];
        $employee->phone_no = $request_params['phone_no'];
        $employee->warehouse_id = !empty($request_params['warehouse_id'])?$request_params['warehouse_id']:null;
        $employee->password = !empty($request_params['password']) ? $request_params['password'] : $employee->password;
        $employee->image = !empty($request_params['image']) ? $request_params['image'] : $employee->image;
        if ($employee->save()) {
            return redirect()->route('allEmployees')->with('success_message', 'Employee account has been updated successfully.');
        }
    }

    /**
     * destroy method blocks an employee
     * @param type $id
     * @param type $string
     * @return type
     */
    public function destroy($id, $string) {

        $check_employee_status = $this->getUserModel()->getEmployeeOrder('uuid', $id);
        $flag_order_status = $this->checkOrderStatus($check_employee_status);
        if ($flag_order_status == 1 && $string != "active") {
            return redirect()->back()->with('error_message', 'You can not block this employee right now because the orders assigned to this employee are in progress.');
        }
        $employee = $this->getUserModel()->getEmployeeByColumnValue('uuid', $id);
        if ($string == 'block') {
            $employee->is_active = 1;
        } elseif ($string == 'active') {
            $employee->is_active = 0;
        } elseif ($string == 'delete') {
//            $employee->is_active = 0;
            $employee->archive = 1;
        } else {
            $employee->archive = 0;
        }
        if ($employee->save()) {
            return redirect()->back()->with('success_message', 'Employee status has been changed successfully.');
        }
        return redirect()->route('allEmployees')->with('error_message', 'Something went wrong');
    }

    public  function checkOrderStatus($check_employee_status){
        $flag_order_status=0;
        foreach ($check_employee_status as $row){
            foreach ($row['assignedOrders'] as $rows){
                if($rows['order']->order_status_id == 2 || $rows['order']->order_status_id == 3){
                    $flag_order_status=1;
                }
            }
        }
        return  $flag_order_status;
    }
    /**
     * show employee details
     * @param type $id
     * @return type
     */
    public function show($id) {

        $employee = $this->getUserModel()->getEmployeeByColumnValue('uuid', $id);
        if (empty($employee)) {
            return redirect()->route('allEmployees')->with('error_message', 'No related record is found.');
        }
        $pending_assignments = $this->getOrderModel()
                ->whereHas('assignment', function($sql) use ($employee) {
                    $sql->where('employee_id', $employee->id);
                })
                ->where('order_status_id', '<>', 4)
                ->with('status')
                ->orderBy('updated_at', 'DESC')
                ->get();

        $completed_assignment = $this->getOrderModel()
                ->whereHas('assignment', function($sql) use ($employee) {
                    $sql->where('employee_id', $employee->id);
                })
                ->where('order_status_id', 4)
                ->with('status')
                ->orderBy('updated_at', 'DESC')
                ->get();
        return view('pages.employees.orders', compact('completed_assignment', 'pending_assignments', 'employee'));
    }

    /**
     * login employee to the system
     * @return type
     */
    public function login() {

        $request_params = Input::except('_token');
        $request_params['role_id'] = 3;

        if (Auth::attempt($request_params)) {
            if (!empty(session()->get('redirect_url'))) {
                $redirect_url = session()->get('redirect_url');
                session()->forget('redirect_url');
                return redirect()->to($redirect_url)->with('success_message', 'You have logged in successfully.');
            }
            return redirect()->route('employeeDashboard')->with('success_message', 'You have logged in successfully.');
        } else {
            return redirect()->back()->with('error_message', 'Please provide valid credentials.');
        }
    }

    /**
     * render employee dashboard
     * @return type
     */
    public function dashboard() {

        $employee = $this->getUserModel()->getEmployeeByColumnValue('id', Auth::user()->id);
        if (empty($employee)) {
            return redirect()->route('allEmployees')->with('error_message', 'No related record is found.');
        }
        $pending_assignments = $this->getOrderModel()
                ->whereHas('assignment', function($sql) use ($employee) {
                    $sql->where('employee_id', $employee->id);
                })
                ->where('order_status_id', '<>', 4)
                ->with('status')
                ->orderBy('updated_at', 'DESC')
                ->get();

        $completed_assignment = $this->getOrderModel()
                ->whereHas('assignment', function($sql) use ($employee) {
                    $sql->where('employee_id', $employee->id);
                })
                ->where('order_status_id', 4)
                ->with('status')
                ->orderBy('updated_at', 'DESC')
                ->get();

        return view('employees.dashboard', compact('completed_assignment', 'pending_assignments', 'employee'));
    }


    /**
     * storeCategoryProcess method
     * process the storeCategory functionality for further
     * @param type $request_params
     * @return type
     */


    public function addImage($request) {
        $upload = $this->uploadSingleImage($request->file('image'), $this->s3_image_paths['profile_images'], 'profile_');

        if ($upload['success']) {
            $file_name = explode('.', $upload['file_name']);
            $response['file_name'] = $upload['file_name'];
            $response['div_id'] = $file_name[0];
            return $this->jsonSuccessResponse('Image has been uploaded successfully.', $response);
        } else {
            return $this->jsonErrorResponse('Sorry! Something went wrong while uploading. Please try again.');
        }
    }

}
