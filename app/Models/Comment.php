<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    //テーブル名
    protected $table = 'comments';

    //可変項目
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function comments() {
        return $this->belongsTo(\App\Models\Comment::class, 'post_id');
    }

    public function replies() {
        return $this->hasMany(\App\Models\Reply::class, 'comment_id');
    }

}
