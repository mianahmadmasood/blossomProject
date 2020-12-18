<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreate;
use Illuminate\Http\Request;

class EmployeesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            return $this->getEmployeeService()->index();
        } catch (Exception $ex) {
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        try {
            return $this->getEmployeeService()->create();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeCreate $request) {
        try {
            if ($request->validated()) {
                return $this->getEmployeeService()->store($request);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            return $this->getEmployeeService()->show($id);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        try {
            return $this->getEmployeeService()->edit($id);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\EmployeeEdit $request) {
        try {
            if ($request->validated()) {
                return $this->getEmployeeService()->update($request);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $string) {
        try {
            return $this->getEmployeeService()->destroy($id, $string);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Show the form for employee login
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome() {

        try {
            return View('employees.login');
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Attempt login for employee
     *
     * @return \Illuminate\Http\Response
     */
    public function login() {

        try {
            return $this->getEmployeeService()->login();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Attempt login for employee
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard() {

        try {
            return $this->getEmployeeService()->dashboard();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addImg(Request $request) {
        try {
            return $this->getEmployeeService()->addImage($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        } catch (\Exception $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        }
    }

}
