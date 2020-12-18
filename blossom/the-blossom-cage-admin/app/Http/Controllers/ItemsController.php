<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemColorUpdate;
use Illuminate\Http\Request;
use App\Http\Requests\ItemStore;
use App\Http\Requests\ItemVariantStore;
use App\Http\Requests\ItemUpdate;
use App\Http\Requests\ManualDataUpdate;
use App\Http\Requests\VariantSizeUpdate;
use App\Http\Requests\VideoCreate;
use App\Http\Requests\ManualCreate;
use App\Http\Requests\VideoDataUpdate;

class ItemsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     */

    public function indexitemcoloradd(){
        try {
            return $this->getItemService()->dataenterindatabase();
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }

    }

    public function makeFeatured($key, $uid) {

        try {
            return $this->getItemService()->changeProductFeatureStatus($key, $uid);
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
    public function removed($key, $uid) {

        try {
            return $this->getItemService()->changeProductRemovedStatus($key, $uid);
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
    public function index() {
        try {
            return $this->getItemService()->index();
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
    public function pending() {
        try {
            return $this->getItemService()->pending();
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
    public function outofstock() {
        try {
            return $this->getItemService()->outofstock();
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
    public function deleted() {
        try {
            return $this->getItemService()->deleted();
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
            return $this->getItemService()->create();
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
    public function store(Request $request) {
        try {
            return $this->getItemService()->store($request);
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
    public function show($uid) {
        try {
            return $this->getItemService()->show($uid);
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
            return $this->getEditItemService()->edit($uid);
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
    public function update(ItemUpdate $request) {
        try {
            \Log::info($request->all());
            return $this->getEditItemService()->update($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * approve the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($key, $id) {
        try {
            return $this->getItemService()->makeItemLive($key, $id);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }


    /**
     * Add Variants the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createVariants($id, $page = NULL) {
        try {
            return $this->getItemVariantService()->createVairants($page, $id);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Add Variants the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeVariantsData(ItemVariantStore $request) {
        try {

//            dd($request->all());

            if ($request->validated()) {
                return $this->getItemVariantService()->storeVariantsData($request);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * editVariant method
     * this method is responsible for editing of a variant
     * @param type $uid
     * @return type
     */
    public function editVariant($uid) {
        try {
            return $this->getItemVariantService()->editVariant($uid);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * editVariant method
     * this method is responsible for editing of a variant
     * @param type $uid
     * @return type
     */
    public function updateVariant(ItemVariantStore $request) {
        try {
            return $this->getItemVariantService()->updateVariant($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }
    /**
     * itemColorSingleDelete method
     */
    public function itemColorSingleDelete(Request $request) {
        try {

            return $this->getItemVariantService()->itemColorSingleDeleteRow($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }


    /**
     * Add Variants the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addcolors($id, $page = NULL) {
        try {
            return $this->getItemVariantService()->addcolor($page, $id);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Add Variants the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeItemColorData(Request $request) {
        try {

            return $this->getItemVariantService()->storeitemColorData($request);

        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }


    /**
     * editVariant method
     * this method is responsible for editing of a variant
     * @param type $uid
     * @return type
     */
    public function editColor($uid) {
        try {
            return $this->getItemVariantService()->editColors($uid);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * editVariant method
     * this method is responsible for editing of a variant
     * @param type $uid
     * @return type
     */
    public function updateItemColor(Request $request) {
        try {

            return $this->getItemVariantService()->UpdateColor($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * editVariant method
     * this method is responsible for editing of a variant
     * @param type $uid
     * @return type
     */
    public function destroyitemColor($uid,$item_id,$status) {
        try {
            return $this->getItemVariantService()->destroyitemColor($uid,$item_id,$status);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }


    public function itemColorPartialsViewCall(Request $request) {
        try {

            return $this->getItemVariantService()->partialsViewCall($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * itemColorSingleDelete method
     */
    public function itemColorSingleUpdate(Request $request) {
        try {
            return $this->getItemVariantService()->itemColorSingleUdateRow($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }
    /**
     * Add Variants the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createTechSpec($id, $page = NULL) {
        try {
            return $this->getItemTechSpecService()->createTechSpec($page, $id);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Add Variants the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeTechSpecData(Request $request) {
        try {
            return $this->getItemTechSpecService()->storeTechSpecData($request);

        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * editVariant method
     * this method is responsible for editing of a variant
     * @param type $uid
     * @return type
     */
    public function editTechSpec($uid) {
        try {
            return $this->getItemTechSpecService()->editTechSpec($uid);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * updateTechSpec method
     * this method is responsible for editing of a variant
     * @param type $uid
     * @return type
     */
    public function updateTechSpec(Request $request) {
        try {
            return $this->getItemTechSpecService()->updateTechSpecs($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }/**
     * editVariant method
     * this method is responsible for editing of a variant
     * @param type $uid
     * @return type
     */
    public function deleteTechSpec(Request $request) {
        try {
            return $this->getItemTechSpecService()->deleteTechSpecs($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }


    /**
     * Add Variants the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createMetaData($id, $v_uid = null) {
        try {
            return $this->getItemService()->createMetaData($id, $v_uid);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Add Variants the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeMeataData(Request $request) {
        try {
            return $this->getItemService()->storeMetaData($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * addVideo method 
     * @param type $uid
     */
    public function addManual($uid) {
        try {
            return $this->getMetaDataService()->createManual($uid);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * storeManual method 
     * @param type $uid
     * @param VideoCreate $request
     */
    public function storeManual(ManualCreate $request) {
        try {
            return $this->getMetaDataService()->storeManual($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Edit Variants the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editManual($id) {
        try {
            return $this->getMetaDataService()->editManual($id);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * update Size of Variants the specified resource from storage.
     *
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function updateManual(ManualDataUpdate $request) {
        try {
            if ($request->validated()) {
                return $this->getMetaDataService()->updateManual($request);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * addVideo method 
     * @param type $uid
     */
    public function addVideoLink($uid) {
        try {
            return $this->getMetaDataService()->createVideo($uid);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * storeVideoLink method 
     * @param type $uid
     * @param VideoCreate $request
     */
    public function storeVideoLink(VideoCreate $request) {
        try {
            return $this->getMetaDataService()->storeVideoLink($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Edit Variants the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editVideo($id) {
        try {
            return $this->getMetaDataService()->editVideo($id);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * update Size of Variants the specified resource from storage.
     *
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function updateVideo(VideoDataUpdate $request) {
        try {
            if ($request->validated()) {

                return $this->getMetaDataService()->updateVideoLink($request);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * update Size of Variants the specified resource from storage.
     *
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function categoryItems($uuid) {
        try {
            return $this->getItemsListingService()->getCategoriesItems($uuid);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }

    /**
     * Add Variants the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeItemAccessories(Request $request) {
        try {
            return $this->getItemAccessoriesService()->store($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->exception($ex);
        } catch (\Exception $ex) {
            return $this->exception($ex);
        }
    }
    /**
     * Add Variants the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatusitemAccessorie($uid, $status) {
        try {
            return $this->getItemAccessoriesService()->state($uid, $status);
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
    public function addImgColor(Request $request) {
        try {
            return $this->getItemVariantService()->addImage($request);
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        } catch (\Exception $ex) {
            return $this->jsonErrorResponse($ex->getMessage());
        }
    }

}
