<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

trait PathsService {

    public $s3_image_paths = [
        'home_url' => 'http://d2hwjczw5yaulx.cloudfront.net/',
        'category_images' => 'categories/',
        'item_images' => 'items/',
        'brand_images' => 'brands/',
        'warehouse_images' => 'warehouses/',
        'profile_images' => 'profile-images/',
        'item_color_images' => 'items-colors/',
        'manual_pdf' => 'manuals/',
    ];
    public $placeholders = [
        'user_placeholder' => 'http://d3n13c09rx6sh4.cloudfront.net/profile_images/user_placeholder.png',
    ];

}
