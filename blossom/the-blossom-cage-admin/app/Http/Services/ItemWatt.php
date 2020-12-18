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

class ItemWatt extends Config {

    /**
     * createVairants method 
     * create variant data of a concerned item
     * @param type $id
     * @return View
     */
    public function createWatts($page, $id) {

        $item = $this->getItemModel()->getItemByColumnValue('uuid', $id);
        if (empty($item)) {
            return redirect()->route('dashboard')->with('error_message', 'No item data found.');
        }
        if ($page == 'details') {
            return View('pages.watt.wattAdd', compact('id'));
        }
        return View('pages.watt.wattCreate', compact('id'));
    }

    /**
     * storeWattsData method
     * stores variant data of a item
     * @param type $request
     * @return type
     */
    public function storeWattData($request) {

        $request_params = $request->except('_token');
        $item = $this->getItemModel()->getItemByColumnValue('uuid', $request_params['item_id']);
        if (empty($item)) {

            return redirect()->back()->with('error_message', 'No item data found')->withInput($request_params);
        }
        \DB::beginTransaction();
        $request_params['item_id'] = $item->id;
        $request_params['color_code'] = $request_params['color_code'];
        $variant = $this->getItemVariantModel()->create(['item_id' => $item->id]);
        if ($variant) {
            $request_params['item_variant_id'] = $variant->id;
        } else {
            return redirect()->back()->with('error_message', 'Unable to create variant.');
        }
        return $this->processStoreWattData($request_params, $item, $variant);
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
    public function processStoreWattData($request_params, $item, $create_variant) {

        $size_parameters = $this->prepareSizeParameters($request_params);
        $store_size = $this->getItemSizeModel()->create($size_parameters);
        if ($store_size) {
            $store_color = $this->storeColorData($request_params);
            if (!$store_color) {
                \DB::rollBack();
                return redirect()->back()->with('error_message', 'Internal server errror')->withInput($request_params);
            }
            if (!empty($request_params['type']) && $request_params['type'] == 'add') {
                \DB::commit();
                return redirect()->route('showItem', ['uid' => $item->uuid])->with('success_message', 'Item variants data has been saved successfully');
            }
            \DB::commit();
            return redirect()->route('createMetaData', ['uid' => $item->uuid, 'v_uuid' => $create_variant->uuid])->with('success_message', 'Item variants data has been saved successfully');
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
    public function prepareSizeParameters($reques_parameters) {
        $parameters = [];
        $parameters['item_id'] = $reques_parameters['item_id'];
        $parameters['item_variant_id'] = $reques_parameters['item_variant_id'];
        $parameters['weight'] = $reques_parameters['weight'];
        $parameters['weight_unit'] = $reques_parameters['weight_unit'];
        $parameters['height'] = !empty($reques_parameters['height']) ? $reques_parameters['height'] : NULL;
        $parameters['width'] = !empty($reques_parameters['width']) ? $reques_parameters['width'] : NULL;
        $parameters['orientation_unit'] = !empty($reques_parameters['orientation_unit']) ? $reques_parameters['orientation_unit'] : NULL;
        return $parameters;
    }

    /**
     * storeColorData method
     * stores color data of a item
     * @param type $request_params
     * @return boolean
     */
    public function storeColorData($request_params) {

        if (!empty($request_params['en_color_name']) && !empty($request_params['ar_color_name']) && !empty($request_params['color_code'])) {
            $color['item_id'] = $request_params['item_id'];
            $color['item_variant_id'] = $request_params['item_variant_id'];
            $color['en_color_name'] = $request_params['en_color_name'];
            $color['ar_color_name'] = $request_params['ar_color_name'];
            $color['color_code'] = $request_params['color_code'];
            if (!empty($request_params['color_image']) && isset($request_params['color_image'])) {
                $filename = $this->uploadSingleImage($request_params['color_image'], $this->s3_image_paths['item_color_images'], 'item_color');
                $color['color_image'] = $filename['file_name'];
            } else {
                $color['color_image'] = NULL;
            }
            $color_store = $this->getItemColorModel()->create($color);
            if ($color_store) {
                return true;
            }
        } else {
            return true;
        }
    }

    /**
     * editWatt method
     * this method return edit view with data
     * @param type $uid
     * @return type
     */
    public function editWatt($uid) {

        $variant = $this->getItemWattModel()->getByColVal('uuid', $uid);
        return view('pages.watt.wattEdit', compact('variant'));
    }

    /**
     * updateWatt method
     * responsible for updating record
     * @param type $request
     */
    public function updateWatt($request) {

        $request_params = $request->except('_token');
        $item = $this->getItemModel()->getItemByColumnValue('id', $request_params['item_id']);
        if ($request_params['color_id']) {
            if (empty($request_params['en_color_name']) || empty($request_params['ar_color_name'])) {
                return redirect()->back()->with('error_message', 'Product variants color data is not enetered correctly');
            }
        }
        $save_color = $this->updateVariantColor($request_params, $item);
        $save_size = $this->updateVariantSize($request_params);
        if ($save_color && $save_size) {
            return redirect()->route('showItem', ['uid' => $item->uuid])->with('success_message', 'Product variants data has been updated successfully');
        } else {
            return redirect()->back()->with('error_message', 'Product variants data has not been updated successfully');
        }
    }

    /**
     * 
     * @param type $request_params
     * @param type $item
     * @return type
     */
    private function updateWattSize($request_params) {
        $size = $this->getItemSizeModel()->getByColVal('id', $request_params['size_id']);
        $size->width = $request_params['width'];
        $size->height = $request_params['height'];
        $size->orientation_unit = $request_params['orientation_unit'];
        $size->weight = $request_params['weight'];
        $size->weight_unit = $request_params['weight_unit'];
        return $size->save();
    }

    /**
     * 
     * @param type $request_params
     * @param type $item
     * @return type
     */
    private function updateVariantColor($request_params, $item) {

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

}
