# college

ポートフォリオとして、架空の大学「令和国際大学」のサイトを制作しました。<br>
URL：　http://ngsw-portfolio.site/

## 特徴

* 全ページでPC、スマホ対応しています。(メディアクエリ)
* デザインはBootstrap等を使わず、CSSでコーディングしています。
* 資料請求フォームはフレームワークを使わず、生のPHPで作成しています。
* デプロイはAWSのEC2にしています。


## 機能一覧

* 全ページ共通
  * レスポンシブデザイン（スマホ対応）
  * スティッキーヘッダー　：　jQuery
  * ハンバーガーメニュー　：　jQuery/CSS
  * 文字サイズを大中小に変更ボタン　：　JavaScript
  * トップにスクロールで戻るボタン　：　jQuery
  * アクセスマップへスクロール移動ボタン　：　jQuery

* トップページ　http://ngsw-portfolio.site/index.html
  * スライドショー（PICK UP)　：　jQuery

* 大学案内ページ　http://ngsw-portfolio.site/about/index.html
  * タブ切り替え（本学の３つの強み）　：　jQuery

* 学部紹介ページ　http://ngsw-portfolio.site/undergraduate/index.html
  * フェードイン　：　jQuery

* キャンパスライフページ　http://ngsw-portfolio.site/campuslife/index.html
  * ページネーション　：　jQuery
  * 画像カルーセル　：　jQuery

* キャリア・就職ページ　http://ngsw-portfolio.site/career/index.html

* 入試情報ページ　http://ngsw-portfolio.site/admissions/index.html

* よくある質問ページ　http://ngsw-portfolio.site/common/contact/index.html
  * アコーディオン（よくある質問）　：　jQuery

* 資料請求フォーム　http://ngsw-portfolio.site/common/request/index.php
  * バリデーション　：　PHP
  * 入力値のクリア　：　jQuery
  * 郵便番号から、住所を自動検索　：　jQuery
  * フォーム確認、送信処理　：　PHP

## 使用技術

* フロントエンド
  * HTML
  * CSS
  * JavaScript / jQuery 3.4.1
  
* バックエンド
  * PHP 7.4.2

* インフラ
  * AWS
    * EC2
    * VPC
    * EIP
    * Route53
    * CodeDeploy / CodePipeline

* 開発環境
  * Github
  * Visual Studio Code
  * MAMP
