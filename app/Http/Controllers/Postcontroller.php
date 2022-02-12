<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class Postcontroller extends Controller
{

    public function index()
    {
        $post = Post::latest()->get();

        return view('index')
            ->with(['posts' => $post]);
    }

    public function show(Post $post)
    {
        return view('posts.show')
            ->with(['post' => $post]);
    }

    public function create()
    {
        //viewを呼び出す。postsフォルダ内のcreateを表示する。
        return view('posts.create');
    }

// 投稿を保存するためのstoreを定義する。PostRequestでバリデーションされ$requestで送信されたデータを受け取る。
    public function store(PostRequest $request)
    {
        // Postのインスタンスを作成して、プロパティに値をセットしていく。save();で保存。
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        // 保存後にindexにredirectさせる。リダイレクト先をルーティングの名前で指定。
        return redirect()
            ->route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('posts.edit')
            ->with(['post' => $post]);
    }

    // 更新するためのupdateを定義する。
    // ルーティングでpostが渡されているので、InplicitBindingPost型の$postを渡す。
    // PostRequestでバリデーションされたため、バリデーション不要。
    public function update(PostRequest $request, Post $post)
    {
        //Post型の$postが渡されているため、インスタンス不要でプロパティに値をセット。
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        //更新後に詳細画面に遷移させる。その時に$postのデータを渡す。
        return redirect()
            ->route('posts.show', $post);
    }

    // 削除するためのdestroyメソッドを定義。
    // InplicitBindingでpostのデータを渡す。
    public function destroy(Post $post)
    {
        // 渡ってきた$postをdeleteで削除してあげる。
        $post->delete();
        // 削除後は投稿一覧画面にリダイレクトさせる。
        return redirect()
            ->route('posts.index');
    }
}
