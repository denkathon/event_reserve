<!-- resources/views/components/header.blade.php -->
<header id="main-header" style="background-color: #fff; padding: clamp(5px, 1vw, 10px) 0; color: #000; border-bottom: 2px solid #000; width: 100%; position: fixed; top: 0; left: 0; z-index: 1000;">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet" />
    <nav style="display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 0 clamp(5px, 2vw, 20px); overflow: hidden;">
        <h1 style="margin: 0; font-family: 'Dancing Script, sans-serif'; font-size: clamp(28px, 5vw, 56px); text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
            KawagoeLive
        </h1>
        
        <ul style="display: flex; list-style: none; margin: 0; padding: 0; gap: clamp(10px, 2vw, 20px); white-space: nowrap; justify-content: flex-end; flex-wrap: wrap; max-width: 100%; padding-right: 20px;">
        <!-- <ul style="display: flex; list-style: none; margin: 0; padding: 0; gap: clamp(10px, 2vw, 20px); white-space: nowrap; justify-content: flex-end; flex-wrap: wrap; max-width: 100%;"> -->
            <li style="flex-shrink: 1;"><a href="/users" style="color: #000; text-decoration: none; font-size: clamp(14px, 2vw, 24px);">マイページ</a></li>
            <li style="flex-shrink: 1;"><a href="/venue" style="color: #000; text-decoration: none; font-size: clamp(14px, 2vw, 24px);">イベントスペース一覧</a></li>
            <li style="flex-shrink: 1;"><a href="/events" style="color: #000; text-decoration: none; font-size: clamp(14px, 2vw, 24px);">イベント一覧</a></li>
        </ul>
    </nav>
</header>

