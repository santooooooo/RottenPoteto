# 使用しているツール

|ツール|バージョン|
|------|------|
|php|7.4|
|composer|1.10.5|
|npm|3.5.2|
|Laravel|7.12.0|
|Vue|2.6.11|
|mysql|5.7|


# フロントエンドの構造(Vue)
こちらでは、このアプリケーションの画面構成を担う**/resouces/**にあるファイルの役割について紹介します。

### /resouces/views/
**adminerLogin.blade.php**

管理者画面のログインフォームを表示します。

**contribute.blade.php**

管理者が行う映画の紹介記事の作成フォームを表示します。

**top.blade.php**

ユーザーの利用画面を表示します。こちらのファイルはVueのcomponentの表示位置を決め、サーバーから送られてきたデータをVueのcomponentへ渡す役割を担います。

### /resouces/js
**app.js**

routerの設定やサーバーから送られてきたデータの保持などVueのcomponentが機能させる役割を担います。

### /reouces/js/components/
**ContributeDetails.vue**
映画の紹介記事を表示します。他にも、ユーザーが自身のレビューを送るフォームとユーザーが自身のレビューを削除するフォームを表示します。

**ContributeInfo.vue**
全ての映画の紹介記事を表示します。また、ジャンルごとに表示させる映画の紹介記事を変える機能も持ちます。

**Home.vue**

ユーザーがこのアプリケーションにアクセスした際に初めに表示されるページを表示します。

**Login.vue**

ユーザーがサーバーへログインまたは新規登録のデータを送るためのURLとユーザーのアカウントの削除を行うフォームの表示を表示します。

**ReviewInfo.vue**

ユーザーが作成したレビューを表示します。また、レビューに対するユーザーたちの反応（ポテト）を送るフォームを表示します。

**UserInfo.vue**

ユーザーのプロフィールを表示します。

**UserProfile.vue**

ユーザーが自身のプロフィールの編集を行うことのできるフォームを表示します。


# サーバサイドの構造(Laravel)
こちらでは、アプリケーションの機能ごとの各ファイルの役割を**View、Controller、Model**に分けてまとめています。  
このアプリケーションの**View、Controller、Model**の定義は以下のようになっています。  

*View* データの入力を行ったり、Controllerから送られてきたデータを表示する。

*Controller* Viewから送られてきたリクエスト情報を機能に沿って処理し、結果をViewへ送る。処理の際、場合によってModelを使用する。

*Model* Controllerによって実行される。DBの処理やAPIの利用などによりコードが複雑化する場合にそれらの処理を担う。


## 機能ごとの各ファイルの役割
アプリケーションの機能の名称の横の()には、HTTPメソッドのリクエストの種類とその機能が呼び出されるためのパラメータが書かれています。

### 管理者側の機能

**管理者ログイン(GET /adminer)**

*View*
`/resources/views/adminerLogin.blade.php`

*Controller*
`App/Http/Controller/AdminerController::adminerAuth`  
リクエストのデータと規定値を比べ、等しい場合は`/resources/views/contribute.blade.php`へ移動し、そうではない場合は`/adminer`へリダイレクトされる。

*Model*
なし

**映画の紹介記事の作成(POST /contribute)**

*View*
`/resources/views/contribute.blade.php`  

*Controller*
`App/Http/Controller/Contribute::record`  
リクエスト内容をModelへ送り、Modelの結果のメッセージと共に`/adminer`へGETリクエストを送る。

*Model*
`App/Model/Contribute/Input::writeDB`  
リクエストの内容を映画の紹介記事を扱うDBのテーブルへ追加し、画像ファイルを既定のフォルダへ保存する。

**映画の紹介記事の作成(POST /contribute/delete)**

*View*
`/resources/views/contribute.blade.php`  

*Controller*
`App/Http/Controller/Contribute::delete`  
リクエスト内容をModelへ送り、Modelの結果のメッセージと共に`/adminer`へGETリクエストを送る。

*Model*
`App/Model/Contribute/Delete::delete`  
リクエストの内容を含むレコードが映画の紹介記事を扱うDBのテーブルに存在する場合、そのレコードと、ユーザーのレビュー情報を扱うDBのテーブルとユーザーごとの「いいね」
の状態を扱うDBのテーブルからそのレコードに関係しているレコードを削除する。なぜ他のテーブルのレコードまで削除するのかというと、レビュー情報を扱うDBのテーブルのレコ
ードは映画の紹介記事を扱うテーブルレコードのIDを外部キーに持ち、ユーザーごとの「いいね」の状態を扱うDBのテーブルのレコードはユーザーのレビュー情報を扱うDBのテーブ
ルのレコードのIDを外部キーに持つから。

### ユーザー側の機能

**アカウントの作成、ログインのためのAPIの呼び出し(GET /login/oauth)**

*View*
`/resources/views/top.blade.php`

*Controller*
` App/Http/Controllers/OAuth::redirect`  
Modelを実行する。

*Model*
`App/Model/User/GoogleOAuth::redirectToGoogle()`  
GoogleのAPIを呼び出す。呼び出されたAPIは結果のデータと共に`/login/oauth/callback`へGETリクエストを送る。

**アカウントの作成、ログイン(GET /login/oauth/callback)**

*View*
`/resources/views/top.blade.php`

*Controller*
`App/Http/Controllers/Oauth::handle`  
Modelを実行し、その結果をセッションで保存させ、Viewへ送る。

*Model*
`App/Model/User/GoogleOAuth::googleUser` `App/Model/User/Judge::judge` `App/Model/User/SignUp::siginUp` `App/Model/User/SignIn::siginIn`  
`googleUser`でAPIから送られてきたデータを取り出し、`judge`でそのデータを持つユーザーが新規のユーザーか既存のユーザーか確かめる。  
もし新規のユーザーであれば同クラス内の`signUp`メソッドでユーザーの情報を扱うDBのテーブルに新規ユーザーの情報を追加した後そのユーザーのデータを返し、
既存のユーザーであれば同クラス内の`siginIn`メソッドでそのユーザーのデータを返す。

**アカウントの削除(POST /cancel)**

*View*
`/resources/views/top.blade.php`

*Controller*
`App/Http/Controller/UsersController::userCancel`  
Modelを実行し、`/home`へGETリクエストを送りトップ画面へ戻る。

*Model*
`App/Model/User/Cancel::cancel`  
ユーザーごとの「いいね」の状態を扱うDBのテーブルのレコードとレビューを扱うDBのテーブル内のレコードから削除対象のユーザーの情報を削除した後、
ユーザーの情報を扱うDBのテーブルからリクエスト内容を含むレコードを削除

**ログアウト(GET /logout)**

*View*
`/resources/views/top.blade.php`

*Controller*
`App/Http/Controller/UsersController::userLogOut`  
セッション内のデータを空にして`/home`へGETリクエストを送る。

*Model*
なし

**自分のアカウント情報の編集(POST /update)**

*View*
`/resources/views/top.blade.php`

*Controller*
`App/Http/Controller/UsersController::updateUserProfile`  
リクエストの内容をModelへ送り、`/home`へGETリクエストを送る。

*Model*
`App/Model/User/UpdateProfile::update`  
リクエストが正規ユーザーからであれば、ユーザーのデータを扱うDBのテーブルにリクエスト情報を更新させる。また、アイコンの写真を既定のフォルダへ保存する。

**記事一覧の表示(GET /top)**

*View*
`/resources/views/top.blade.php`

*Controller*
`App/Http/ Controller/Contribute::response`  
Modelを実行し、その結果をViewへ返す。

*Model*
`App/Model/Contribute/Output::jsonData`  
映画のレビュー情報を扱うDBのテーブルの情報をjson形式で返す。

**記事ごとの情報とそれに対するレビューの一覧表示(GET ‘/review-page?contribute_id=入力値)**

*View*
`/resources/views/top.blade.php`

*Controller*
`App/Http/Controller/ReviewPageController::outputInfo`  
リクエストの内容をModelへ送り、結果をViewへ返す。

*Model*
`App/Model/User/ReviewPageInfo::outputInfo`  
入力値を含む映画のレビュー情報を扱うDBのテーブルのレコードとそれに対するユーザーのレビュー全てをjson形式で返す。

**レビューの投稿者の情報の表示(POST /review-page/user?google_user_id=入力値)**

*View*
`/resources/views/top.blade.php`

*Controller*
`App/Http/Controller/ReviewPageController::outputUserInfo`  
リクエストの内容をModelへ送り、結果をViewへ返す。

*Model*
`App/Model/User/UserInfo::output`
入力値を含むユーザーの情報を扱うDBのテーブルのレコードをjson形式で返す。

**記事ごとのレビューの作成(POST /review/input)**

*View*
`/resources/views/top.blade.php`

*Controller*
`App/Http/Controller/ReviewController::inputReview`  
リクエストの内容をModelへ送り、Modelの処理が成功した場合、成功または失敗をViewへ伝えるデータをセッションと共に`/home`へGETリクエストを送る。

*Model*
`App/Model/User/InputReview::input`  
一つの紹介記事に対するレビューがない場合、リクエストの情報をレビューの情報を扱うDBのテーブルへ新たに追加してtrueを返し、そうではない場合はfalseを返す。

**記事ごとのレビューの削除(POST /review/delete)**

*View*
`/resources/views/top.blade.php`

*Controller*
`App/Http/Controller/ReviewController::deleteReview`  
リクエストの内容をModelへ送り、Modelの処理が成功した場合、成功または失敗をViewへ伝えるデータをセッションと共に`/home`へGETリクエストを送る。

*Model*
`App/Model/User/DeleteReview::delete`  
一つの紹介記事に対するレビューがある場合、ユーザーごとの「いいね」の状態を扱うDBのテーブルのレコードから削除対象のレビューに対して「いいね」を付けたレコードをすべ
て削除したあと、リクエストの情報を含むレビューの情報を扱うDBのテーブルのレコードを削除してtrueを返し、そうではない場合はfalseを返す。

**良いレビューに「いいね」を付ける(POST /good/push)**

*View*
`/resources/views/top.blade.php`

*Controller*
`App/Http/Controller/GoodController::pushGood`  
リクエストの内容をModelへ送り、Modelの処理が成功した場合、成功または失敗をViewへ伝えるデータをセッションと共に`/home`へGETリクエストを送る。

*Model*
`App/Model/User/PushGood::push` 
リクエストが正規ユーザーからであるかつ「いいね」を付けるレビューが存在する場合、ユーザーごとの「いいね」の状態を扱うDBのテーブルにリクエストの内容を追加し、
レビューをの情報を扱うDBのテーブルのレコードのうち、「いいね」を付ける対象のレコードの「いいね数」の項目に記されたデータに1を加算し、trueを返す。
もしリクエストが正規のユーザーからではない、または「いいね」を付ける対象のレコードが存在しない場合は何もせずfalseを返す。

**レビューにつけた「いいね」を取り消す(POST /good/delete)**

*View*
`/resources/views/top.blade.php`

*Controller*
`App/Http/Controller/GoodController::deleteGood`  
リクエストの内容をModelへ送り、Modelの処理が成功した場合、成功または失敗をViewへ伝えるデータをセッションと共に`/home`へGETリクエストを送る。

*Model*
`App/Model/User/deleteGood::delete`  
リクエストが正規ユーザーからであるかつ「いいね」を取り消す対象のレビューが存在する場合、ユーザーごとの「いいね」の状態を扱うDBのテーブルにリクエストの内容を追加し
、レビューをの情報を扱うDBのテーブルのレコードのうち、「いいね」を取り消す対象のレコードの「いいね数」の項目に記されたデータに1を減算し、trueを返す。
もしリクエストが正規のユーザーからではない、または「いいね」を削除する対象のレコードが存在しない場合は何もせずfalseを返す。

**ユーザーの情報を表示する(GET /review-page/user?google_user_id)**

*View*
`/resources/views/top.blade.php`  

*Controller*
`App/Http/Controller/ReviewPageController::outputUserInfo`  
リクエストの内容をModelへ送り、Modelの処理の結果を返す。

*Model*
`App/Model/User/UserInfo::output`  
ユーザーの情報を扱うDBのテーブルからリクエストの値を含むレコードのデータをjson形式で返す。

# データベースの構造
こちらではこのアプリケーションで使用しているデータベースの構造を紹介します。

### contributes(映画の紹介記事を記録するデータベース)

|Field |Type |Null |Key |Default |Extra |
|----|----|----|----|----|----|
|id|bigint(20) unsigned|NO|PRI|NULL|auto_increment|
|titile|varchar(255)|NO||NULL||
|contents|text|NO||NULL||
|picture|varchar(255)|NO||NULL||
|genre|varchar(255)|NO||NULL||
|satisfaction|double(5,2)|NO||NULL||
|recommended|double(5,2)|NO||NULL||
|created_at|timestamp|YES||NULL||
|updated_at|timestamp|YES||NUL||


### google_users(アカウントを作成したユーザーのデータを記録するデータベース)
|Field |Type |Null |Key |Default |Extra |
|----|----|----|----|----|----|
|id|bigint(20) unsigned|NO|PRI|NULL|auto_increment|
|gmail|varchar(255)|NO||NULL||
|name|varchar(255)|NO||NULL||
|profile|text|NO||NULL||
|icon|varchar(255)|NO||NULL||
|best|varchar(255)|NO||NULL||
|safety|tinyint(1)|NO||1||
|created_at|timestamp|YES||NULL||
|updated_at|timestamp|YES||NUL||


### user_reviews(ユーザーのレビューを記録するデータベース)
**contribute_id**は**contributes**テーブルの**id**、**google_user_id**は**google_users**テーブルの**id**に紐づいている。

|Field |Type |Null |Key |Default |Extra |
|----|----|----|----|----|----|
|id|bigint(20) unsigned|NO|PRI|NULL|auto_increment|
|contribute_id|bigint(20) unsigned|NO|MUL|NULL|auto_increment|
|google_user_id|bigint(20) unsigned|NO|MUL|NULL|auto_increment|
|titile|varchar(255)|NO||NULL||
|review|text|NO||NULL||
|spoiler|varchar(255)|NO||NULL||
|satisfaction|double(5,2)|NO||NULL||
|recommended|double(5,2)|NO||NULL||
|good_point|int(10) unsigned|NO||0||
|created_at|timestamp|YES||NULL||
|updated_at|timestamp|YES||NUL||


### good_points(ユーザーのレビューに対する反応を記録するデータベース)
**google_user_id**は**google_users**テーブルの**id**、**user_review_id**は**user_reviews**テーブルの**id**に紐づいている。

|Field |Type |Null |Key |Default |Extra |
|----|----|----|----|----|----|
|id|bigint(20) unsigned|NO|PRI|NULL|auto_increment|
|google_user_id|bigint(20) unsigned|NO|MUL|NULL|auto_increment|
|user_review_id|bigint(20) unsigned|NO|MUL|NULL|auto_increment|
|created_at|timestamp|YES||NULL||
|updated_at|timestamp|YES||NUL||

