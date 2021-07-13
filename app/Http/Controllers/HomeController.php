<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ReplyRequest;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Reply;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        $posts->load('category', 'user');
        $categories = Category::all();

        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('create', [
            'categories' => $categories,
        ]);
    }

    public function comment($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', $post->id)->get();
        $comments->load('user', 'comments', 'replies');

        if (is_null($post)) {
            return redirect(route('home'))->with('status', 'データがありません');
        }

        return view('comment', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function commentStore(CommentRequest $request)
    {
        \DB::beginTransaction();
        try {
            Comment::create([
                'user_id' => $request->user_id,
                'post_id' => $request->post_id,
                'comment' => $request->comment_store,
            ]);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        return redirect('/bbs/comment/'.$request->post_id)->with('status', 'コメントを投稿しました');
    }

    public function showReply($id)
    {
        $comment = Comment::find($id);
        $replies = Reply::where('comment_id', $comment->id)->get();
        $replies->load('user');

        if (is_null($comment)) {
            return redirect(route('home'))->with('status', 'データがありません');
        }

        return view('reply', [
            'comment' => $comment,
            'replies' => $replies,
        ]);
    }

    public function commentReply(ReplyRequest $request)
    {
        \DB::beginTransaction();
        try {
            Reply::create([
                'user_id' => $request->user_id,
                'comment_id' => $request->comment_id,
                'reply' => $request->reply,
            ]);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        return redirect('/bbs/comment/reply/'.$request->comment_id)->with('status', 'コメントに返信しました');
    }

    public function titleSearch(Request $request)
    {
        $posts = Post::where('title', 'like', "%{$request->title_search}%")->paginate();
        $posts->load('category', 'user');
        $categories = Category::all();

        $serach_result = $request->title_search. 'の検索結果 '. $posts->total(). '件';

        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
            'serach_result' =>  $serach_result,
        ]);
    }

    public function categorySearch(Request $request)
    {
        $posts = Post::where('category_id', $request->category_search)->paginate();
        $posts->load('category', 'user');
        $categories = Category::all();

        $category_name = Category::find($request->category_search)->name;
        $serach_result = $category_name. 'の検索結果 '. $posts->total(). '件';

        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
            'serach_result' => $serach_result,
        ]);
    }

    public function store(PostRequest $request)
    {
        $user = \Auth::user();
        $image = $request->file('image');

        if ($request->hasFile('image')) {
            $path = \Storage::put('public', $image);
            $path = explode('/', $path);
        } else {
            $path = null;
        }

        \DB::beginTransaction();
        try {
            Post::create([
                'user_id' => $user['id'],
                'title' => $request['title'],
                'thumbnail_image' => $path[1],
                'content' => $request['content'],
                'category_id' => $request['category'],
            ]);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        return redirect(route('home'))->with('status', '掲示板を投稿しました');
    }



}
