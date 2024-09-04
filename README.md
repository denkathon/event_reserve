# event_reserve

# macユーザ環境構築欄
1)githubからevent_reserveをgit clone
2)もらったenvファイルをevent_reserve直下に入れる
3)php、composerインストール

以下はevent_reserveで実行せよ
4)composer require laravel/sail --dev(sailのインストール )
5)./vendor/bin/sail up
6)./vendor/bin/sail down
7)alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
8)sail up
9)sail up 中に もう一画面開いて、sail artisan key:generate
10)sail artisan migrate（データベースを作る）
11)sail upとnpm run devコマンドを常時実行中
12)画面表示
