<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'body',
    ];

    // $comment->post
    public function post()
    {
        // コメントは特定の投稿に属している。
        return $this->belongsTo(Post::class);
    }
}
