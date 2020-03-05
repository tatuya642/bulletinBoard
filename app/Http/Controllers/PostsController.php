<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Favorite;
use Auth;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);

        return view('posts.index', ['posts' => $posts]);
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        if(Auth::check()){
        $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
            'user_id' => 'required',
            'imagefile' => [
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
        ]);
        }else{
            $params = $request->validate([
                'title' => 'required|max:50',
                'body' => 'required|max:2000',
                'imagefile' => [
                    // アップロードされたファイルであること
                    'file',
                    // 画像ファイルであること
                    'image',
                    // MIMEタイプを指定
                    'mimes:jpeg,png',
                ]
            ]);
        }
        
        $post=Post::create($params);

        if( isset( $params['imagefile'] ) ) {
            $dir = $post->id;
            $file =  $request->file('imagefile');
            $fileName = $file->getClientOriginalName();
            $request->file('imagefile')->storeAS('post/'.$dir,$fileName);
              
            $post->image_path = 'post/'.$dir.'/'.$fileName;
            $post->save();
        }
        
        return redirect()->route('top');
    }

    public function show($post_id)
    {
        $post = Post::findOrFail($post_id);
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function setFavorite(int $post_id)
    {
        $post = Post::findOrFail($post_id);
        $user_id = Auth::id();
        $favorite = Favorite::create(['post_id'=>$post_id,'user_id'=>Auth::id()]);
        return redirect()->route('posts.show', ['post' => $post]);
    }
    public function removeFavorite(int $post_id)
    {
        $post = Post::findOrFail($post_id);
        $user_id = Auth::id();
        $favorite_count = Favorite::where('user_id', $user_id)->where('post_id', $post_id);
        \DB::transaction(function () use ($favorite_count) {
            $favorite_count->delete();
        });
        return redirect()->route('posts.show', ['post' => $post]);
    }
    public function viewFavorite()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        //dump("test");
        return view('posts.index_favorite', ['posts' => $posts]);
    }
    
  
    public function edit($post_id)
    {
        $post = Post::findOrFail($post_id);
        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    public function update($post_id, Request $request)
    {
        $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
            'imagefile' => [
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
        ]);
        $post = Post::findOrFail($post_id);
        
        if( isset( $params['imagefile'] ) ) {
            $this->delete_image($post->image_path);
            $dir = $post->id;
            $file =  $request->file('imagefile');
            $fileName = $file->getClientOriginalName();
            $request->file('imagefile')->storeAS('post/'.$dir,$fileName);
            $post->image_path = 'post/'.$dir.'/'.$fileName;
        }
        $post->fill($params)->save();
        return redirect()->route('posts.show', ['post' => $post]);
    }

    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);
        \DB::transaction(function () use ($post) {
            $this->delete_image($post->image_path);
            $post->comments()->delete();
            $post->delete();
        });
        return redirect()->route('top');
    }

    public function delete_image($image){
        //imageの例. post/{{$post->id}}/[image name]
        $image_path = 'storage/app/public/'.$image;
        if(file_exists ($image_path)){
            unlink($image_path);
        }
    }


}