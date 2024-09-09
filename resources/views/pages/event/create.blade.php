<!-- resources/views/events/create.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="/css/app.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startAt = localStorage.getItem('start_at');
            const endAt = localStorage.getItem('end_at');
            if (startAt && endAt) {
                document.getElementById('start_at_display').innerText = startAt;
                document.getElementById('end_at_display').innerText = endAt;
                document.getElementById('start_at').value = startAt;
                document.getElementById('end_at').value = endAt;

            }
        });
    </script>
</head>
<body>
    <h1>イベント作成</h1>
    <form action="/event/create" method="POST">
        @csrf
        <label for="name">イベント名:</label>
        <input type="text" name="name" required><br>
        
        <label for="information">詳細:</label>
        <textarea id="information" name="information" required></textarea><br>
        
        <input type="hidden" id="start_at" name="start_at" readonly><br>
        
        <input type="hidden" id="end_at" name="end_at" readonly><br>

        <input type="hidden" name="venue_id" value="1"><br>
        
        <button type="submit">予約</button>
    </form>
</body>
</html>
