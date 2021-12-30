@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <h1>掲示板投稿</h1>

            <form action="{{ route('store') }}" method="POST" enctype='multipart/form-data'>
            @csrf
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <div class="text-danger">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="thumbnail_image">サムネイル画像</label><br>
                    <input type="file" id="thumbnail_image" name="thumbnail_image">
                    @if ($errors->has('image'))
                        <div class="text-danger">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="content">投稿内容</label>
                    <textarea id="content" name="content" class="form-control" rows="4">{{ old('content') }}</textarea>
                    @if ($errors->has('content'))
                        <div class="text-danger">
                            {{ $errors->first('content') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="category">カテゴリー</label><br>
                    <select name="category">
                        <option value="">カテゴリーを選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                        <div class="text-danger">
                            {{ $errors->first('category') }}
                        </div>
                    @endif
                </div>

                <div class="mt-5">
                    <a class="btn btn-secondary" href="{{ route('create') }}">キャンセル</a>
                    <button type="submit" class="btn btn-primary">投稿する</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection