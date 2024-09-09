<!-- resources/views/events/space.blade.php -->
@extends('layouts.app') 
@vite('resources/css/app.css')

@section('content')
<div class="schedule-page">
    <h1>予約スケジュール</h1>

    <!-- 2週間分のカレンダーを表示 -->
    @for($week = 0; $week < 2; $week++)
        <h2>{{ $week === 0 ? '今週' : '来週' }}</h2>
        <div class="schedule">
            <table border="1">
                <thead>
                    <tr>
                        <th>時間</th>
                        @for($i = 0; $i < 7; $i++)
                            <!-- 日付と曜日を表示（曜日は漢字）-->
                            @php
                                $date = now()->addDays($i + ($week * 7))->timezone('Asia/Tokyo');
                                $dayOfWeek = ['日', '月', '火', '水', '木', '金', '土'][$date->dayOfWeek];
                            @endphp
                            <th>{{ $date->format('Y-m-d') }} ({{ $dayOfWeek }})</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @for($hour = 11; $hour < 24; $hour++)
                        <tr>
                            <td>{{ $hour }}:00</td>
                            @for($i = 0; $i < 7; $i++)
                                @php
                                    $currentDate = now()->addDays($i + ($week * 7))->timezone('Asia/Tokyo')->format('Y-m-d');
                                    $startAt = "{$currentDate} {$hour}:00:00";
                                    $endAt = "{$currentDate} " . ($hour + 1) . ":00:00";
                                    $event = $events->where('start_at', $startAt)->first();
                                @endphp
                                <td>
                                    @if($event)
                                        <button type="button" class="btn event-btn" data-event-id="{{ $event->id }}">{{ $event->name }}</button>
                                    @else
                                        <a href="javascript:void(0);" onclick="navigateToCreatePage('{{ $startAt }}', '{{ $endAt }}')" class="btn empty-btn">予約する</a>
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    @endfor
</div>

<!-- モーダルのHTML -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">イベント詳細</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="eventName"></p>
                <p id="eventVenue"></p>
                <p id="eventInfo"></p>
                <p id="eventTime"></p>
            </div>
        </div>
    </div>
</div>

<!-- JSで新規イベント作成ページに遷移 -->
<script>
    function navigateToCreatePage(startAt, endAt) {
        const url = `/event/create?start_at=${startAt}&end_at=${endAt}`;
        window.location.href = url;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // イベントデータを埋め込む
        const events = @json($events);

        // ボタンがクリックされたときの処理
        document.querySelectorAll('.event-btn').forEach(button => {
            button.addEventListener('click', function() {
                const eventId = this.dataset.eventId;
                const event = events.find(event => event.id === eventId);
                
                if (event) {
                    document.getElementById('eventName').textContent = `イベント名: ${event.name}`;
                    document.getElementById('eventVenue').textContent = `会場: ${event.venue_id}`; // 実際には会場名などに変換する必要があります
                    document.getElementById('eventInfo').textContent = `情報: ${event.information}`;
                    document.getElementById('eventTime').textContent = `時間: ${event.start_at} 〜 ${event.end_at}`;
                    
                    // モーダルを表示
                    new bootstrap.Modal(document.getElementById('eventModal')).show();
                }
            });
        });
    });
</script>

@endsection
