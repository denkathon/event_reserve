<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- ヘッダー -->
    @include('components.header')

    <main>
        @yield('content')
    </main>

    <!-- JavaScriptコード -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const header = document.getElementById('main-header');

            function updatePaddingTop() {
                const headerHeight = header.offsetHeight;
                document.body.style.paddingTop = headerHeight + 'px';
            }

            updatePaddingTop();

            window.addEventListener('resize', updatePaddingTop);
        });
    </script>
</body>
</html>
