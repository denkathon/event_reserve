<!-- resources/views/events/show.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="/app/styles.css">
</head>
<body>
    <h1>{{ $event->name }}</h1>
    <p>{{ $event->information }}</p>
    <p>開始時刻: {{ $event->start_at }}</p>
    <p>終了時刻: {{ $event->end_at }}</p>
</body>
</html>
