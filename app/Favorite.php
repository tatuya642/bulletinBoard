<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Favorite extends Model
{
    protected $fillable = [
        'post_id',
        'user_id'
    ];
    //public static function isFavorite($post_id,$user_id){return true;}
    public static function dalele($post_id,$user_id){
        Favorite::where('user_id', $user_id)->where('post_id', $post_id)->delete();
    }
}
