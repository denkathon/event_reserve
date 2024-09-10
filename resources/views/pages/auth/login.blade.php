@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <h1 class="auth-heading">ログイン</h1>
        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <div class="auth-form-group">
                <label for="user_name">ユーザー名</label>
                <input type="text" id="user_name" name="user_name" required>
            </div>
            <div class="auth-form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="auth-submit-button">ログイン</button>
        </form>

        <a href="{{ route('register') }}" class="auth-link">新規作成はこちら</a>

        @include('components.flashMessage')
    </div>
@endsection

@vite('resources/css/app.css')
