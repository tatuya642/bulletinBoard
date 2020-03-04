<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        
        if(Auth::check()){
            $params = $request->validate([
                'post_id' => 'required|exists:posts,id',
                'body' => 'required|max:2000',
                'user_id' => 'required',
            ]);
        }else{
            $params = $request->validate([
                'post_id' => 'required|exists:posts,id',
                'body' => 'required|max:2000',
            ]);
        }

        $post = Post::findOrFail($params['post_id']);
        $post->comments()->create($params);

        return redirect()->route('posts.show', ['post' => $post]);
    }
}
