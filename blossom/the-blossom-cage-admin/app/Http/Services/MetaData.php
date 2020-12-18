<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of MetaData
 *
 * @author qadeer
 */
use App\Http\Services\Config;

class MetaData extends Config {

    /**
     * 
     * @param type $uid
     * @return type
     */
    public function createManual($uid) {


        return View('pages.metadata.addManual', compact('uid'));
    }

    public function storeManual($request) {

        $request_params = $request->except('_token');




        if(empty($request_params['ar_file'])) {
            return redirect()->back()->withInput($request_params)->with('error_message', 'The arabic file field is required');
        }else{
            $fileSizeBytesar = filesize($request_params['ar_file']);
            $fileSizeMBsar = ($fileSizeBytesar / 1024 / 1024);
            $fileSizeMBar = number_format($fileSizeMBsar, 2);
            if ($fileSizeMBar > 4) {
                return redirect()->back()->withInput($request_params)->with('error_message', 'Failed to upload an file. The file maximum size is 4MB.');
            }
        }
        if(empty($request_params['en_file'])) {
            return redirect()->back()->withInput($request_params)->with('error_message', 'The english file field is required');
        }else{
            $fileSizeBytes = filesize($request_params['ar_file']);
            $fileSizeMB = ($fileSizeBytes / 1024 / 1024);
            $fileSizeMB = number_format($fileSizeMB, 2);
           if($fileSizeMB > 4){
               return redirect()->back()->withInput($request_params)->with('error_message', 'Failed to upload an file. The file maximum size is 4MB.');
           }
        }

        $item = $this->getItemModel()->getItemDetailsByColumnValue('uuid', $request_params['item_id']);
        \DB::beginTransaction();
        $en_manual = [];
        $en_manual['item_id'] = $item->id;
        $en_manual['title'] = $request_params['en_title'];
        $en_manual['type'] = 'en';
        $en_manual['description'] = !empty($request_params['en_description']) ? $request_params['en_description'] : NULL;
        $upload_manual = $this->uploadSignPDF($request_params['en_file'], $this->s3_image_paths['manual_pdf'], 'manual_');
        if ($upload_manual['success']) {
            $en_manual['file'] = $upload_manual['file_name'];
        } else {
            \DB::rollback();
            return redirect()->back()->withInput($request_params)->with('error_message', 'English manual file could not be uploaded');
        }
        $create_manual = $this->getItemManualModel()->create($en_manual);
        if ($create_manual) {
            return $this->processStoreManual($request_params, $item);
        }
    }

    public function processStoreManual($request_params, $item) {

        $ar_manual['item_id'] = $item->id;
        $ar_manual['title'] = $request_params['ar_title'];
        $ar_manual['type'] = 'ar';
        $ar_manual['description'] = !empty($request_params['ar_description']) ? $request_params['ar_description'] : NULL;
        $upload_manual = $this->uploadSignPDF($request_params['ar_file'], $this->s3_image_paths['manual_pdf'], 'manual_');
        if ($upload_manual['success']) {
            $ar_manual['file'] = $upload_manual['file_name'];
        } else {
            \DB::rollback();
            return redirect()->back()->withInput($request_params)->with('error_message', 'Arabic manual file could not be uploaded');
        }
        $create_manual = $this->getItemManualModel()->create($ar_manual);
        if ($create_manual) {
            \DB::commit();
            return redirect()->route('showItem', ['uuid' => $item->uuid])->with('success_message', 'Item manual has been update successfully.');
        }
    }

    /**
     * editManual method
     * prepares manual to edit
     * @param type $uid
     * @return type
     */
    public function editManual($uid) {
        $manual = $this->getItemManualModel()->where('uuid', $uid)->first();
        $item = $this->getItemModel()->where('id', $manual->item_id)->first();
        $itemUuid =$item->uuid;
        return View('pages.items.editManual', compact('manual','itemUuid'));
    }

    /**
     * updateManual method 
     * updates the manual data of item in the database
     * @param type $request
     * @return type
     */
    public function updateManual($request) {
        
        $request_params = $request->except('_token');
        $item = $this->getItemModel()->getItemDetailsByColumnValue('id', $request_params['item_id']);
        if (empty($item)) {
            return redirect()->route('dashboard')->with('error_message', 'No item data found');
        }
        unset($request_params['item_id']);
        if (!empty($request_params['file'])) {
            $upload_manual = $this->uploadSignPDF($request_params['file'], $this->s3_image_paths['manual_pdf'], 'manual_');
            if ($upload_manual['success'] == true) {
                $request_params['file'] = $upload_manual['file_name'];
            }
        }
        $update_color = $this->getItemManualModel()->where('uuid', $request_params['uuid'])->update($request_params);
        if ($update_color) {
            return redirect()->route('showItem', ['uuid' => $item->uuid])->with('success_message', 'Item manual has been update successfully.');
        }
    }

    /**
     * createVideo method 
     * prepare video link to add
     * @param type $uid
     * @param type $request
     * @return View
     */
    public function createVideo($uid) {
        return View('pages.metadata.addVideo', compact('uid'));
    }

    /**
     * addVideo method 
     * prepare video link to add
     * @param type $uid
     * @param type $request
     * @return View
     */
    public function storeVideoLink($request) {

        $request_params = $request->except('_token');
        $item = $this->getItemModel()->getItemDetailsByColumnValue('uuid', $request_params['item_id']);
        $english_video_link = [];
        $english_video_link['title'] = $request_params['en_title'];
        $english_video_link['video'] = $request_params['en'];
        $english_video_link['type'] = 'en';
        $english_video_link['item_id'] = $item->id;

        $create_english_video_link = $this->getItemVideoModel()->create($english_video_link);
        if ($create_english_video_link) {
            $ar_video_link = [];
            $ar_video_link['title'] = $request_params['ar_title'];
            $ar_video_link['video'] = $request_params['ar'];
            $ar_video_link['type'] = 'ar';
            $ar_video_link['item_id'] = $item->id;
            $create_ar_video_link = $this->getItemVideoModel()->create($ar_video_link);
            if ($create_ar_video_link) {
                return redirect()->route('showItem', ['uid' => $request_params['item_id']])->with('success_message', 'Technical video url information is saved successfully');
            }
        }
    }

    /**
     * editVideo method 
     * prepare video link to update
     * @param type $uid
     * @return View
     */
    public function editVideo($uid) {

        $video = $this->getItemVideoModel()->where('uuid', $uid)->first();
        $item = $this->getItemModel()->where('id', $video->item_id)->first();
        $itemUuid =$item->uuid;

        return View('pages.items.editLink', compact('video','itemUuid'));
    }

    /**
     * updateVideoLink method 
     * update video link data in the database
     * @param type $request
     * @return type
     */
    public function updateVideoLink($request) {

        $request_params = $request->except('_token');

        $item = $this->getItemModel()->getItemDetailsByColumnValue('id', $request_params['item_id']);

        if (empty($item)) {

            return redirect()->route('dashboard')->with('error_message', 'No item data found');
        }
        unset($request_params['item_id']);

        $update_video = $this->getItemVideoModel()->where('uuid', $request_params['uuid'])->update($request_params);

        if ($update_video) {
            return redirect()->route('showItem', ['uuid' => $item->uuid])->with('success_message', 'Item video link has been update successfully.');
        }
    }

}
