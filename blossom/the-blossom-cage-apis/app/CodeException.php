<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeException extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
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

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

}
