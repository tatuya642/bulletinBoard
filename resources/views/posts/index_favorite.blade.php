@extends('layout')

@section('content')
    <div class="container mb-4">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            投稿を新規作成する
        </a>
        <a href="{{ url('') }}" class="btn btn-primary">
            すべて表示
        </a>
    </div>
    <div class="container mt-4">
        @if($posts->count()==0)
            お気に入りの投稿はありませんでした。 
        
        @endif

        @if(Auth::id()!=null)        
            @foreach ($posts as $post)
                @if( $post->isFavorite() )
                    <div class="card mb-4">
                        <div class="card-header">
                            {{ $post->title }}
                            <div class="float-right">
                                <img src="{{ asset('storage/common/favorite.png') }}" style="height:30px;" />
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="height:2.5em;overflow:hidden">
                                {!! nl2br(e($post->body)) !!}
                            </p>
                            <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">続きを読む</a>
                        </div>
                        <div class="card-footer">
                            <span class="mr-2">
                                @if($post->user_id !== null)
                                    {{$post->user_name($post->user_id) }}
                                @else
                                    ゲストさん
                                @endif
                                投稿日時 {{ $post->created_at->format('Y.m.d') }}
                            </span>

                            @if ($post->comments->count())
                                <span class="badge badge-primary">
                                    コメント {{ $post->comments->count() }}件
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        <div class="d-flex justify-content-center mb-5">
            {{ $posts->links() }}
        </div>
    </div>
@endsection