@extends('layouts.app') 
@vite('resources/css/app.css')

@section('content')
<div class="event-detail-page">
    <h1>イベント詳細</h1>
    
    <!-- イベント詳細情報を表示 -->
    <div class="event-detail">
        <h2 class="text-2xl font-bold text-gray-800">{{ $event->name }}</h2>
        <p class="text-lg text-gray-600">会場: {{ $event->venue->name }}</p>
        <p class="text-lg text-gray-600">情報: {{ $event->information }}</p>
        <p class="text-lg text-gray-600">開始時間: {{ $event->start_at }}</p>
        <p class="text-lg text-gray-600">終了時間: {{ $event->end_at }}</p>
        
        <!-- 戻るボタン -->
        <a href="{{ route('event.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">戻る</a>
    </div>
</div>
@endsection
