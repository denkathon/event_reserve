
<script>
//今日の日付データを変数に格納
//変数は"today"とする
var today=new Date(); 

//年・月・日・曜日を取得
var year = today.getFullYear();
var month = today.getMonth()+1;
var week = today.getDay();
var day = today.getDate();

var week_ja= new Array("日","月","火","水","木","金","土");

//年・月・日・曜日を書き出す
document.write(year+"年"+month+"月"+day+"日 "+week_ja[week]+"曜日");
</script>

<!-- resources/views/pages/event/space.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="/app/styles.css">
</head>
<body>
    <h1>予約スケジュール</h1>
    <div class="schedule">
        <table>
            <thead>
                <tr>
                    <th>時間</th>
                    <!-- 日付を表示 -->
                    @for($i = 0; $i < 7; $i++)
                        <th>{{ now()->addDays($i)->format('Y-m-d') }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @for($hour = 11; $hour < 24; $hour++)
                    <tr>
                        <td>{{ $hour }}:00</td>
                        @for($i = 0; $i < 7; $i++)
                            <td>
                                <!-- 予約データに基づいてセルを表示 -->
                                @if($events->where('start_at', now()->addDays($i)->format('Y-m-d H:i'))->count())
                                    <a href="#modal">{{ $events->where('start_at', now()->addDays($i)->format('Y-m-d H:i'))->first()->name }}</a>
                                @else
                                    <a href="pages/event/create">0</a>
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <div id="modal" class="modal">
        <!-- イベント詳細を表示するモーダルウィンドウ -->
    </div>
</body>
</html>