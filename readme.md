※間違えてリポジトリ削除してしまったのでコミットログと芝消えた(´；ω；`)ｳｯ…
## KAKEIBOT2

### 環境
LARAVEL 5.5
PHP 7.2
PostgreSQL 10.3
CentOS 7
GoogleCloudPlatform
<hr>

#### 概要
LINE機能:カテゴリ登録、金額登録、任意月の支出一覧表示
WEB概要:カテゴリ登録/編集、金額登録/編集、予算登録/編集、支出編集/確認
<hr>

#### その他
・WEB会員登録方法はLINE上で会員登録と発言するとワンタイムURL生成するのでそのリンクから登録。
・SSL化してある
・メール機能も実装したけどいまどきメール使う利点無かったのでやめて。(SendGrid)
<hr>

### Kakeibotの歴史
##### 初代Kakeibot
・GASで動かしていた。DBはスプレッドシート。レスポンス遅すぎ。家計簿機能+トリガー使ってpushで毎朝、遅延情報と天気予報を通知していた。
##### KakeiBot1
・Java/MySQL/さくらVPS/GAS　JavaでAPIを作成。SSL化の知識がなかったためGAS(https)経由でAPIとデータ送受信。レスポンシブ早くなったけどスパゲッティーになってしまい保守飽きて放置。
##### Kakeibot2(今回の作成物)
・PHP7/PostgreSQL/GoogleCloudPlatform/Laravvel5.5。どうせなら違う言語でフルリプレス。そしてSSL化に挑戦。成功、レスポンス最速。
WEBにマスタ画面作成。サービスといえるものになった。サクラVPSは検証サーバーになりました。(5分で自動デプロイ)
GCP楽しい。クラウド最高。ロードバランサーやDBプール組んでみたい。（そこまでアクセスはないのでやらないけど。）

#### 今後の展開
・Kakeibot3
Rubyで書きたい。

<hr>


#### 雑にスクショ
<img src="https://user-images.githubusercontent.com/20530099/41574095-f5472cce-73ba-11e8-9fd1-a2e31be9cb3e.JPG" width="30%">
<img src="https://user-images.githubusercontent.com/20530099/41574097-f774504e-73ba-11e8-86fd-ba72717503c8.JPG" width="30%">
<img src="https://user-images.githubusercontent.com/20530099/41574100-f9e00238-73ba-11e8-94fd-f372ca645301.JPG" width="30%">
<img src="https://user-images.githubusercontent.com/20530099/41574101-fa08b6d8-73ba-11e8-85bb-1d40f0c03755.JPG" width="30%">
<img src="https://user-images.githubusercontent.com/20530099/41574103-fa315e80-73ba-11e8-8b80-705fa5cc2970.JPG" width="30%">

