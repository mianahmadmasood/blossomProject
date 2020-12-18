<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

trait PathsService {

    public $s3_image_paths = [
        'home_url' => 'http://d4q3rypwox3wu.cloudfront.net/',
        'category_images' => 'categories/',
        'item_images' => 'items/',
        'profile_images' => 'profile-images/',
        'item_color_images' => 'items-colors/',
        'manual_pdf' => 'manuals/',
    ];
    
    public $placeholders = [
        'user_placeholder' => 'http://d3n13c09rx6sh4.cloudfront.net/profile_images/user_placeholder.png',
    ];
    
    public $thumbnails_large = [
        'items' => 'thumbnails/large/items/',
        'categories' => 'thumbnails/large/categories/',
        'profiles' => 'thumbnails/large/profile-images/',
    ];
    public $thumbnails_medium = [
        'items' => 'thumbnails/medium/items/',
        'categories' => 'thumbnails/medium/categories/',
        'profiles' => 'thumbnails/medium/profile-images/',
    ];
    public $thumbnails_small = [
        'items' => 'thumbnails/small/items/',
        'categories' => 'thumbnails/small/categories/',
        'profiles' => 'thumbnails/small/profile-images/',
    ];

}
