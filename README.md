# event_reserve

## 📝 ハッカソンレポート

---

### 1. ハッカソン概要

- **ハッカソン名**: カワゴエソン2024  
- **開催日**: 2024年8月26日 ～ 9月10日  
- **開催場所**: りそな小江戸テラス3階  
- **主催者**:
  - カラビナテクノロジー株式会社  
  - DENPAL（東京電機大学プログラミングコミュニティ）共催  
  - 埼玉りそな銀行  
  - 地域デザインラボさいたま  
- **チーム名**: 遅刻にオールイン  
- **メンバー**: 5名  
- **開発期間**: 2024年8月26日 ～ 9月10日  

### 2. 課題と目的

- **ハッカソンのテーマ**：「川越市の課題解決型ハッカソン」

#### 解決すべき課題：
- 観光時間が日中の短時間となっており、伸び悩んでいる  
- デジタル技術の活用が不十分である  

#### 課題を選んだ理由：
川越市の観光は日中に集中しており、夜間の観光需要が確立されていない。  
夜の観光需要を創出することで、観光の時間帯を広げ、地域経済の活性化につなげることができると考えた。  
また、夜の川越の魅力を発信することで、昼間に偏りがちな観光客の分散にも寄与できると判断した。  
そのため、**デジタル技術を活用し、夜間の観光をより魅力的にする方法**を模索することが重要だと考えた。

### 3. 開発したプロダクト

- **プロダクト名**：KawagoeLive  
- **概要**：アーティストとビジターを川越でつなげるWebアプリ  
- **主要な機能**:
  - アカウント機能  
  - アーティストとビジターの予約機能  
  - 会場検索機能  
  - イベント詳細と会場詳細の閲覧機能

### 4.  🛠 技術スタック
- **フロントエンド**: HTML, CSS, JavaScript, Bootstrap
- **バックエンド**: Laravel
- **データベース**: MySQL
- **コンテナ**: Docker
- **CI/CD**: GitHub Actions

---
## 🚀 環境構築手順
以下の手順で開発環境をセットアップできます：

## macユーザ環境構築欄
dockerのバージョン古めがいいhttps://matsuand.github.io/docs.docker.jp.onthefly/engine/install/

安定版をインストールしてください

1)githubからevent_reserveをgit clone

2)もらったenvファイルをevent_reserve直下に入れる、名前は.envです。vsCode

3)php、composerインストール

npm install (依存関係再構築)

以下はevent_reserveで実行せよ、dockerをスタート。

php artisan key:generate

4)composer require laravel/sail --dev(sailのインストール )

5)./vendor/bin/sail up

6)./vendor/bin/sail down

7)alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'

8)sail up (以下短縮sail使えなかったら、短縮せずに使う)

9)sail up 中に もう一画面開いて、sail artisan key:generate ----->//////php sail artisan key:generate実行したらなくていい

10)sail artisan migrate（データベースを作る）

11)sail upとnpm run devコマンドを常時実行中

12)画面表示

---
