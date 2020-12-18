<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

trait UploadsService {

    /**
     * uploadSingleImage method
     * @param type $file
     * @param type $s3_destination
     * @param type $pre_fix
     * @param type $server
     * @return type
     */
    public function uploadSingleImage($file, $s3_destination, $pre_fix, $server = 's3') {

        $extension = '';

        $filename = $file->getClientOriginalName();

        $filename = pathinfo($filename, PATHINFO_FILENAME);

        list($width, $height) = getimagesize($file);

        $full_name = $pre_fix . uniqid() . time() . '.' . 'jpg';

        $s3destination = $s3_destination;

        $upload = $file->storeAs($s3destination, $full_name, $server);

        if ($upload) {
            return array('success' => true, 'file_name' => $full_name, 'extension' => $extension);
        }

        return ['success' => false, 'file_name' => ''];
    }

}
