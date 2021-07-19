<?php

namespace App\Admin\Controllers;

use App\Models\Comment;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CommentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Comment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Comment());

        $grid->column('id', __('Id'));

        // $grid->column('user_id', __('User id'));
        $grid->user()->name('名前')->filter('like');

        $grid->column('post_id', __('Post id'));
        $grid->column('comment', 'コメント')->filter('like');
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
        $show = new Show(Comment::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('post_id', __('Post id'));
        $show->field('comment', __('Comment'));
        $show->field('private', __('表示(0)・非表示(1)'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->replies_admin('コメント投稿に対するコメント', function ($replies) {
            $replies->resource('/admin/replies');
            $replies->reply('返信');
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
        $form = new Form(new Comment());

        $form->number('user_id', __('User id'));
        $form->number('post_id', __('Post id'));
        $form->textarea('comment', __('Comment'));
        $form->number('private', __('表示(0)・非表示(1)'));

        return $form;
    }
}
