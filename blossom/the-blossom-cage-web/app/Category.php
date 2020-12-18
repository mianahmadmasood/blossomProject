<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['en_title', 'ar_title', 'image', 'parent_id'];
    public $timestamps = true;

    /**
     * get related sub-categories
     */
    public function sub_categories() {
        return $this->hasMany(Category::class, 'parent_id')->where('archive', 0);
    }

}
