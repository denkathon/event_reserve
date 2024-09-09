<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <main>
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
    </main>

</body>

</html>