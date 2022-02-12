<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // postsテーブルのidに紐付けたいので、同じデータ型でpost_idとしておくとlaravelがpostsテーブルのidに紐づけてくれる。
            $table->unsignedBigInteger('post_id');
            // コメントカラムの追加。
            $table->string('body');
            $table->timestamps();
            // 外部キー制約を作成。
            $table
                ->foreign('post_id') // 外部キーを指定。
                ->references('id') // idと紐付ける。
                ->on('posts') // postsテーブルの。
                ->onDelete('cascade'); // postsテーブルのレコード削除と同時にコメントを削除する。
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
