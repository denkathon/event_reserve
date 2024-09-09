<div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="user_name">ユーザー名</label>
        <input type="text" id="user_name" name="user_name" required>

        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">ログイン</button>
    </form>
    <a href="{{ route('register') }}">新規作成はこちら</a>
    
    @include('components.flashMessage')
</div>