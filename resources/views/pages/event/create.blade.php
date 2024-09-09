<!-- resources/views/events/create.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <h1>イベント作成</h1>
    <form action="pages/event/create" method="POST">
        @csrf
        <label for="name">イベント名:</label>
        <input type="text" name="name" required><br>
        
        <label for="information">詳細:</label>
        <textarea name="information" required></textarea><br>
        
        <label for="start_at">開始時刻:</label>
        <input type="datetime-local" name="start_at" required><br>
        
        <label for="end_at">終了時刻:</label>
        <input type="datetime-local" name="end_at" required><br>

        <input type="hidden" name="venue_id" value="1"><br>
        
        <button type="submit">次へ</button>
    </form>
</body>
</html>
