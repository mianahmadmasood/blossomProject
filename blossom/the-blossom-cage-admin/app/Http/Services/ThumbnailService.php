<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of ThumbnailService
 *
 * @author qadeer
 */
use App\Http\Services\Config;
use Intervention\Image\Facades\Image;
use Aws\S3\S3Client;

class ThumbnailService extends Config {

    public function productThumbnailGateway() {
        $config = array(
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' => array(
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
                'Version' => '2010-12-17',
            )
        );
        $s3Clinet = new S3Client($config);
        $s3_folder = $this->s3_image_paths['item_images'];
        $images = $this->getItemImageModel()->get();
        foreach ($images as $image) {
            $this->getS3Object($s3Clinet, $image->image, $s3_folder);
            $tmp_fil_name = explode('.', $image->image);
            $new_file_name = $tmp_fil_name[0] . '.jpg';
            $this->makeImageThumbnail($new_file_name);
            $this->uploadFile($new_file_name);
        }
    }

    /**
     * 
     * @param type $s3Clinet
     * @param type $filename
     * @param type $s3_folder
     */
    protected function getS3Object($s3Clinet, $filename, $s3_folder) {
        $Bucket = env('AWS_BUCKET');
        $s3_path = $s3_folder . $filename;
        $tmp_fil_name = explode('.', $filename);
        $new_file_name = $tmp_fil_name[0] . '.jpg';
        $s3Clinet->getObject(array('Bucket' => $Bucket, 'Key' => $s3_path, 'SaveAs' => public_path() . '/temp/' . $new_file_name));
    }

    /**
     * 
     * @param type $type
     * @param type $filename
     */
    protected function makeImageThumbnail($filename) {
        $target_path = public_path('temp/' . $filename);
        $image = Image::make($target_path);
        $dst = 'items/';
        $image->fit(500, 500, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(public_path('thumbnails/large/' . $dst . $filename));
        $image->fit(257, 257, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(public_path('thumbnails/medium/' . $dst . $filename));
        $image->fit(86, 86, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(public_path('thumbnails/small/' . $dst . $filename));
    }

    /**
     * 
     * @param type $filename
     */
    protected function uploadFile($filename) {
        $small_file_path = public_path('thumbnails/small/items/' . $filename);
        $medium_file_path = public_path('thumbnails/medium/items/' . $filename);
        $large_file_path = public_path('thumbnails/large/items/' . $filename);
        $s3destination_small = 'thumbnails/small/items/';
        $s3destination_medium = 'thumbnails/medium/items/';
        $s3destination_large = 'thumbnails/large/items/';
        $this->uploadSingleImageToS3($small_file_path, $s3destination_small, $filename);
        $this->uploadSingleImageToS3($medium_file_path, $s3destination_medium, $filename);
        $this->uploadSingleImageToS3($large_file_path, $s3destination_large, $filename);
//        unlink($small_file_path);
//        unlink($medium_file_path);
//        unlink($large_file_path);
    }

    /**
     * 
     * @param type $localpath
     * @param type $s3destination
     * @param type $filename
     * @return type
     */
    protected function uploadSingleImageToS3($localpath, $s3destination, $filename) {
        $file_content = file_get_contents($localpath);
        return \Storage::disk('s3')->put($s3destination . $filename, $file_content);
    }

}
