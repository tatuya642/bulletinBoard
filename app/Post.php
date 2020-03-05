<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;


class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'image_path',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function user_name($id)
    {
        $user = \App\User::where('id','=', $id)->first();
        if(empty($user)){
            return "退会したユーザー";
        }else{
            if(Auth::id()==$id){
                return "自分";
            }else{
                return \App\User::find($id)->name. "さん";
            }
        }
    }
    public function isFavorite()
    {
        $favorite_count = \App\Favorite::where('user_id', Auth::id())->where('post_id', $this->id)->count();
        //dump($favorite_count);
        if($favorite_count==0){
            //お気に入りじゃない
            return false;
        }else{
            //お気に入り
            return true;
        }
    }
    
}
