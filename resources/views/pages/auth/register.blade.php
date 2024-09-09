<div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="user_name">ユーザー名</label>
        <input type="text" id="user_name" name="user_name" required>

        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" required>

        <label for="name">名前</label>
        <input type="text" id="name" name="name" required>

        <button type="submit">登録</button>
    </form>

    @include('components.flashMessage')
</div>