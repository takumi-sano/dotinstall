<x-layout>
    <x-slot name="title">
        Edit Post - My BBS
    </x-slot>
    <div class="back-link">
        &laquo; <a href="{{ route('posts.show', $post)}}">Back</a>
    </div>

    <h1>Edit Post</h1>
    <form method="post" action="{{ route('posts.update', $post) }}">
        {{-- method属性をpatchとして、送信。 --}}
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label>
                Title
                {{-- old()に第二引数として、データを渡すことで、ユーザが入力したoldの値が存在しない場合に第二引数のデータを表示してくれる。 --}}
                <input type="text" name="title" value="{{ old('title', $post->title) }}">
            </label>
            {{-- titleに関するエラーを表示。エラーメッセージは$messageに渡される。 --}}
            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>
                Body
                {{-- old()に第二引数として、データを渡すことで、ユーザが入力したoldの値が存在しない場合に第二引数のデータを表示してくれる。 --}}
                <textarea name="body">{{ old('body', $post->body) }}</textarea>
            </label>
            {{-- titleに関するエラーを表示。エラーメッセージは$messageに渡される。 --}}
            @error('body')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-button">
            <button>Update</button>
        </div>
    </form>
</x-layout>
