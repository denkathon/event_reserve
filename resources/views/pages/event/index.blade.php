@extends('layouts.app')

@section('content')
    <main style="padding: 20px;">
        <h1 style="font-size: 24px; margin-bottom: 20px;">イベント一覧</h1>
        <input type="text" id="searchInput" placeholder="検索 (例: '2024-09-10', '14:00', 'Monday')" style="padding: 10px; border: 1px solid #ccc; width: 300px; margin-right: 10px;">
        <button id="searchButton" style="padding: 10px 20px; background-color: black; color: white; border: none; cursor: pointer;">検索</button>
        <ul id="eventList" style="list-style: none; padding: 0; margin-top: 20px;">
            @foreach($events as $event)
            @php
                $startTime = \Carbon\Carbon::parse($event->start_at)->format('H:i');
                $endTime = \Carbon\Carbon::parse($event->end_at)->format('H:i');
                $startDate = \Carbon\Carbon::parse($event->start_at)->format('Y-m-d');
                $startDay = \Carbon\Carbon::parse($event->start_at)->format('l'); // 曜日 (例: Monday)
                $startDateTime = \Carbon\Carbon::parse($event->start_at)->format('Y-m-d');
                $eventDetails = $event->information;
            @endphp
            <li data-name="{{ $event->name }}" data-information="{{ $eventDetails }}" data-start_date="{{ $startDate }}" data-start_day="{{ $startDay }}" data-start_time="{{ $startTime }}" data-end_time="{{ $endTime }}" data-venue="{{ $event->venue->name }}" style="display: flex; align-items: center; margin-bottom: 10px; padding: 20px; background-color: #fffbea; border: 2px solid #f4e19e; border-radius: 10px; position: relative; cursor: pointer;">
                <div class="circle" style="width: 20px; height: 20px; background-color: black; border-radius: 50%; margin-right: 15px;"></div>
                <div class="event-info" style="font-size: 16px;">
                    {{ $event->name }} In {{ $event->venue->name }} from {{ $startTime }} to {{ $endTime }}
                </div>
            </li>
            @endforeach
        </ul>
    </main>

    <!-- モーダルのHTML -->
    <div class="modal-overlay" id="modal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: none; justify-content: center; align-items: center;">
        <div class="modal" style="background-color: white; padding: 20px; border-radius: 10px; width: 300px; text-align: center;">
            <h2 id="modal-title">イベント名</h2>
            <p id="modal-start-date">開始日付</p>
            <p id="modal-start-time">開始時間</p>
            <p id="modal-end-time">終了時間</p>
            <p id="modal-venue">会場</p>
            <p id="modal-details">イベント詳細情報</p>
            <button class="close-button" onclick="closeModal()" style="background-color: black; color: white; padding: 10px 20px; border: none; cursor: pointer;">閉じる</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // イベントリストの各項目にクリックイベントを追加
            const listItems = document.querySelectorAll('li');
            listItems.forEach(item => {
                item.addEventListener('click', function() {
                    // イベントの詳細情報を取得
                    const eventName = this.getAttribute('data-name');
                    const eventStartDate = this.getAttribute('data-start_date');
                    const eventStartDay = this.getAttribute('data-start_day');
                    const eventStartTime = this.getAttribute('data-start_time');
                    const eventEndTime = this.getAttribute('data-end_time');
                    const eventVenue = this.getAttribute('data-venue');
                    const eventDetails = this.getAttribute('data-information');

                    // モーダルに情報を表示
                    document.getElementById('modal-title').textContent = `イベント名: ${eventName}`;
                    document.getElementById('modal-start-date').textContent = `開始日付: ${eventStartDate} (${eventStartDay})`;
                    document.getElementById('modal-start-time').textContent = `開始時間: ${eventStartTime}`;
                    document.getElementById('modal-end-time').textContent = `終了時間: ${eventEndTime}`;
                    document.getElementById('modal-venue').textContent = `会場: ${eventVenue}`;
                    document.getElementById('modal-details').textContent = `イベント詳細: ${eventDetails}`;

                    // モーダルを表示
                    document.getElementById('modal').style.display = 'flex';
                });
            });

            // モーダルを閉じる関数
            window.closeModal = function() {
                document.getElementById('modal').style.display = 'none';
            }

            // 検索機能の追加
            document.getElementById('searchButton').addEventListener('click', function() {
                const searchInput = document.getElementById('searchInput').value.toLowerCase();
                const listItems = document.querySelectorAll('#eventList li');
                
                listItems.forEach(item => {
                    const name = item.getAttribute('data-name').toLowerCase();
                    const venue = item.getAttribute('data-venue').toLowerCase();
                    const information = item.getAttribute('data-information').toLowerCase();
                    const startDate = item.getAttribute('data-start_date').toLowerCase();
                    const startTime = item.getAttribute('data-start_time').toLowerCase();
                    const startDay = item.getAttribute('data-start_day').toLowerCase();

                    // 検索ワードが名前、会場、詳細、開始日時、開始時間、または開始曜日に含まれていれば表示、それ以外は非表示
                    if (name.includes(searchInput) || venue.includes(searchInput) || information.includes(searchInput) || startDate.includes(searchInput) || startTime.includes(searchInput) || startDay.includes(searchInput)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });

            // 入力フィールドの内容が変わるたびに検索
            document.getElementById('searchInput').addEventListener('input', function() {
                document.getElementById('searchButton').click();
            });
        });
    </script>
@endsection
