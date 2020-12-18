<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

use Image;

trait UploadsService {

    use PathsService;

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

        if ($pre_fix == 'Profile_') {

            $make_thumbnail_images = $this->uploadProfileThumbnail($file, $full_name);
        }

        if ($upload && $make_thumbnail_images) {
            return array('success' => true, 'file_name' => $full_name, 'extension' => $extension);
        }

        return ['success' => false, 'file_name' => ''];
    }

    /**
     * uploadCategoryThumbnail method
     * uploads category thumbnails
     * @param type $image
     * @param type $uploaded_image_name
     * @return boolean
     */
    public function uploadProfileThumbnail($image, $uploaded_image_name) {

        $large_image_sourece = Image::make($image)->resize(324, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
        $medium_image_sourece = Image::make($image)->resize(178, 178, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

        $small_image_sourece = Image::make($image)->resize(86, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();


        $upload_large = \Storage::disk('s3')->put($this->thumbnails_large['profiles'] . $uploaded_image_name, $large_image_sourece->getEncoded());
        $upload_medium = \Storage::disk('s3')->put($this->thumbnails_medium['profiles'] . $uploaded_image_name, $medium_image_sourece->getEncoded());
        $upload_small = \Storage::disk('s3')->put($this->thumbnails_small['profiles'] . $uploaded_image_name, $small_image_sourece->getEncoded());

        if ($upload_large && $upload_medium && $upload_small) {
            return true;
        }
        return false;
    }

}
