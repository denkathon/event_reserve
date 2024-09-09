<!-- resources/views/pages/toppage.blade.php -->
@extends('layouts.app')
@vite('resources/css/app.css')

@section('content')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>
    <!-- <link rel="stylesheet" href="/css/styles.css"> -->
</head>
<body>
    <div class="toppage-container">
        <h1 class="toppage-heading">イベントスペースを探してみませんか？</h1>
        <p class="toppage-paragraph">
            当サイトでは、利用可能なイベントスペースの一覧を提供しています。各スペースの詳細情報を確認し、予約フォームから簡単に予約できます。
        </p>
    </div>

    <script>
        // ページがロードされたときにアニメーションを適用
        window.onload = function() {
            const heading = document.querySelector('.toppage-heading');
            const paragraph = document.querySelector('.toppage-paragraph');
            setTimeout(() => {
                heading.classList.add('visible');
                paragraph.classList.add('visible');
            }, 200); // 200ミリ秒後にアニメーション開始
        };
    </script>
</body>
</html>

@endsection
