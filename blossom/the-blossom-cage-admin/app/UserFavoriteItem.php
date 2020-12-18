<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFavoriteItem extends Model {

    use \BinaryCabin\LaravelUUID\Traits\HasUUID;

    /**
     * Indicate associated table name
     *
     * @var string
     */
    protected $table = 'user_favorite_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'item_id',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Related user
     * 
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Related user
     * 
     */
    public function item() {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    /**
     * getUserFavoriteItemByColumnValue method 
     * @param type $col
     * @param type $val
     * @return type
     */
    public function getUserFavoriteItemByColumnValue($col, $val) {
        return $this->where($col, $val)->with('item.size')->where('archive', 0)->get();
    }

    /**
     * getUserFavoriteItemByColumnValue method 
     * @param type $col
     * @param type $val
     * @return type
     */
    public function getByColumnValue($col, $val, $user_id) {
        return $this->where($col, $val)->where('user_id', $user_id)->where('archive', 0)->first();
    }

    /**
     * getFItemByUser method 
     * @param type $item_id
     * @param type $user_id
     * @return type
     */
    public function getFItemByUser($item_id, $user_id) {
        return $this->where('item_id', $item_id)->where('user_id', $user_id)->where('archive', 0)->first();
    }

}
