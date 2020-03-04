<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'user_id',
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
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
                return \App\User::find($id)->name . "さん";
            }
        }
    }
    
}