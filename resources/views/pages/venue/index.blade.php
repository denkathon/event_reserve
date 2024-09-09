<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>イベントスペース一覧</title>
</head>
<body>

    <!-- ヘッダーをインクルード -->
    @include('components.header')
    @extends('layouts.app')

@section('content')
<div class="venue-container">
    <h1 class="venue-title">イベントスペース一覧</h1>
    <ul class="venue-list">
        @if($venues->isEmpty())
            <p>会場がありません。</p>
        @else
            @foreach($venues as $venue)
                <li class="venue-item">
                    <a href="{{ route('venue.show', ['venue_id' => $venue->id]) }}" class="venue-link">
                        <div class="circle-icon"></div>
                        <div class="venue-details">
                            <!-- データベースのフィールドを表示 -->
                            <span><strong>名前:</strong> {{ $venue->name }}</span><br>
                            <span><strong>情報:</strong> {{ $venue->information }}</span><br>
                            <span><strong>住所:</strong> {{ $venue->address }}</span><br>
                        </div>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</div>
@endsection
