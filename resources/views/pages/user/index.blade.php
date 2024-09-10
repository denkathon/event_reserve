@extends('layouts.app')

@section('content')
<h2 class="title">マイページ</h2>
<div class="container" style="display: flex; justify-content: space-between;">
    <!-- Sidebar Menu -->
    <div style="flex: 1; background-color: #f9f9f9; padding: 20px; border-right: 1px solid #ddd; max-width: 50%;">
        <ul class="nav flex-column" id="menu">
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="showContent('A')">現在の予約</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="showContent('B')">キャンセル済み過去の予約</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="showContent('C')">お気に入り</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="showContent('D')">クーポン一覧</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="showContent('E')">アカウント設定</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="showContent('F')">管理者</a>
            </li>
        </ul>
        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <button type="submit" class="btn btn-danger">ログアウト</button>
        </form>
    </div>

    <!-- Content Area -->
    <div style="flex: 1; padding: 20px; max-width: 50%;">
        <div id="content">
            <!-- Default message when no menu item is selected -->
            <h2 id="contentTitle">ようこそ</h2>
            <p id="contentDescription">左側のメニューから項目を選択してください。</p>
        </div>
    </div>
</div>

<style>
    .title{
      font-size: 35px;
      padding: 5px 30px;
      position: relative; 
      padding: 20px;
      font-size: 35px;
      font-weight: bold;
      margin-bottom: 10px;
      border-bottom: 2px solid #000;
    }
    /* Styling the sidebar */
    .nav-link {
        color: #333;
        font-weight: bold;
        padding: 5px 15px;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
        text-decoration: none;
        font-size: 40px;
    }

    /* Hover effect */
    .nav-link:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* Active link */
    .nav-link.active {
        background-color: #007bff;
        color: #fff;
    }

    /* Customize font and spacing */
    .nav-item {
        margin-bottom: 10px;
    }

    /* Sidebar style */
    #menu {
        padding-left: 0;
    }

    #menu .nav-item {
        list-style-type: none;
    }

    /* Logout button style */
    .btn-danger {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }

        .nav {
            display: flex;
            flex-direction: row;
            overflow-x: auto;
        }

        .nav-item {
            margin-right: 10px;
        }

        /* Make left and right equal in small screens */
        .container > div {
            max-width: 100%;
        }
    }
</style>

<script>
function showContent(page) {
    const title = document.getElementById('contentTitle');
    const description = document.getElementById('contentDescription');
    let htmlContent = '';

    // Reset active state for all links
    const links = document.querySelectorAll('.nav-link');
    links.forEach(link => link.classList.remove('active'));

    switch(page) {
        case 'A': // Current Reservation
            title.textContent = "現在の予約";
            htmlContent = `
                <ul class="nav nav-tabs" id="reservationTabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="lend-tab" data-bs-toggle="tab" href="#lend">貸出予約</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="participation-tab" data-bs-toggle="tab" href="#participation">参加予約</a>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="lend">

                        <div class="reservation-item" style="display: flex; border: 1px solid #000; padding: 10px; margin-bottom: 10px;">
                            <img src="image_placeholder.png" alt="Image" style="width: 50px; height: 50px;">
                            <div style="flex-grow: 1; padding-left: 10px;">
                                <p>名前とか詳細な情報、日時</p>
                            </div>
                            <a href="#" style="color: blue;">削除</a>
                        </div>

                        <div class="reservation-item" style="display: flex; border: 1px solid #000; padding: 10px; margin-bottom: 10px;">
                            <img src="image_placeholder.png" alt="Image" style="width: 50px; height: 50px;">
                            <div style="flex-grow: 1; padding-left: 10px;">
                                <p>名前とか詳細な情報、日時</p>
                            </div>
                            <a href="#" style="color: blue;">削除</a>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="participation">
                        <p>参加予約の情報がここに表示されます。</p>
                    </div>
                </div>
            `;
            document.querySelector('[onclick="showContent(\'A\')"]').classList.add('active');
            break;
        
        case 'B': // Past Reservation
            title.textContent = "キャンセル済み過去の予約";
            htmlContent = `
                <p>過去の予約の一覧がここに表示されます。</p>
                <div class="reservation-item" style="display: flex; border: 1px solid #000; padding: 10px; margin-bottom: 10px;">
                    <img src="image_placeholder.png" alt="Image" style="width: 50px; height: 50px;">
                    <div style="flex-grow: 1; padding-left: 10px;">
                        <p>キャンセルされた予約の詳細がここに表示されます。</p>
                    </div>
                </div>
            `;
            document.querySelector('[onclick="showContent(\'B\')"]').classList.add('active');
            break;
        
        case 'C': // Favorites
            title.textContent = "お気に入り";
            htmlContent = `
                <p>お気に入りのスペースや施設がここに表示されます。</p>
            `;
            document.querySelector('[onclick="showContent(\'C\')"]').classList.add('active');
            break;
        
        case 'D': // Coupons
            title.textContent = "クーポン一覧";
            htmlContent = `
                <p>利用可能なクーポンの一覧がここに表示されます。</p>
            `;
            document.querySelector('[onclick="showContent(\'D\')"]').classList.add('active');
            break;
        
        case 'E': // Account Settings
            title.textContent = "アカウント設定";
            htmlContent = `
                <p>アカウント設定の詳細がここに表示されます。</p>
                <div class="container">
                  <h1>ユーザー一覧</h1>
                  <table class="table">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>名前</th>
                              <th>メールアドレス</th>
                              <th>電話番号</th>
                              <th>スタンプ所持</th>
                              <th>操作</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($users as $user)
                          <tr>
                              <td>{{ $user->id }}</td>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->e_mail }}</td>
                              <td>{{ $user->phone_number }}</td>
                              <td>{{ $user->has_stamp ? 'あり' : 'なし' }}</td>
                              <td>
                                  <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">詳細</a>
                                  <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">編集</a>
                                  <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                      @csrf
                                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('本当に削除しますか？');">削除</button>
                                  </form>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
            `;
            document.querySelector('[onclick="showContent(\'E\')"]').classList.add('active');
            break;
        
        case 'F': // Admin Page
            title.textContent = "管理者ページ";
            htmlContent = `
                <p>管理者向けの情報や機能がここに表示されます。</p>
            `;
            document.querySelector('[onclick="showContent(\'F\')"]').classList.add('active');
            break;

        default:
            title.textContent = "ようこそ";
            htmlContent = "<p>左側のメニューから項目を選択してください。</p>";
    }

    description.innerHTML = htmlContent;
}
</script>
@endsection
