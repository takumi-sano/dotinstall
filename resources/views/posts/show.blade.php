<x-layout>
    <x-slot name="title">
        {{ $post->title }} - My BBS
    </x-slot>
    <div class="back-link">
        &laquo; <a href="{{ route('posts.index')}}">Back</a>
    </div>

    <h1>

        <span>{{ $post->title }}</span>

        {{-- 編集ボタンの追加。ルーティングを指定してから、$postのデータを渡す。 --}}
        <a href="{{ route('posts.edit', $post) }}">[Edit]</a>

        {{-- 削除ボタンの追加。送信先にはposts.destroyがよく使われる。データを渡すのを忘れずに。 --}}
        <form method="post" action="{{ route('posts.destroy', $post) }}" id="delete_post">
            {{-- 削除はDELETE形式で。csrf対策も忘れずに。 --}}
            @method('DELETE')
            @csrf
            <button class="btn">[Delete]</button>
        </form>

    </h1>

    {{-- 改行を反映させるために、初めにe()で悪意のあるコードをはじいて
        nl2brを適用する。 --}}
    <p>{!! nl2br(e($post->body)) !!}</p>

    {{-- コメントを表示する。 --}}
    <h2>Comments</h2>
    <ul>
            <li> {{-- コメントフォーム --}}
                <form method="post" action="{{ route('comments.store', $post)}}" class="comment-form">
                    @csrf

                    <input type="text" name="body">
                    <button>Add</button>
                </form>
                @error('body')
                <div class="error">{{ $message }}</div>
            @enderror
            </li>
        @foreach ($post->comments()->latest()->get() as $comment) {{-- 投稿に対応するコメントを$commentに格納する。 --}}
            <li>
                {{ $comment->body }} {{-- commentデータが格納されている変数から本文を抽出。 --}}
                <form method="post" action="{{ route('comments.destroy', $comment) }}" class="delete-comment">
                    @method('DELETE')
                    @csrf

                    <button class="btn">[Delete]</button>
                </form>
            </li>
        @endforeach
    </ul>

    <script>
        // 厳密なエラーチェック
        'use strict';

        {
            // idからformを取得して、イベントリスナーを追加する。
            // submitされたときは次の処理をする。
            document.getElementById('delete_post').addEventListener('submit', e => {
                // 処理を一旦停止するためにpreventDefaultをする。
                e.preventDefault();
                // キャンセルされた場合はリターン。
                if (!confirm('削除しますか？')) {
                    return;
                }
                // そうでない場合はformを送信したいのでsubmit。
                e.target.submit();
            });

            document.querySelectorAll('.delete-comment').forEach(form => {
                form.addEventListener('submit', e => {
                    e.preventDefault();

                    if (!confirm('削除しますか？')) {
                        return;
                    }

                    form.submit();
                })
            });
        }

    </script>
</x-layout>
