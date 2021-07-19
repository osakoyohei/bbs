<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('manager/users', UserController::class); 
    $router->resource('manager/posts', PostController::class); 
    $router->resource('manager/comments', CommentController::class); 
    $router->resource('manager/replies', ReplyController::class); 
    $router->resource('manager/categories', CategoryController::class); 

});
