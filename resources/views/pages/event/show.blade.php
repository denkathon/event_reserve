<!-- resources/views/events/show.blade.php -->
@extends('layouts.app') 
@vite('resources/css/app.css')

@section('content')
<div class="event-detail-page">
    <h1 class="text-4xl font-bold text-gray-900 mb-6">イベント詳細</h1>
    
    <!-- イベント詳細情報を表示 -->
    <div class="event-detail">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $event->name }}</h2>
        <p class="text-lg text-gray-600">会場: <span class="font-semibold">{{ $venue->name }}</span></p>
        <p class="text-lg text-gray-600">情報: {{ $event->information }}</p>
        <p class="text-lg text-gray-600">開始時間: {{ $event->start_at }}</p>
        <p class="text-lg text-gray-600">終了時間: {{ $event->end_at }}</p>
        
        <!-- イベントに関連するユーザーのリスト -->
        <h3 class="text-2xl font-semibold text-gray-700 mt-6">参加ユーザー:</h3>
        <ul class="list-disc list-inside mt-4">
            @foreach($userDetails as $userDetail)
                <li>
                    <p class="text-base">名前: <span class="font-semibold">{{ $userDetail['name'] }}</span></p>
                    <p class="text-base">メール: <span class="font-semibold">{{ $userDetail['e_mail'] }}</span></p>
                    <p class="text-base">電話番号: <span class="font-semibold">{{ $userDetail['phone_number'] }}</span></p>
                </li>
            @endforeach
        </ul>

        <!-- 戻るボタン -->
        <a href="{{ route('event.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">戻る</a>
    </div>
</div>
@endsection
