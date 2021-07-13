<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //テーブル名
    protected $table = 'posts';

    //可変項目
    protected $fillable = [
        'user_id',
        'title',
        'thumbnail_image',
        'content',
        'category_id',
    ];

    public function category() {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}
