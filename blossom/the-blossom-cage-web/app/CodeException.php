<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeException extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'code_exceptions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'exception_file', 'exception_line', 'exception_message', 'exception_url', 'exception_code'];

}
