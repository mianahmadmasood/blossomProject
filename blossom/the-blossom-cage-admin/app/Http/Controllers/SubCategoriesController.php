<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryStore;
use App\Http\Requests\SubCategoryUpdate;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            return $this->getCategoriesService()->getSubCategoriesList();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        try {
            return $this->getCategoriesService()->createSubCategory();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryStore $request) {
        try {
            if ($request->validated()) {

                return $this->getCategoriesService()->storeCategory($request);
            }
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
    public function edit($uid) {
        try {
            return $this->getCategoriesService()->editSubCategory($uid);
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
    public function update(SubCategoryUpdate $request) {
        try {
            if ($request->validated()) {
                return $this->getCategoriesService()->updateCategory($request);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    public function ajaxCall($id) {
        try {
            return $this->getCategoriesService()->ajaxCall($id);
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
            return $this->getCategoriesService()->addSubCatImage($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        } catch (\Exception $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleted() {
        try {
            return $this->getCategoriesService()->getDeletedSubCategories();
        } catch (\Illuminate\Database\QueryException $ex) {
            return \App\Helpers\CommonHelper::adminException($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    public function destroy($uid, $status) {
        try {
            return $this->getCategoriesService()->stateSubCategories($uid, $status);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

}
