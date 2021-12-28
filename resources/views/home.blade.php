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

            <h3><a href="{{ route('create') }}">掲示板投稿をする</a></h3><br>

            <h1>掲示板投稿一覧</h1>
            <hr>

            <!-- 掲示板タイトルで検索 -->
            <form action="{{ route('title.search') }}" method="GET">
            @csrf
                <div class="form-row align-items-center">
                    <div class="col-sm-4 my-1">
                        <label class="sr-only" for="inlineFormInputName">タイトルを入力してください</label>
                        <input type="text" class="form-control" id="inlineFormInputName" placeholder="タイトルを入力してください" name="title_search">
                    </div>
                    <div class="col-auto my-1">
                        <button type="submit" class="btn btn-primary">タイトルで検索</button>
                    </div>
                </div>
            </form>
            <hr>
            
            <!-- カテゴリーで検索 -->
            <form class="form-inline" action="{{ route('category.search') }}" method="GET">
            @csrf
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="category_search">
                    <option selected>カテゴリーを選択してください</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary my-1">カテゴリーで検索</button>
            </form>
            <hr>

            @isset($serach_result)
                <h5>{{ $serach_result }}</h5><br>
            @endisset

            <!-- 掲示板一覧 -->
            @foreach($posts as $post)
                <p>投稿者：{{ $post->user->name }}</p>
                <p>投稿日時：{{ $post->created_at->format('Y/m/d/H:i') }}</p>
                <p>タイトル：{{ $post->title }}</p>
                <img src="data:image/png;base64,{{ $post->thumbnail_image }}">
                <p>投稿内容：{{ $post->content }}</p>
                <p>カテゴリー名：{{ $post->category->name }}</p>
                <p><a href="{{ route('comment', $post->id) }}" class="btn btn-primary">コメント投稿</a></p>
                
                @if ($post->user_id === Auth::id())
                    <form method="POST" action="{{ route('delete', $post->id) }}" >
                    @csrf
                        <button type="submit">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                @endif
                <hr>
            @endforeach

        </div>
    </div>
</div>
@endsection
