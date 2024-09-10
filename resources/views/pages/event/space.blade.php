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
                                        <a href="{{ route('event.show', ['event_id' => $event->id]) }}" class="btn event-btn">{{ $event->name }}</a>
                                    @else
                                        <a href="javascript:void(0);" onclick="navigateToCreatePage('{{ $venue_id }}', '{{ $startAt }}', '{{ $endAt }}')" class="btn empty-btn">予約する</a>
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

<!-- JSで新規イベント作成ページに遷移 -->
<script>
    function navigateToCreatePage(venueId, startAt, endAt) {
        const url = `/venue/${venueId}/event/create?start_at=${startAt}&end_at=${endAt}`;
        window.location.href = url;
    }
</script>

@endsection
