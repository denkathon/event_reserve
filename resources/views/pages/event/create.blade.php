<!-- resources/views/events/create.blade.php -->
@extends('layouts.app') 
@vite('resources/css/app.css')

@section('content')
<div class="event-create-page">
    <h1 class="text-4xl font-bold text-gray-900 mb-6">イベント作成</h1>
    
    <div class="event-create-form">
        <form action="{{ route('event.store') }}" method="POST">
            @csrf
            <!-- 開始時間と終了時間の隠しフィールド -->
            <input type="hidden" name="start_at" value="{{ request()->query('start_at') }}">
            <input type="hidden" name="end_at" value="{{ request()->query('end_at') }}">
            
            <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-700">イベント名</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="information" class="block text-lg font-medium text-gray-700">イベント情報</label>
                <textarea id="information" name="information" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required></textarea>
            </div>

            <div class="mb-4">
                <label for="start_at" class="block text-lg font-medium text-gray-700">開始時間</label>
                <input type="datetime-local" id="start_at" name="start_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="end_at" class="block text-lg font-medium text-gray-700">終了時間</label>
                <input type="datetime-local" id="end_at" name="end_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="venue_id" class="block text-lg font-medium text-gray-700">会場</label>
                <select id="venue_id" name="venue_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    @foreach($venues as $venue)
                        <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">作成</button>
            </div>
        </form>

        <!-- 戻るボタン -->
        <a href="{{ route('event.index') }}" class="mt-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 inline-block">戻る</a>
    </div>
</div>
@endsection
