<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ]; //fillableプロパティに設定したいカラムを書いてプロパティを作成する。

    // $post->comments
    public function comments()
    {
        // 投稿は複数のコメントを所持している。
        return $this->hasMany(Comment::class); // CommentとPostで名前空間が同じであるため、App\Modelsを省略。
    }
}
