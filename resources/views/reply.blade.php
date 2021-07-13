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

            <h1>コメント返信</h1>
            <a href="/bbs/comment/{{ $comment->post_id }}">戻る</a>
            <hr>

            <p>投稿者：{{ $comment->user->name }}</p>
            <p>投稿日時：{{ $comment->created_at->format('Y/m/d/H:i') }}</p>
            <p>投稿内容：{{ $comment->comment }}</p>
            <hr>

            <div class="card card-body">
                <form action="{{ route('comment.reply') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <textarea id="comment" name="reply" class="form-control"  prows="4">{{ old('reply') }}</textarea>
                        @if ($errors->has('reply'))
                            <div class="text-danger">
                                {{ $errors->first('reply') }}
                            </div>
                        @endif
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    <a class="btn btn-secondary" href="/bbs/comment/reply/{{ $comment->id }}">キャンセル</a>
                    <button type="submit" class="btn btn-primary">返信する</button>
                </form>
            </div>
            <br>

            @foreach($replies as $reply)
                <p>投稿者：{{ $reply->user->name }}</p>
                <p>投稿日時：{{ $reply->created_at->format('Y/m/d/H:i') }}</p>
                <p>コメント：{{ $reply->reply }}</p>
                <hr>
            @endforeach


            
        </div>
    </div>
</div>
@endsection