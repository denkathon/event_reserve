# event_reserve

## macユーザ環境構築欄
dockerのバージョン古めがいいhttps://matsuand.github.io/docs.docker.jp.onthefly/engine/install/

安定版をインストールしてください

1)githubからevent_reserveをgit clone

2)もらったenvファイルをevent_reserve直下に入れる、名前は.envです。vsCode

3)php、composerインストール

npm install (依存関係再構築)

以下はevent_reserveで実行せよ、dockerを開けなさい！！！！！！

php artisan key:generate

4)composer require laravel/sail --dev(sailのインストール )

5)./vendor/bin/sail up

6)./vendor/bin/sail down

7)alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'

8)sail up (以下短縮sail使えなかったら、短縮せずに使え)

9)sail up 中に もう一画面開いて、sail artisan key:generate ----->//////php sail artisan key:generate実行したらなくていい

10)sail artisan migrate（データベースを作る）

11)sail upとnpm run devコマンドを常時実行中(ターミナル3画面、もう一画面他の操作)

12)画面表示

##########################################
