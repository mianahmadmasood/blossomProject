<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

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
    public function uploadSingleImage($file, $s3_destination, $pre_fix) {

        $extension = '';
        $filename = $file->getClientOriginalName();


        $filename = pathinfo($filename, PATHINFO_FILENAME);
        list($width, $height) = getimagesize($file);
        $full_name = $pre_fix . uniqid() . time() . '.' . 'jpg';

        $s3destination = $s3_destination;
        $upload = $file->storeAs($s3destination, $full_name, 's3');


        if ($upload) {
            if ($pre_fix == 'item_') {
                $make_thumbnail_images = $this->makeThumbnailsUploads($file, $full_name);
            }
            if ($pre_fix == 'Category_') {
                $make_thumbnail_images = $this->uploadCategoryThumbnail($file, $full_name);
            }
            if ($pre_fix == 'profile_') {

                $make_thumbnail_images = $this->uploadProfileThumbnail($file, $full_name);
            }
            if ($pre_fix == 'brand_') {

                $make_thumbnail_images = $this->uploadBrandThumbnail($file, $full_name);
            }if ($pre_fix == 'accessorie_') {

                $make_thumbnail_images = $this->uploadAccessorieThumbnail($file, $full_name);
            }if ($pre_fix == 'warehouse_') {

                $make_thumbnail_images = $this->uploadWarehouseThumbnail($file, $full_name);
            }if ($pre_fix == 'itemcolor_') {

                $make_thumbnail_images = $this->uploaditemColorThumbnail($file, $full_name);
            }if ($pre_fix == 'banner_') {

                $make_thumbnail_images = $this->uploadBannerThumbnail($file, $full_name);
            }

            return array('success' => true, 'file_name' => $full_name, 'extension' => $extension);
        }

        return ['success' => false, 'file_name' => ''];
    }

    /**
     * processThumbnailUpload method 
     * process the upload process
     * @param type $file
     * @param type $full_name
     * @param type $pre_fix
     * @return type
     */
    protected function processThumbnailUpload($file, $full_name, $pre_fix) {

        if ($pre_fix == 'item_') {

            $make_thumbnail_images = $this->makeThumbnailsUploads($file, $full_name);
        }
        if ($pre_fix == 'category_') {

            $make_thumbnail_images = $this->uploadCategoryThumbnail($file, $full_name);
        }
        if ($pre_fix == 'profile_') {

            $make_thumbnail_images = $this->uploadProfileThumbnail($file, $full_name);
        }

        if ($make_thumbnail_images) {

            return array('success' => true, 'file_name' => $full_name);
        }
        return ['success' => false, 'file_name' => ''];
    }

    /**
     * uploadSignPDF method upload a pdf file
     * @param type $file
     * @param type $s3_destination
     * @param type $pre_fix
     * @param type $server
     * @return type
     */
    public function uploadSignPDF($file, $s3_destination, $pre_fix, $server = 's3') {


        $full_name = $pre_fix . uniqid() . time() . '.' . 'pdf';


        $upload = $file->storeAs($s3_destination, $full_name, $server);

        if ($upload) {
            return array('success' => true, 'file_name' => $full_name);
        }

        return ['success' => false, 'file_name' => ''];
    }

    /**
     * makeThumbnailsUploads method uploads item thumbnails
     * @param type $image
     * @param type $uploaded_image_name
     * @return boolean
     */
    public function makeThumbnailsUploads($image, $uploaded_image_name) {



        $extra_large_image_sourece = Image::make($image)->fit(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

        $large_image_sourece = Image::make($image)->fit(850, 850, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode();
        $medium_image_sourece = Image::make($image)->fit(550, 550, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

        $small_image_sourece = Image::make($image)->resize(257, 257, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

        $upload_extra_large = \Storage::disk('s3')->put($this->thumbnails_extra_large['items'] . $uploaded_image_name, $extra_large_image_sourece->getEncoded());
        $upload_large = \Storage::disk('s3')->put($this->thumbnails_large['items'] . $uploaded_image_name, $large_image_sourece->getEncoded());
        $upload_medium = \Storage::disk('s3')->put($this->thumbnails_medium['items'] . $uploaded_image_name, $medium_image_sourece->getEncoded());
        $upload_small = \Storage::disk('s3')->put($this->thumbnails_small['items'] . $uploaded_image_name, $small_image_sourece->getEncoded());

        if ($upload_extra_large && $upload_large && $upload_medium && $upload_small) {
            return true;
        }

        return false;
    }


    public function uploaditemColorThumbnail($image, $uploaded_image_name) {

       
       
       
        $extra_large_image_sourece = Image::make($image)->resize(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
        $large_image_sourece = Image::make($image)->resize(850, 850, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode();
                
        $medium_image_sourece = Image::make($image)->resize(550, 550, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

        $small_image_sourece = Image::make($image)->resize(257, 257, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

        $upload_extra_large = \Storage::disk('s3')->put($this->thumbnails_extra_large['item_color_images'] . $uploaded_image_name, $extra_large_image_sourece->getEncoded());
        $upload_large = \Storage::disk('s3')->put($this->thumbnails_large['item_color_images'] . $uploaded_image_name, $large_image_sourece->getEncoded());
        $upload_medium = \Storage::disk('s3')->put($this->thumbnails_medium['item_color_images'] . $uploaded_image_name, $medium_image_sourece->getEncoded());
        $upload_small = \Storage::disk('s3')->put($this->thumbnails_small['item_color_images'] . $uploaded_image_name, $small_image_sourece->getEncoded());

        if ($upload_extra_large && $upload_large) {
            return true;
        }
        return false;
    }

    /**
     * uploadCategoryThumbnail method
     * uploads category thumbnails
     * @param type $image
     * @param type $uploaded_image_name
     * @return boolean
     */
    public function uploadCategoryThumbnail($image, $uploaded_image_name) {

        $extra_large_image_sourece = Image::make($image)->fit(1200, 1200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode();
        $large_image_sourece = Image::make($image)->fit(850, 850, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
        $medium_image_sourece = Image::make($image)->fit(550, 550, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

        $small_image_sourece = Image::make($image)->fit(257, 257, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
                
        $upload_extra_large = \Storage::disk('s3')->put($this->thumbnails_extra_large['categories'] . $uploaded_image_name, $extra_large_image_sourece->getEncoded());
        $upload_large = \Storage::disk('s3')->put($this->thumbnails_large['categories'] . $uploaded_image_name, $large_image_sourece->getEncoded());
        $upload_medium = \Storage::disk('s3')->put($this->thumbnails_medium['categories'] . $uploaded_image_name, $medium_image_sourece->getEncoded());
        $upload_small = \Storage::disk('s3')->put($this->thumbnails_small['categories'] . $uploaded_image_name, $small_image_sourece->getEncoded());

        if ($upload_large) {
            return true;
        }
        return false;
    }

    /**
     * uploadCategoryThumbnail method
     * uploads category thumbnails
     * @param type $image
     * @param type $uploaded_image_name
     * @return boolean
     */
    public function uploadProfileThumbnail($image, $uploaded_image_name) {

        $large_image_sourece = Image::make($image)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
        $medium_image_sourece = Image::make($image)->resize(178, null, function ($constraint) {
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

        if ($upload_large) {
            return true;
        }
        return false;
    }
    /**
     * uploadCategoryThumbnail method
     * uploads category thumbnails
     * @param type $image
     * @param type $uploaded_image_name
     * @return boolean
     */
    public function uploadBrandThumbnail($image, $uploaded_image_name) {

        $extra_large_image_sourece = Image::make($image)->resize(1200, 1200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode();

        $large_image_sourece = Image::make($image)->resize(850, 850, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
        $medium_image_sourece = Image::make($image)->resize(550, 550, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

        $small_image_sourece = Image::make($image)->resize(257, 257, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

        $upload_large = \Storage::disk('s3')->put($this->thumbnails_extra_large['brands'] . $uploaded_image_name, $extra_large_image_sourece->getEncoded());
        $upload_large = \Storage::disk('s3')->put($this->thumbnails_large['brands'] . $uploaded_image_name, $large_image_sourece->getEncoded());
        $upload_medium = \Storage::disk('s3')->put($this->thumbnails_medium['brands'] . $uploaded_image_name, $medium_image_sourece->getEncoded());
        $upload_small = \Storage::disk('s3')->put($this->thumbnails_small['brands'] . $uploaded_image_name, $small_image_sourece->getEncoded());

        if ($upload_large) {
            return true;
        }
        return false;
    }  /**
     * uploadCategoryThumbnail method
     * uploads category thumbnails
     * @param type $image
     * @param type $uploaded_image_name
     * @return boolean
     */
    public function uploadAccessorieThumbnail($image, $uploaded_image_name) {

        $extra_large_image_sourece = Image::make($image)->resize(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
        $large_image_sourece = Image::make($image)->resize(850, 850, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode();
        $medium_image_sourece = Image::make($image)->resize(550, 550, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

        $small_image_sourece = Image::make($image)->resize(257, 257, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
                
        $upload_extra_large = \Storage::disk('s3')->put($this->thumbnails_extra_large['accessories'] . $uploaded_image_name, $extra_large_image_sourece->getEncoded());
        $upload_large = \Storage::disk('s3')->put($this->thumbnails_large['accessories'] . $uploaded_image_name, $large_image_sourece->getEncoded());
        $upload_medium = \Storage::disk('s3')->put($this->thumbnails_medium['accessories'] . $uploaded_image_name, $medium_image_sourece->getEncoded());
        $upload_small = \Storage::disk('s3')->put($this->thumbnails_small['accessories'] . $uploaded_image_name, $small_image_sourece->getEncoded());

        if ($upload_large) {
            return true;
        }
        return false;
    }
    /**
     * uploadCategoryThumbnail method
     * uploads category thumbnails
     * @param type $image
     * @param type $uploaded_image_name
     * @return boolean
     */
    public function uploadWarehouseThumbnail($image, $uploaded_image_name) {

        $large_image_sourece = Image::make($image)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
        $medium_image_sourece = Image::make($image)->resize(178, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

        $small_image_sourece = Image::make($image)->resize(86, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();


        $upload_large = \Storage::disk('s3')->put($this->thumbnails_large['warehouses'] . $uploaded_image_name, $large_image_sourece->getEncoded());
        $upload_medium = \Storage::disk('s3')->put($this->thumbnails_medium['warehouses'] . $uploaded_image_name, $medium_image_sourece->getEncoded());
        $upload_small = \Storage::disk('s3')->put($this->thumbnails_small['warehouses'] . $uploaded_image_name, $small_image_sourece->getEncoded());

        if ($upload_large) {
            return true;
        }
        return false;
    }
    

    public function uploadBannerThumbnail($image, $uploaded_image_name) {


        $large_image_sourece = Image::make($image)->resize(1440, 575, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
        $medium_image_sourece = Image::make($image)->resize(800, 319, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

        $small_image_sourece = Image::make($image)->resize(400 , 160, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
        $mobile_image_sourece = Image::make($image)->resize(1293 , 565, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();


        $upload_large = \Storage::disk('s3')->put($this->thumbnails_large['banners'] . $uploaded_image_name, $large_image_sourece->getEncoded());

        $upload_medium = \Storage::disk('s3')->put($this->thumbnails_medium['banners'] . $uploaded_image_name, $medium_image_sourece->getEncoded());
        $upload_small = \Storage::disk('s3')->put($this->thumbnails_small['banners'] . $uploaded_image_name, $small_image_sourece->getEncoded());
        $upload_mobile = \Storage::disk('s3')->put($this->thumbnails_mobile['banners'] . $uploaded_image_name, $mobile_image_sourece->getEncoded());

        if ($upload_large) {
            return true;
        }
        return false;
    }

    public function fileUpload($file, $destination, $x, $y, $width, $height, $uploadS3 = false, $base64 = false) {
        //file name
        if ($base64) {
            // file is not base64 encoded
            return self::moveEncodedImage($file, $destination, $uploadS3);
        } else {
            $filename = $file->getClientOriginalName();
            $filename = pathinfo($filename, PATHINFO_FILENAME);
            $fullname = Str::slug(Str::random(8) . $filename . time()) . '.jpg';

            list($w1, $h1) = getimagesize($file->getPathName());
            $dimesions = self::checkDimensions($w1, $h1);
            if (!$dimesions) {
                return self::error_response('Please upload an image of dimensions ' . config('sizes.tiles_w') . ' * ' . config('sizes.tiles_w'));
            }
            $file_path = public_path($destination . $fullname);
            $x = floor($x);
            $y = floor($y);
            $width = floor($width);
            $height = floor($height);

            $img = Image::make($file);
            $img->crop($width, $height, $x, $y);

            $upload = $img->fit($width, $height, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->orientate()
                    ->save($file_path, 80);

            if ($uploadS3) {
                clearstatcache();
                $res = $this->S3Upload($file_path, config('paths.s3_items_img_path_slug') . $fullname);
                unlink($file_path);
                return $this->jsonSuccessResponseWithoutData('Image uploaded successfully!', $fullname);
            } else if ($upload) {
                return $this->jsonSuccessResponseWithoutData('Image uploaded successfully!', $fullname);
            }
        }
    }

    public function S3Upload($source, $destination) {

        $s3 = new S3(config('paths.s3_access_key'), config('paths.s3_secret_key'));
        return $s3->putObjectFile($source, config('paths.s3_bucket'), $destination, S3::ACL_PUBLIC_READ);
    }

}
