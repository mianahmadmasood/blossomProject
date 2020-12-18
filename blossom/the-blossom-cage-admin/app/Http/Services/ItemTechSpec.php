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

class ItemTechSpec extends Config
{

    /**
     * createVairants method
     * create variant data of a concerned item
     * @param type $id
     * @return View
     */
    public function createTechSpec($page, $id)
    {

        $item = $this->getItemModel()->getItemByColumnValue('uuid', $id);
        if (empty($item)) {
            return redirect()->route('dashboard')->with('error_message', 'No item data found.');
        }
        if ($page == 'details') {
            return View('pages.technicalSpec.techSpecAdd', compact('id'));
        }
        return View('pages.technicalSpec.techSpecCreate', compact('id'));
    }

    /**
     * storeVariantsData method
     * stores variant data of a item
     * @param type $request
     * @return type
     */
    public function storeTechSpecData($request)
    {

        $request_params = $request->except('_token');
        $item = $this->getItemModel()->getItemByColumnValue('uuid', $request_params['item_id']);
        if (empty($item)) {

            return redirect()->back()->with('error_message', 'No item data found')->withInput($request_params);
        }
        \DB::beginTransaction();
        $request_params['item_id'] = $item->id;

        if (!empty($request_params['techspecs'])) {
            return $this->createItemSpecification($item, $request_params);

        } else {
            DB::commit();
            return redirect()->route('createVairants', ['id' => $item->uuid])->with('success_message', 'Product data saved successfully.');
        }


        if ($variant) {
            $request_params['item_variant_id'] = $variant->id;
        } else {
            return redirect()->back()->with('error_message', 'Unable to create variant.');
        }
        return $this->processStoreVariantData($request_params, $item, $variant);
    }


    /**
     *
     * @param type $item
     * @param type $request_params
     * @return type
     */
    protected function createItemSpecification($item, $request_params)
    {

        foreach ($request_params['techspecs'] as $row) {

            if (!empty($row['specs_en'])) {
                if (!empty($row['unit'])) {
                    $unitArray = explode('-', $row['unit']);
                }
                $specs['type'] = 'en';
                $specs['item_id'] = $item->id;
                $specs['title'] = $row['specs_en'];
                $specs['value'] = $row['specs_value_en'];
                $specs['unit'] = !empty($unitArray[1]) ? $unitArray[1] : "";
                $specs['desp_unit'] = !empty($unitArray[0]) ? $unitArray[0] : "";
                $create_en_specs = $this->getItemSpecificationModel()->create($specs);
                if ($create_en_specs) {
                    $specs['type'] = 'ar';
                    $specs['title'] = $row['specs_ar'];
                    $specs['value'] = $row['specs_value_ar'];
                    $specs['desp_unit'] = !empty($unitArray[2]) ? $unitArray[2] : "";
                    $specs['unit'] = !empty($unitArray[3]) ? $unitArray[3] : "";
                    $create_ar_specs = $this->getItemSpecificationModel()->create($specs);
                } else {
                    \DB::rollBack();
                    return redirect()->back()->with('error_message', 'Internal server errror')->withInput($request_params);
                }
            }
        }

        if (!empty($request_params['type']) && $request_params['type'] == 'add') {
            \DB::commit();
            return redirect()->route('showItem', ['uid' => $item->uuid])->with('success_message', 'Item Technical Specification data has been saved successfully');
        } else {
            \DB::commit();
            return redirect()->route('createMetaData', ['id' => $item->uuid])->with('success_message', 'Product data saved successfully.');
        }

    }


    /**
     * editVariant method
     * this method return edit view with data
     * @param type $uid
     * @return type
     */
    public function editTechSpec($uid)
    {
        $techspecs = $this->getItemSpecificationModel()->where('item_id', $uid)->get();
        $item_id=$uid;
        $counter = 0;
        $techspec = [];
        if ($techspecs) {
            foreach ($techspecs as $row) {
                if ($row->type == 'en') {
                    $techspec[$counter]['title_en'] = $row->title;
                    $techspec[$counter]['value_en'] = $row->value;
                    $techspec[$counter]['desp_unit'] = $row->desp_unit;
                    $techspec[$counter]['id_en'] = $row->id;
                } elseif ($row->type == 'ar') {
                    $techspec[$counter]['title_ar'] = $row->title;
                    $techspec[$counter]['value_ar'] = $row->value;
                    $techspec[$counter]['id_ar'] = $row->id;
                    $counter++;
                }
            }
        }

        return view('pages.technicalSpec.techSpecEdit', compact('techspec', 'item_id'));
    }

    /**
     * updateVariant method
     * responsible for updating record
     * @param type $request
     */
    public function updateTechSpecs($request)
    {

        $request_params = $request->except('_token');
        $item = $this->getItemModel()->getItemByColumnValue('id', $request_params['item_id']);
        if (empty($item)) {
            return redirect()->back()->with('error_message', 'Product data not found.');
        }
        $save_ItemtenhSpec = $this->updateItemTechSpecs($request_params['techspecs'], $item);
        if ($save_ItemtenhSpec) {
            return redirect()->route('showItem', ['uid' => $item->uuid])->with('success_message', 'Product Technical Specification data has been updated successfully');
        } else {
            return redirect()->back()->with('error_message', 'Product Technical Specification data has not been updated successfully');
        }
    }


    /**
     *
     * @param type $request_params
     * @param type $item
     * @return type
     */
    private function updateItemTechSpecs($request_params, $item)
    {

        // dd($request_params);
        foreach ($request_params as $row){
            $unitArray = [];
            if (!empty($row['specs_en'])) {

                if (!empty($row['unit'])) {
                    $unitArray = explode('-', $row['unit']);
                }
                $specsEn['title'] = $row['specs_en'];
                $specsEn['value'] = $row['specs_value_en'];
                $specsEn['unit'] = !empty($unitArray[1]) ? $unitArray[1] : "";
                $specsEn['desp_unit'] = !empty($unitArray[0]) ? $unitArray[0] : "";
                if(!empty($row['specIden'])){
                    $create_en_specs = $this->getItemSpecificationModel()->where('id',$row['specIden'])->update($specsEn);
                }
                else{
                    $specsEn['type'] = 'en';
                    $specsEn['item_id'] = $item->id;
                    $create_en_specs = $this->getItemSpecificationModel()->create($specsEn);
                }

                if ($create_en_specs) {
                    $specs['title'] = $row['specs_ar'];
                    $specs['value'] = $row['specs_value_ar'];
                    $specs['desp_unit'] = !empty($unitArray[2]) ? $unitArray[2] : "";
                    $specs['unit'] = !empty($unitArray[3]) ? $unitArray[3] : "";
                    if(!empty($row['specIdar'])){
                        $create_en_specs = $this->getItemSpecificationModel()->where('id',$row['specIdar'])->update($specs);
                    }else{
                        $specs['type'] = 'ar';
                        $specs['item_id'] = $item->id;
                        $create_ar_specs = $this->getItemSpecificationModel()->create($specs);
                    }
                } else {
                    \DB::rollBack();
                    return redirect()->back()->with('error_message', 'Internal server errror')->withInput($request_params);
                }
            }
        }
        return true;
    }




}
