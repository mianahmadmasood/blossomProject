<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Responses;

/**
 * Description of BaseResponse
 *
 * @author qadeer
 */
class BaseResponse {

    use \App\Http\Traits\CommonService;
    use \App\Http\Traits\PathsService;
    use \App\Http\Traits\MessagesService;
}
