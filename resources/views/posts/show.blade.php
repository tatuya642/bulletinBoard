@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="border p-4">
            
            <h1 class="h5 mb-4">
                {{ $post->title }}
            </h1>
            <p class="mb-5">
                {!! nl2br(e($post->body)) !!}
            </p>
            @if( $post->image_path != null)
            <p class="">
                <img src="{{ asset('storage/'.$post->image_path) }}" style="max-width:25%; max-height:30%" />
            </p>
            @endif
            <div class="mb-4 ">
                <a href="/" class="btn btn-outline-primary">お気に入りに追加</a>
                @if($post->user_id == Auth::id())
                    <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">
                        編集する
                    </a>
                
                    <form
                        style="display: inline-block;"
                        method="POST"
                        action="{{ route('posts.destroy', ['post' => $post]) }}"
                    >
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger">削除する</button>
                    </form>
                </dic>
                @endif
            </div>
            
            <section>
                <h2 class="h5 mb-4">
                    コメント
                </h2>
                <form class="mb-4" method="POST" action="{{ route('comments.store') }}">
                    @csrf

                    <input
                        name="post_id"
                        type="hidden"
                        value="{{ $post->id }}"
                    >

                    <div class="form-group">
                        <input id="user_id" name="user_id" value="{{Auth::id()}}" style="display:none"></input>
                        <label for="body">
                            本文
                        </label>

                        <textarea
                            id="body"
                            name="body"
                            class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                            rows="4"
                        >{{ old('body') }}</textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                {{ $errors->first('body') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            コメントする
                        </button>
                    </div>
                </form>
                @forelse($post->comments as $comment)
                    <div class="border-top p-4">
                        <time class="text-secondary">
                            @if($comment->user_id !== null)
                                {{$comment->user_name($comment->user_id) }}
                            @else
                                ゲストさん
                            @endif
                            {{ $comment->created_at->format('Y.m.d H:i') }}
                        </time>
                        <p class="mt-2">
                            {!! nl2br(e($comment->body)) !!}
                        </p>
                    </div>
                @empty
                    <p>コメントはまだありません。</p>
                @endforelse
            </section>
        </div>
    </div>
@endsection