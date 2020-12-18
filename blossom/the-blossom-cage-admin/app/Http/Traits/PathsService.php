<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

trait PathsService {

    public $s3_image_paths = [
        'home_url' => 'http://d302hkcnkn8pd2.cloudfront.net/',
        'category_images' => 'categories/',
        'item_images' => 'items/',
        'brand_images' => 'brands/',
        'banner_images' => 'banners/',
        'accessorie_images' => 'accessories/',
        'warehouse_images' => 'warehouses/',
        'item_color_images' => 'items-colors/',
        'manual_pdf' => 'manuals/',
        'profile_images' => 'profile-images/',
    ];
    public $placeholders = [
        'user_placeholder' => 'http://d3n13c09rx6sh4.cloudfront.net/profile_images/user_placeholder.png',
    ];
    public $thumbnails_extra_large = [
        'items' => 'thumbnails/xlarge/items/',
        'categories' => 'thumbnails/xlarge/categories/',
        'profiles' => 'thumbnails/xlarge/profile-images/',
        'brands' => 'thumbnails/xlarge/brands/',
        'banners' => 'thumbnails/xlarge/banners/',
        'accessories' => 'thumbnails/xlarge/accessories/',
        'warehouses' => 'thumbnails/xlarge/warehouses/',
        'item_color_images' => 'thumbnails/xlarge/items-colors/',
    ];

    public $thumbnails_large = [
        'items' => 'thumbnails/large/items/',
        'categories' => 'thumbnails/large/categories/',
        'profiles' => 'thumbnails/large/profile-images/',
        'brands' => 'thumbnails/large/brands/',
        'banners' => 'thumbnails/large/banners/',
        'accessories' => 'thumbnails/large/accessories/',
        'warehouses' => 'thumbnails/large/warehouses/',
        'item_color_images' => 'thumbnails/large/items-colors/',
    ];

    public $thumbnails_medium = [
        'items' => 'thumbnails/medium/items/',
        'categories' => 'thumbnails/medium/categories/',
        'profiles' => 'thumbnails/medium/profile-images/',
        'brands' => 'thumbnails/medium/brands/',
        'banners' => 'thumbnails/medium/banners/',
        'accessories' => 'thumbnails/medium/accessories/',
        'warehouses' => 'thumbnails/medium/warehouses/',
        'item_color_images' => 'thumbnails/medium/items-colors/',
    ];
    public $thumbnails_small = [
        'items' => 'thumbnails/small/items/',
        'categories' => 'thumbnails/small/categories/',
        'profiles' => 'thumbnails/small/profile-images/',
        'brands' => 'thumbnails/small/brands/',
        'banners' => 'thumbnails/small/banners/',
        'accessories' => 'thumbnails/small/accessories/',
        'warehouses' => 'thumbnails/small/warehouses/',
        'item_color_images' => 'thumbnails/small/items-colors/',
    ];
    public $thumbnails_mobile = [
        'banners' => 'thumbnails/mobile/banners/',
    ];

}
