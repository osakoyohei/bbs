@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <a href="" class="comment-title"><h1>コメント投稿一覧</h1></a><hr>

            @if ($post === '')
                <p>非表示となった投稿</p>
            @else
                <div class="posts-flex">
                    <div>
                        <p>投稿者：{{ $post->user->name }}</p>
                        <p>投稿日時：{{ $post->created_at->format('Y/m/d/H:i') }}</p>
                        <p>タイトル：{{ $post->title }}</p>
                        <p>投稿内容：<br>
                            {{ $post->content }}
                        </p>
                        <p>カテゴリー名：{{ $post->category->name }}</p>
                    </div>
                    <div class="comment-thumbnail-image">
                        <img src="data:image/png;base64,{{ $post->thumbnail_image }}">
                    </div>
                </div>
                <hr>

                @if ($post->id != Auth::id())
                <form action="{{ route('comment.store') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="comment">コメント</label>
                        <textarea id="comment" name="comment_store" class="form-control"  prows="4">{{ old('comment') }}</textarea>
                    @if ($errors->has('comment_store'))
                            <div class="text-danger">
                                {{ $errors->first('comment_store') }}
                            </div>
                        @endif
                    </div>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <a class="btn btn-secondary" href="{{ route('comment', $post->id) }}">キャンセル</a>
                    <button type="submit" class="btn btn-primary">コメントする</button>
                </form>
                <hr>
                @endif
            
                @foreach($comments as $comment)
                    @if ($comment->private === 0)
                        <p>投稿者：{{ $comment->user->name }}</p>
                        <p>投稿日時：{{ $comment->created_at->format('Y/m/d/H:i') }}</p>
                        <p>コメント：{{ $comment->comment }}</p>
                        <a href="{{ route('reply', $comment->id) }}" class="badge badge-primary">返信:{{ $comment->replies->count() }}件</a>
                        <hr>
                    @else
                        <p>非表示となった投稿</p>
                        <a href="{{ route('reply', $comment->id) }}" class="badge badge-primary">返信:{{ $comment->replies->count() }}件</a>
                        <hr>
                    @endif
                @endforeach
            @endif

        </div>
    </div>
</div>
@endsection