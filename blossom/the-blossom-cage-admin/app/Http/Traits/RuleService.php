<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;

trait RuleService {

    /**
     * Place order related rules 
     * @var type 
     */
    public $add_manual_rules = [
        'en_title' => 'required',
        'ar_title' => 'required',
        'en_file' => 'required|mimes:pdf|max:10000',
        'ar_file' => 'required|mimes:pdf|max:10000',
    ];

    /**
     * Place order related rules 
     * @var type 
     */
    public $add_video_rules = [
        'en_title' => 'required',
        'ar_title' => 'required',
        'en' => 'required|url',
        'ar' => 'required|url',
    ];

    /**
     * Place update_item_image_rules 
     * @var type 
     */
    public $update_item_image_rules = [
        'image' => 'required'
    ];

    /**
     * Place update_item_image_rules 
     * @var type 
     */
    public $login = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    /**
     * Place profile_update_rules 
     * @var type 
     */
    public $profile_update_rules = [
        'first_name' => 'required',
        'last_name' => 'required'
    ];

    /**
     * Place profile_update_rules 
     * @var type 
     */
    public $password_update_rules = [
        'new_password' => 'required|min:8',
        'old_password' => 'required',
        'confirm_password' => 'required|same:new_password'
    ];

    /**
     * Place profile_update_rules 
     * @var type 
     */
    public $sepc_update_rules = [
        'specifications' => 'required',
    ];

}
