<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // バリデーションを設定
        $request->validate([
            'body' => 'required',
        ], [
            'body.required' => '本文は必須です。',
        ]);

        // commentのインスタンス化して、プロパティに値を設定していく。
        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->body = $request->body;
        $comment->save();

        // 追加後に投稿の詳細画面に戻す。
        return redirect()
            ->route('posts.show', $post);
    }

    //削除用のメソッドを定義する。Comment型の$commentを渡して、deleteする。
    public function destroy(Comment $comment)
    {
        $comment->delete();

        // 削除後は投稿の詳細画面にリダイレクトさせる。リレーションが設定されているため、$commentに紐付けられたpostを渡す。
        return redirect()
            ->route('posts.show', $comment->post);
    }
}
