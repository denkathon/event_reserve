

    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KawagoeLive</title>-->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 2px solid black;
        }

        nav a {
            margin-right: 10px;
            text-decoration: none;
            font-weight: bold;
            color: black;
            padding: 10px;
            border: 1px solid black;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        main {
            padding: 20px;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            width: 300px;
            margin-right: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 20px;
            background-color: #fffbea;
            border: 2px solid #f4e19e;
            border-radius: 10px;
            position: relative;
            cursor: pointer;
        }

        li .circle {
            width: 20px;
            height: 20px;
            background-color: black;
            border-radius: 50%;
            margin-right: 15px;
        }

        .event-info {
            font-size: 16px;
        }

        /* モーダルのスタイル */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .modal {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }

        .close-button {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!--<header>
        <h1>KawagoeLive</h1>
        <nav>
            <a href="#">マイページ</a>
            <a href="#">イベントスペース一覧</a>
            <a href="/events">イベント一覧</a>
            <a href="#">予約確認</a>
            <a href="#">予約</a>
        </nav>
    </header>-->
    <main>
        <h1>イベント一覧</h1>
        <input type="text" placeholder="入力">
        <button>検索</button>
        <ul>
            @foreach($events as $event)
            <li data-name="{{ $event->name }}" data-information="{{ $event->information }}" data-details="{{ $event->details }}" data-start_at="{{ $event->search_start_at }}" data-date="{{ $event->date }}">
                <div class="circle"></div>
                <div class="event-info">{{ $event->name }} - {{ $event->information }}, {{ $event->search_start_at }}, {{ $event->search_date }}</div>
            </li>
            @endforeach
        </ul>
    </main>

    <!-- モーダルのHTML -->
    <div class="modal-overlay" id="modal">
        <div class="modal">
            <h2 id="modal-title">イベント名</h2>
            <p id="modal-details">イベント詳細情報</p>
            <p id="modal-date">イベント日付</p>
            <button class="close-button" onclick="closeModal()">閉じる</button>
        </div>
    </div>

    <script>
        // イベントリストの各項目にクリックイベントを追加
        const listItems = document.querySelectorAll('li');
        listItems.forEach(item => {
            item.addEventListener('click', function() {
                // イベントの詳細情報を取得
                const eventName = this.getAttribute('data-name');
                const eventDetails = this.getAttribute('data-information');
                const eventDate = this.getAttribute('data-search_start_at');

                // モーダルに情報を表示
                document.getElementById('modal-title').textContent = eventName;
                document.getElementById('modal-details').textContent = eventDetails;
                document.getElementById('modal-date').textContent = eventDate;

                // モーダルを表示
                document.getElementById('modal').style.display = 'flex';
            });
        });

        // モーダルを閉じる関数
        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>
