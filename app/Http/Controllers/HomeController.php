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
        $posts = Post::with('category', 'user')->where('private', 0)->orderBy('created_at', 'desc')->get();
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

    public function delete($id)
    {
        if (is_null($id)) {
            return redirect(route('home'))->with('status', 'データがありません');
        }
        
        try {
            Post::destroy($id);
        } catch(\Throwable $e) {
            abort(500);
        }
        
        return redirect(route('home'))->with('status', '掲示板を削除しました！');
    }

    public function comment($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return redirect(route('home'))->with('status', 'データがありません');
        }

        $comments = Comment::with('user', 'comments', 'replies')->where('post_id', $post->id)->orderBy('created_at', 'desc')->get();
        if (is_null($comments)) {
            return redirect(route('home'))->with('status', 'データがありません');
        }

        //掲示板投稿private=0の場合、コメントビュー非表示
        if ($post->private > 0) {
            $post = '';
        }
        
        return view('comment', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function commentStore(CommentRequest $request)
    {
        $user_id = \Auth::id();

        $post_id = $request->post_id;
        if (is_null($post_id)) {
            return redirect(route('home'))->with('status', 'データがありません');
        }

        \DB::beginTransaction();
        try {
            Comment::create([
                'user_id' => $user_id,
                'post_id' => $post_id,
                'comment' => $request->comment_store,
            ]);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        return redirect(route('comment', $request->post_id))->with('status', 'コメントを投稿しました');
    }

    public function showReply($id)
    {
        $comment = Comment::find($id);
        if (is_null($comment)) {
            return redirect(route('home'))->with('status', 'データがありません');
        }

        $replies = Reply::with('user')->where('comment_id', $comment->id)->orderBy('created_at', 'desc')->get();
        if (is_null($replies)) {
            return redirect(route('home'))->with('status', 'データがありません');
        }
        
        return view('reply', [
            'comment' => $comment,
            'replies' => $replies,
        ]);
    }

    public function commentReply(ReplyRequest $request)
    {
        $user_id = \Auth::id();

        $comment_id = $request->comment_id;
        if (is_null($comment_id)) {
            return redirect(route('home'))->with('status', 'データがありません');
        }

        \DB::beginTransaction();
        try {
            Reply::create([
                'user_id' => $user_id,
                'comment_id' => $comment_id,
                'reply' => $request->reply,
            ]);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        return redirect(route('reply', $request->comment_id))->with('status', 'コメントに返信しました');
    }

    public function titleSearch(Request $request)
    {
        $posts = Post::with('category', 'user')->where('title', 'like', "%{$request->title_search}%")->paginate();
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
        $posts = Post::with('category', 'user')->where('category_id', $request->category_search)->paginate();
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
        $user_id = \Auth::id();

        if ($request->thumbnail_image  === NULL) {
            $thumbnail_image = base64_encode(file_get_contents($request->thumbnail_image));
        } else {
            $thumbnail_image = base64_encode(file_get_contents($request->thumbnail_image));
        }

        \DB::beginTransaction();
        try {
            Post::create([
                'user_id' => $user_id,
                'title' => $request->title,
                'thumbnail_image' => $thumbnail_image,
                'content' => $request->content,
                'category_id' => $request->category,
            ]);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        return redirect(route('home'))->with('status', '掲示板を投稿しました');
    }

}
