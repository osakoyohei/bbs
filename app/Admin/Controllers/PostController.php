<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        
        // $grid->column('user_id', __('User id'));
        $grid->user()->name('名前')->filter('like');

        $grid->column('title', __('掲示板タイトル'))->filter('like');
        $grid->column('thumbnail_image', __('Thumbnail image'));
        $grid->column('content', __('Content'));

        // $grid->column('category_id', __('Category id'));
        $grid->category()->name('カテゴリー名')->filter('like');
        
        $grid->column('private', __('表示(0)・非表示(1)'))->filter();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('title', __('Title'));
        $show->field('thumbnail_image', __('Thumbnail image'));
        $show->field('content', __('Content'));
        $show->field('category_id', __('Category id'));
        $show->field('private', __('表示(0)・非表示(1)'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->comment_admin('掲示板投稿のコメント', function ($comments) {
            $comments->resource('/admin/comments');
            $comments->comment('コメント');
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post());

        $form->number('user_id', __('User id'));
        $form->text('title', __('Title'));
        $form->text('thumbnail_image', __('Thumbnail image'));
        $form->textarea('content', __('Content'));
        $form->number('category_id', __('Category id'));
        $form->number('private', __('表示(0)・非表示(1)'));

        return $form;
    }
}
