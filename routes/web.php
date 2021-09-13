<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// ゲストログイン
Route::get('/login/guest', [App\Http\Controllers\Auth\LoginController::class, 'guestLogin'])->name('login.guest');

Route::group(['middleware' => 'auth'], function () {
//掲示板投稿一覧を表示
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//掲示板投稿画面を表示
Route::get('/bbs/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
//掲示板投稿
Route::post('/bbs/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
//コメント投稿画面を表示
Route::get('/bbs/comment/{id}', [App\Http\Controllers\HomeController::class, 'comment'])->name('comment');
//コメント投稿
Route::post('/bbs/comment/store', [App\Http\Controllers\HomeController::class, 'commentStore'])->name('comment.store');
//コメント返信表示
Route::get('/bbs/comment/reply/{id}', [App\Http\Controllers\HomeController::class, 'showReply'])->name('reply');
//コメントに返信
Route::post('/bbs/comment/reply', [App\Http\Controllers\HomeController::class, 'commentReply'])->name('comment.reply');
//掲示板タイトルで検索
Route::get('/title/search', [App\Http\Controllers\HomeController::class, 'titleSearch'])->name('title.search');
//カテゴリーで検索
Route::get('/category/search', [App\Http\Controllers\HomeController::class, 'categorySearch'])->name('category.search');


});