@extends('layouts.app')

@section('content')
<div class="event-create-container">
    <h1 class="event-create-heading">イベント作成</h1>

    <form action="{{ route('event.store', ['venue_id' => $venue_id]) }}" method="POST" class="event-create-form">
        @csrf

        <!-- 開始時間と終了時間の隠しフィールド -->
        <input type="hidden" name="start_at" value="{{ $startAt }}">
        <input type="hidden" name="end_at" value="{{ $endAt }}">

        <!-- 開始時間と終了時間の表示 -->
        <div class="event-form-group">
            <label class="event-label">開始時間</label>
            <p class="event-time">{{ $startAt }}</p>
        </div>

        <div class="event-form-group">
            <label class="event-label">終了時間</label>
            <p class="event-time">{{ $endAt }}</p>
        </div>

        <!-- イベント名 -->
        <div class="event-form-group">
            <label for="name" class="event-label">イベント名</label>
            <input type="text" id="name" name="name" class="event-input" required>
        </div>

        <!-- イベント情報 -->
        <div class="event-form-group">
            <label for="information" class="event-label">イベント情報</label>
            <textarea id="information" name="information" rows="4" class="event-textarea" required></textarea>
        </div>

        <!-- 作成ボタン -->
        <div class="flex justify-center">
            <button type="submit" class="event-submit-button">作成</button>
        </div>
    </form>

    <!-- 戻るボタン -->
    <div class="flex justify-center mt-6">
        <a href="{{ route('event.space', ['venue_id' => $venue_id]) }}" class="event-back-button">戻る</a>
    </div>
</div>
@endsection

@vite('resources/css/app.css')
