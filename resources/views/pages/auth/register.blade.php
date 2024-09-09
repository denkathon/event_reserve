@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <h1 class="auth-heading">ユーザー登録</h1>
        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf
            <div class="auth-form-group">
                <label for="user_name">ユーザー名</label>
                <input type="text" id="user_name" name="user_name" required>
            </div>
            <div class="auth-form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="auth-form-group">
                <label for="name">名前</label>
                <input type="text" id="name" name="name" required>
            </div>
            <button type="submit" class="auth-submit-button">登録</button>
        </form>
        <a href="{{ route('login') }}" class="auth-link">-戻る-</a>
        @include('components.flashMessage')
    </div>
@endsection

@vite('resources/css/app.css')
