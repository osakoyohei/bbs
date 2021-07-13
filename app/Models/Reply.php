<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    //テーブル名
    protected $table = 'replies';

    //可変項目
    protected $fillable = [
        'user_id',
        'comment_id',
        'reply',
    ];

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}
