<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of Variant
 *
 * @author qadeer
 */

use App\Http\Services\Config;

class ItemVariant extends Config
{

    /**
     * createVairants method
     * create variant data of a concerned item
     * @param type $id
     * @return View
     */
    public function createVairants($page, $id)
    {

        $item = $this->getItemModel()->getItemByColumnValue('uuid', $id);
        $colors = $this->getColorModel()->where('archive', 0)->get();

        if (empty($item)) {
            return redirect()->route('dashboard')->with('error_message', 'No item data found.');
        }
        if ($page == 'details') {

            return View('pages.variants.variantsAdd', compact('id','colors'));
        }
        return View('pages.variants.variantsCreate', compact('id','colors'));
    }

    /**
     * createVairants method
     * create variant data of a concerned item
     * @param type $id
     * @return View
     */
    public function addcolor($page, $id)
    {
        $itemVariant = $this->getItemVariantModel()->getItemByColumnValue('uuid', $id);
        $colors = $this->getColorModel()->where('archive', 0)->get();

        if (empty($itemVariant)) {
            return redirect()->route('dashboard')->with('error_message', 'No item data found.');
        }
        if ($page == 'details') {

            return View('pages.itemColorImage.add', compact('id','colors','itemVariant'));
        }
        return View('pages.itemColorImage.add', compact('id','colors','itemVariant'));
    }

    /**
     * storeVariantsData method
     * stores variant data of a item
     * @param type $request
     * @return type
     */
    public function storeVariantsData($request)
    {
        $request_params = $request->except('_token');

//        $validate = $this->paramValidation($request_params);
//        if ($validate->fails()) {
//            return redirect()->back()->withInput($request_params)->with('error_message', $validate->errors()->first());
//        }

        $item = $this->getItemModel()->getItemByColumnValue('uuid', $request_params['item_id']);
        if (empty($item)) {

            return redirect()->back()->with('error_message', 'No item data found')->withInput($request_params);
        }
        \DB::beginTransaction();
        $request_params['item_id'] = $item->id;
//        $request_params['color_code'] = $request_params['color_code'];
        $variant = $this->getItemVariantModel()->create(['item_id' => $item->id]);
        $save_watt_unit = $this->updateWattUnit($request_params, $item);
        if (!$save_watt_unit) {
            return redirect()->back()->with('error_message', 'Unable to create unit of power.');
        }
        if ($variant) {
            $request_params['item_variant_id'] = $variant->id;
        } else {
            return redirect()->back()->with('error_message', 'Unable to create variant.');
        }
        return $this->processStoreVariantData($request_params, $item, $variant);
    }


    public function paramValidation($request_params)
    {

//        dd($request_params);
        $request_param_return =[];
        $counter=0;
        foreach($request_params['color'] as $key => $val){

//            dd($request_params[$key]['item_color']);
//            dd($request_params[$key]['color_qty']);


            if(empty($val['item_color']) || empty($val['color_qty']) || empty($request_params['color_image'][$key])){

                $request_param_return[$counter]['item_color'] =$val['item_color'];
                $request_param_return[$counter]['color_qty'] =$val['color_qty'];
                $request_param_return[$counter]['color_image'] =$request_params['color_image'][$key][0];
            }

            $counter ++;
//            $request_params['color_image'][$key][$val] =

//            $rules['color'.$key.'item_color'] = 'required|max:255';
//            $rules['color_image'.$key.'color_qty'] = 'required|max:255';
//            $rules['color_image'.$key] = 'required|max:255';

        }


        return $request_param_return;
    }


    /**
     * processStoreVariantData method
     * responsible for adding variant data
     * @param type $store_size
     * @param type $request_params
     * @param type $item
     * @param type $create_variant
     * @return type
     */
    public function processStoreVariantData($request_params, $item, $create_variant)
    {

        $size_parameters = $this->prepareSizeParameters($request_params);
        $store_size = $this->getItemSizeModel()->create($size_parameters);
        if ($store_size) {
            $store_color = $this->storeColorDatanewArray($request_params);
            if (!$store_color) {
                \DB::rollBack();
                return redirect()->back()->with('error_message', 'Internal server errror')->withInput($request_params);
            }
            if (!empty($request_params['type']) && $request_params['type'] == 'add') {
                \DB::commit();
                return redirect()->route('showItem', ['uid' => $item->uuid])->with('success_message', 'Item variants data has been saved successfully');
            }
            \DB::commit();
            return redirect()->route('createTechSpec', ['uid' => $item->uuid, 'v_uuid' => $create_variant->uuid])->with('success_message', 'Item variants data has been saved successfully');
        }
        \DB::rollBack();
        return redirect()->back()->with('error_message', 'Internal server error occured');
    }

    /**
     * prepareSizeParameters method
     * prepares data for item variant
     * @param type $reques_parameters
     * @return type
     */
    public function prepareSizeParameters($reques_parameters)
    {
        if (!empty($reques_parameters['weight_unit'])) {
            $weightunitarray = explode('-', $reques_parameters['weight_unit']);
        }
        $parameters = [];
        $parameters['item_id'] = $reques_parameters['item_id'];
        $parameters['item_variant_id'] = $reques_parameters['item_variant_id'];
        $parameters['weight'] = $reques_parameters['weight'];
        $parameters['weight_unit'] = !empty($weightunitarray[0]) ? $weightunitarray[0] : NULL;
        $parameters['weight_unit_ar'] = !empty($weightunitarray[1]) ? $weightunitarray[1] : NULL;
        if (!empty($reques_parameters['height']) || !empty($reques_parameters['width'])|| !empty($reques_parameters['lenght'])) {
            if (!empty($reques_parameters['orientation_unit'])) {
                $orientationunitarray = explode('-', $reques_parameters['orientation_unit']);
            }
            $parameters['lenght'] = !empty($reques_parameters['lenght']) ? $reques_parameters['lenght'] : NULL;
            $parameters['height'] = !empty($reques_parameters['height']) ? $reques_parameters['height'] : NULL;
            $parameters['width'] = !empty($reques_parameters['width']) ? $reques_parameters['width'] : NULL;
            $parameters['orientation_unit'] = !empty($orientationunitarray[0]) ? $orientationunitarray[0] : NULL;
            $parameters['orientation_unit_ar'] = !empty($orientationunitarray[1]) ? $orientationunitarray[1] : NULL;
        }
        return $parameters;
    }

    /**
     * storeColorData method
     * stores color data of a item
     * @param type $request_params
     * @return boolean
     */
    public function storeitemColorData($request){
        $request_params = $request->except('_token');
        $store_color = $this->storeitemColorsDatawithimage($request_params);
        if (!$store_color) {
            return redirect()->back()->with('error_message', 'Internal server errror')->withInput($request_params);
        }
        return redirect()->route('editVariant', ['id' => $request_params['item_variant_uuid']])->with('success_message', 'Item Colors data has been saved successfully');
    }

    public function storeitemColorsDatawithimage($request_params)
    {
        foreach ($request_params['color'] as $row) {
            if (!empty($row['color_qty'])) {
                $color['item_id'] = $request_params['item_id'];
                $color['item_variant_id'] = $request_params['item_variant_id'];
                if(!empty($row['item_color'])) {
                    $colorData = $this->getColorModel()->where('id',$row['item_color'])->first();
                    $color['en_color_name'] = !empty($colorData->en_title) ? $colorData->en_title : "";
                    $color['ar_color_name'] = !empty($colorData->ar_title) ? $colorData->ar_title : '';
                    $color['color_code'] = !empty($colorData->color_code) ? $colorData->color_code : "";
                }
                $color['color_quantity'] = !empty($row['color_qty'])?$row['color_qty']:1;
                $color['color_id'] = !empty($row['item_color'])?$row['item_color']:"";
                $color_store = $this->getItemColorModel()->create($color);
                if (!empty($row['image_name'])) {
                    $itemColorImagesarray = explode(',', $row['image_name']);
                    foreach ($itemColorImagesarray as $key=>$rowImage) {
                        if(!empty($rowImage)) {
                            $colorItem['item_id'] = $request_params['item_id'];
                            $colorItem['item_colors_id'] = $color_store->id;
                            $colorItem['item_variant_id'] = $request_params['item_variant_id'];
                            $colorItem['image'] = $rowImage;
                            if ($key == 0) {
                                $colorItem['is_default'] = 1;
                            } else {
                                $colorItem['is_default'] = 0;
                            }
                            $this->getitemColorImagesModel()->create($colorItem);
                        }
                    }
                }else{
//                    dd($request_params);
//                    $key =1;
//                    if(!empty($request_params['color_image'][$key])) {
//                        foreach ($request_params['color_image'][$key] as $rowImage) {
//
//                            if (!empty($rowImage)) {
//                                $colorItem['item_id'] = $request_params['item_id'];
//                                $colorItem['item_colors_id'] = $color_store->id;
//                                $colorItem['item_variant_id'] = $request_params['item_variant_id'];
//                                $colorItem['image'] = $rowImage;
//                                if ($key == 0) {
//                                    $colorItem['is_default'] = 1;
//                                } else {
//                                    $colorItem['is_default'] = 0;
//                                }
//                                $this->getitemColorImagesModel()->create($colorItem);
//                            }
//                        }
//                    }

                    if(!empty($request_params['images'])) {
                        foreach ($request_params['images'] as $key => $rowImage) {
                            if (!empty($rowImage)) {
                                $colorItem['item_id'] = $request_params['item_id'];
                                $colorItem['item_colors_id'] = $color_store->id;
                                $colorItem['item_variant_id'] = $request_params['item_variant_id'];
                                $colorItem['image'] = !empty($rowImage) ? $rowImage : '';
                                if ($key == 0) {
                                    $colorItem['is_default'] = 1;
                                } else {
                                    $colorItem['is_default'] = 0;
                                }
                                $this->getitemColorImagesModel()->create($colorItem);
                            }
                        }
                    }
                }

            }
        }
        if (!empty($color_store)) {
            return true;
        }
        return true;
    }


    public function storeColorDatanewArray($request_params)
    {
        foreach ($request_params['color'] as $key => $row) {

            if (!empty($row['color_qty'])) {
                $color['item_id'] = $request_params['item_id'];
                $color['item_variant_id'] = $request_params['item_variant_id'];
                if (!empty($row['item_color'])) {
                    $colorData = $this->getColorModel()->where('id', $row['item_color'])->first();
                    $color['en_color_name'] = !empty($colorData->en_title) ? $colorData->en_title : "";
                    $color['ar_color_name'] = !empty($colorData->ar_title) ? $colorData->ar_title : '';
                    $color['color_code'] = !empty($colorData->color_code) ? $colorData->color_code : "";
                }
                $color['color_quantity'] = !empty($row['color_qty']) ? $row['color_qty'] : 1;
                $color['color_id'] = !empty($row['item_color']) ? $row['item_color'] : "";
                $color_store = $this->getItemColorModel()->create($color);
                if(!empty($request_params['color_image'][$key])) {
                    foreach ($request_params['color_image'][$key] as $rowImage) {

                        if (!empty($rowImage)) {
                            $colorItem['item_id'] = $request_params['item_id'];
                            $colorItem['item_colors_id'] = $color_store->id;
                            $colorItem['item_variant_id'] = $request_params['item_variant_id'];
                            $colorItem['image'] = $rowImage;
                            if ($key == 0) {
                                $colorItem['is_default'] = 1;
                            } else {
                                $colorItem['is_default'] = 0;
                            }
                            $this->getitemColorImagesModel()->create($colorItem);
                        }
                    }
                }
            }
        }

//            if (!empty($row['color_qty'])) {
//                $color['item_id'] = $request_params['item_id'];
//                $color['item_variant_id'] = $request_params['item_variant_id'];
//                if(!empty($row['item_color'])) {
//                    $colorData = $this->getColorModel()->where('id',$row['item_color'])->first();
//                    $color['en_color_name'] = !empty($colorData->en_title) ? $colorData->en_title : "";
//                    $color['ar_color_name'] = !empty($colorData->ar_title) ? $colorData->ar_title : '';
//                    $color['color_code'] = !empty($colorData->color_code) ? $colorData->color_code : "";
//                }
//                $color['color_quantity'] = !empty($row['color_qty'])?$row['color_qty']:1;
//                $color['color_id'] = !empty($row['item_color'])?$row['item_color']:"";
//                $color_store = $this->getItemColorModel()->create($color);
//                if (!empty($row['image_name'])) {
//                    $itemColorImagesarray = explode(',', $row['image_name']);
//                    foreach ($itemColorImagesarray as $key=>$rowImage) {
//                     if(!empty($rowImage)) {
//                         $colorItem['item_id'] = $request_params['item_id'];
//                         $colorItem['item_colors_id'] = $color_store->id;
//                         $colorItem['item_variant_id'] = $request_params['item_variant_id'];
//                         $colorItem['image'] = $rowImage;
//                         if ($key == 0) {
//                             $colorItem['is_default'] = 1;
//                         } else {
//                             $colorItem['is_default'] = 0;
//                         }
//                         $this->getitemColorImagesModel()->create($colorItem);
//                     }
//                    }
//                }
//            }

        if (!empty($color_store)) {
            return true;
        }
        return true;
    }

    public function storeColorData($request_params)
    {
        foreach ($request_params['color'] as $row) {
            if (!empty($row['color_qty'])) {
                $color['item_id'] = $request_params['item_id'];
                $color['item_variant_id'] = $request_params['item_variant_id'];
                if(!empty($row['item_color'])) {
                    $colorData = $this->getColorModel()->where('id',$row['item_color'])->first();
                    $color['en_color_name'] = !empty($colorData->en_title) ? $colorData->en_title : "";
                    $color['ar_color_name'] = !empty($colorData->ar_title) ? $colorData->ar_title : '';
                    $color['color_code'] = !empty($colorData->color_code) ? $colorData->color_code : "";
                }
                $color['color_quantity'] = !empty($row['color_qty'])?$row['color_qty']:1;
                $color['color_id'] = !empty($row['item_color'])?$row['item_color']:"";
                $color_store = $this->getItemColorModel()->create($color);
                if (!empty($row['image_name'])) {
                    $itemColorImagesarray = explode(',', $row['image_name']);
                    foreach ($itemColorImagesarray as $key=>$rowImage) {
                        if(!empty($rowImage)) {
                            $colorItem['item_id'] = $request_params['item_id'];
                            $colorItem['item_colors_id'] = $color_store->id;
                            $colorItem['item_variant_id'] = $request_params['item_variant_id'];
                            $colorItem['image'] = $rowImage;
                            if ($key == 0) {
                                $colorItem['is_default'] = 1;
                            } else {
                                $colorItem['is_default'] = 0;
                            }
                            $this->getitemColorImagesModel()->create($colorItem);
                        }
                    }
                }
            }
        }
        if (!empty($color_store)) {
            return true;
        }
        return true;
    }

    /**
     * editVariant method
     * this method return edit view with data
     * @param type $uid
     * @return type
     */
    public function editVariant($uid)
    {
        $variant = $this->getItemVariantModel()->getByColVal('uuid', $uid);
        $itemColorImages = $this->getItemColorModel()->getItemColor($variant->id);
        $itemColorImage = $this->prepareItemColorQuantityForEditPage($variant->item_id,$itemColorImages);
//        dd($itemColorImage);
        $otherunit = $this->getItemOtherUnitModel()->getByColVal('item_id', $variant->item_id);
        $colors = $this->getColorModel()->where('archive', '=', 0)->get();
        return view('pages.variants.variantsEdit', compact('variant', 'otherunit','itemColorImage','colors'));
    }
    /**
     * editVariant method
     * this method return edit view with data
     * @param type $uid
     * @return type
     */



    /**
     *
     * @param type $item
     * @return int
     */
    public function prepareItemColorQuantityForEditPage($id,$itemColorImage)
    {
        $itemColorImages=[];
        foreach ($itemColorImage as $key=>$row) {
            $cart_quantity = $this->prepareItemQuantityForEditPage($id,$row->id,$row->color_quantity);
            $itemColorImages[$key]['color_quantity']  = $cart_quantity <= 0 ? 0 : $cart_quantity ;
            $itemColorImages[$key]['en_color_name'] = $row->en_color_name;
            $itemColorImages[$key]['color_image'] = $row->color_image;
            $itemColorImages[$key]['color_code'] = $row->color_code;
            $itemColorImages[$key]['uuid'] = $row->uuid;
            $itemColorImages[$key]['archive'] = $row->archive;
            $itemColorImages[$key]['colorItemsImages'] = $row->colorItemsImages;
        }
        return $itemColorImages;
    }
    public function prepareItemQuantityForEditPage($id,$itemColorImage,$itemColorQty)
    {
        $total_sold_item = $this->getOrderItemModel()->fetchSoldItemsColorQty($id, $itemColorImage);
        $remaining_stock = $itemColorQty - $total_sold_item;
        if ($remaining_stock <= 0) {
            return 0;
        } elseif ($remaining_stock > 0) {
            return $remaining_stock;
        } else {
            return $itemColorQty;
        }
    }

    public function editColors($uid)
    {
        $itemColors = $this->getItemColorModel()->getByColVal('uuid', $uid);
        $itemColorImage = $this->getitemColorImagesModel()->getByColVal('item_colors_id',$itemColors->id);
        $cart_quantity = $this->prepareItemQuantityForEditPage($itemColors->item_id,$itemColors->id,$itemColors->color_quantity);
        $itemColors->color_quantity = $cart_quantity <= 0 ? 0 : $cart_quantity ;
//        $itemColors->color_quantity = $cart_quantity <= 0 ? 0 : $cart_quantity <= $itemColors->color_quantity ? $cart_quantity : $itemColors->color_quantity ;
        $colors = $this->getColorModel()->where('archive', '=', 0)->get();
        return view('pages.itemColorImage.edit', compact('itemColors','itemColorImage','colors'));
    }

    /**
     * updateVariant method
     * responsible for updating record
     * @param type $request
     */
    public function updateVariant($request)
    {

        $request_params = $request->except('_token');
        $item = $this->getItemModel()->getItemByColumnValue('id', $request_params['item_id']);
//        if ($request_params['color_id']) {
//            if (empty($request_params['en_color_name']) || empty($request_params['ar_color_name'])) {
//                return redirect()->back()->with('error_message', 'Product variants color data is not enetered correctly');
//            }
//        }
//        $save_color = $this->updateVariantColor($request_params, $item);
        $save_watt_unit = $this->updateWattUnit($request_params, $item);
        $save_size = $this->updateVariantSize($request_params);
        if ($save_size && $save_watt_unit) {
            return redirect()->route('showItem', ['uid' => $item->uuid])->with('success_message', 'Product variants data has been updated successfully');
        } else {
            return redirect()->back()->with('error_message', 'Product variants data has not been updated successfully');
        }
    }

    /**
     * updateVariant method
     * responsible for updating record
     * @param type $request
     */
    public function UpdateColor($request)
    {

        $request_params = $request->except('_token');
        $variantuuid=$this->getItemVariantModel()->getItemByColumnValue('id', $request_params['editVariantId']);
        $perpareQty=  $this->prepareItemColorsQuantity($variantuuid->item_id,$request_params);
        $request_params['color_qty']=$perpareQty['color_qty'];
        $store_color = $this->updateColorData($request_params);
        return redirect()->route('editVariant', ['id' => $variantuuid->uuid])->with('success_message', 'Item Colors data has been Updated successfully');
    }


    protected function prepareItemColorsQuantity($item_id,$request_parms)
    {
        $item = $this->getItemModel()->getItemDetailsByColumnValue('id', $item_id);
        $total_sold_item = $this->getOrderItemModel()->fetchSoldItemsColorQty($item_id,$request_parms['itemColorsId']);
        $arr['color_qty'] = $request_parms['color_qty'] + $total_sold_item;
        if (($arr['color_qty'] - $total_sold_item) < $item->cart_quantity) {
            $arr['cart_quantity'] = $arr['color_qty'] - $total_sold_item;
        } elseif ($arr['color_qty'] == 0) {
            $arr['cart_quantity'] = 0;
            $arr['is_sold'] = 1;
        } else {
            $arr['cart_quantity'] = 0;
        }
        $this->getItemQuantityLogService()->logUpdateQuantityItemColor($item, $arr);
        return $arr;
    }


    public function destroyitemColor($uid,$item_id, $status)
    {
          if ($status == 'in-active') {
              $archive = 1;
          } else {
              $archive = 0;
          }
        $itemColor = $this->getItemColorModel()->where('item_id', $item_id)->where('archive', 0)->get();
        if(count($itemColor) > 1) {
            $update = $this->getItemColorModel()->where('uuid', $uid)->update(['archive' => $archive]);
            if ($update) {
                return redirect()->back()->with('success_message', 'Item Colors data has been Deleted successfully');
            } else {

                return redirect()->back()->with('error_message', 'Internal server error occured');
            }
        }else{
            return redirect()->back()->with('error_message', 'Item Colors  has not been deleted.Because only one color exist in this product. ');
        }

    }
    public function partialsViewCall()
        {
            $row_id = rand();
            $colors = $this->getColorModel()->where('archive', '=', 0)->get();
            $html = view('partials.variantItemColor', compact('colors','row_id'))->render();
            return $this->jsonSuccessResponse('Item Color has been deleted.', $html);
//            return Response::json(['html' => $html]);

        }

    public function updateColorData($request_params)
    {

        $itemcolrdata['color_quantity']=$request_params['color_qty'];
        if(!empty($request_params['item_color_id'])) {
            $itemcolrdata['color_id'] = $request_params['item_color_id'];
        }
        $this->getItemColorModel()->where('id',$request_params['itemColorsId'])->update($itemcolrdata);
        $color_update = $this->getItemColorModel()->where('id',$request_params['itemColorsId'])->first();
        $color_image_delete =$this->getitemColorImagesModel()->where('item_colors_id',$request_params['itemColorsId'])->delete();
                if (!empty($request_params['images'])) {

                    foreach ($request_params['images'] as $key=>$rowImage) {
                        if(!empty($rowImage)) {
                            $colorItem['item_id'] = $color_update->item_id;
                            $colorItem['item_colors_id'] = $request_params['itemColorsId'];
                            $colorItem['item_variant_id'] = $color_update->item_variant_id;
                            $colorItem['image'] = $rowImage;
                            if ($key == 0) {
                                $colorItem['is_default'] = 1;
                            } else {
                                $colorItem['is_default'] = 0;
                            }
                            $this->getitemColorImagesModel()->create($colorItem);
                        }
                    }
                }
        if (!empty($color_store)) {
            return true;
        }
        return true;
    }
     /**
         * updateVariant method
         * responsible for updating record
         * @param type $request
         */
        public function itemColorSingleDeleteRow($request)
        {
            $request_params = $request->except('_token');
            $Itemcolor['archive'] = 1;
            $itemColorDelete = $this->getItemColorModel()->where('id',$request_params['itemColorId'])->update($Itemcolor);
            return $this->jsonSuccessResponse('Item Color has been deleted.', $itemColorDelete);
        }

        /**
         * updateVariant method
         * responsible for updating record
         * @param type $request
         */
        public function itemColorSingleUdateRow($request)
        {
            $request_params = $request->except('_token');
            $Itemcolor['color_qty'] = $request_params['color_qty'];
            $itemColorUpdate = $this->getItemColorModel()->where('id',$request_params['itemColorId'])->update($Itemcolor);
           if($itemColorUpdate){
               $itemColorImage= $this->getitemColorImagesModel()->where('item_colors_id', $request_params['itemColorId'])->get();

               $itemColorDelete = $this->getitemColorImagesModel()->where('id', $request_params['image_item_id'])->update($Itemcolor);

           }

            return $this->jsonSuccessResponse('Item Color has been deleted.', $itemColorDelete);
        }

    /**
     *
     * @param type $request_params
     * @param type $item
     * @return type
     */
    private function updateWattUnit($request_params, $item)
    {


        $unitarray = explode('-', $request_params['unit_of_power']['unit']);
        if (!empty($request_params['unit_of_power']['otherunit_id'])) {
            $otherunitId = $this->getItemOtherUnitModel()->where('id', $request_params['unit_of_power']['otherunit_id'])->first();
        }
        if (!empty($request_params['unit_of_power']['value'])) {
            $otherunit['label_en'] = $request_params['unit_of_power']['label_en'];
            $otherunit['unit_en'] = isset($unitarray['0']) ? $unitarray['0'] : '';
            $otherunit['value_en'] = $request_params['unit_of_power']['value'];
            $otherunit['label_ar'] = $request_params['unit_of_power']['label_ar'];
            $otherunit['unit_ar'] = isset($unitarray['1']) ? $unitarray['1'] : '';
            $otherunit['value_ar'] = $request_params['unit_of_power']['value'];
        } else {
            $otherunit['label_en'] = null;
            $otherunit['unit_en'] = null;
            $otherunit['value_en'] = null;
            $otherunit['label_ar'] = null;
            $otherunit['unit_ar'] = null;
            $otherunit['value_ar'] = null;
        }
        if (empty($otherunitId)) {
            if (!empty($request_params['unit_of_power']['value'])) {
                $otherunit['item_id'] = $item->id;
                $otherunit['status'] = 0;
                $otherunit['archive'] = 0;
                $otherunit = $this->getItemOtherUnitModel()->create($otherunit);
                return $otherunit;
            }
            return true;
        } else {
            $otherunit = $this->getItemOtherUnitModel()->where('id', $otherunitId->id)->update($otherunit);
            return $otherunit;
        }

    }

    /**
     *
     * @param type $request_params
     * @param type $item
     * @return type
     */
    private function updateVariantSize($request_params)
    {


        $size = $this->getItemSizeModel()->getByColVal('id', $request_params['size_id']);
        if (!empty($request_params['weight_unit'])) {

            $weightunitarray = explode('-', $request_params['weight_unit']);
            $size->weight_unit = $weightunitarray[0];
            $size->weight_unit_ar = $weightunitarray[1];
        }
        $size->weight = $request_params['weight'];

        if (!empty($request_params['width']) || !empty($request_params['height'])|| !empty($request_params['lenght'])) {
            if (!empty($request_params['orientation_unit'])) {
                $orientationunitarray = explode('-', $request_params['orientation_unit']);
                $size->orientation_unit = $orientationunitarray[0];
                $size->orientation_unit_ar = $orientationunitarray[1];
            }
        } else {
            $size->orientation_unit = null;
            $size->orientation_unit_ar = null;
        }
        $size->width = $request_params['width'];
        $size->height = $request_params['height'];
        $size->lenght = $request_params['lenght'];
        return $size->save();


    }

    /**
     *
     * @param type $request_params
     * @param type $item
     * @return type
     */
    private function updateVariantColor($request_params, $item)
    {

        if ($request_params['color_id']) {
            $color = $this->getItemColorModel()->getByColVal('id', $request_params['color_id']);
            $color->en_color_name = $request_params['en_color_name'];
            $color->ar_color_name = $request_params['ar_color_name'];
            $color->color_code = $request_params['color_code'];
            return $color->save();
        } elseif (!empty($request_params['en_color_name']) && !empty($request_params['ar_color_name']) && !empty($request_params['color_code'])) {
            $color['item_id'] = $item->id;
            $color['item_variant_id'] = $request_params['variant_id'];
            $color['en_color_name'] = $request_params['en_color_name'];
            $color['ar_color_name'] = $request_params['en_color_name'];
            $color['color_code'] = $request_params['color_code'];
            return $this->getItemColorModel()->create($color);
        }
        return true;
    }

    public function addImage($request) {
        $upload = $this->uploadSingleImage($request->file('image'), $this->s3_image_paths['item_color_images'], 'itemcolor_');
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
