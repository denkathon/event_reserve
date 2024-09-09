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
    </main>

</body>

</html>