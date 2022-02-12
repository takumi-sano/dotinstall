<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Postcontroller;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Postcontroller::class, 'index'])
    ->name('posts.index');

Route::get('/posts/{post}', [Postcontroller::class, 'show'])
    ->name('posts.show')
    //postには0~9までの数値しか受け付けない。
    ->where('post', '[0-9]+');

    //\posts.createにアクセスしたらPostControllerのcreateメソッドを呼ぶ。
Route::get('/posts/create', [Postcontroller::class, 'create'])
    ->name('posts.create');
    //投稿を保存するためのルーティング
Route::post('/posts./store', [Postcontroller::class, 'store'])
    ->name('posts.store');

Route::get('/posts/{post}/edit', [Postcontroller::class, 'edit'])
    ->name('posts.edit')
    //postには0~9までの数値しか受け付けない。
    ->where('post', '[0-9]+');
    //更新を反映させるルーティング。データの形式はpatch形式で。
Route::patch('/posts/{post}/update', [Postcontroller::class, 'update'])
    ->name('posts.update')
    //postには0~9までの数値しか受け付けない。
    ->where('post', '[0-9]+');
// 投稿削除用のルーティング。データの形式はdelete形式。メソッドはdestroy。
Route::delete('/posts/{post}/destroy', [Postcontroller::class, 'destroy'])
    ->name('posts.destroy')
    //postには0~9までの数値の文字列しか受け付けない。
    ->where('post', '[0-9]+');
// コメント追加用のルーティング。
// コメント用なので、コントローラはCommentController。
Route::post('/posts/{post}/comments', [Commentcontroller::class, 'store'])
    ->name('comments.store')
    //postには0~9までの数値しか受け付けない。
    ->where('post', '[0-9]+');

// コメント削除用のルーティング。データの形式はdelete形式。メソッドはdestroy。
// delete 形式で comments の comment の id と destroy がきたら、CommentController の destroy メソッドを実行
Route::delete('/comments/{comment}/destroy', [Commentcontroller::class, 'destroy'])
    ->name('comments.destroy')
    //commentには0~9までの数値の文字列しか受け付けない。
    ->where('comment', '[0-9]+');
