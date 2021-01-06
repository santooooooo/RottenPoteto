# このアプリケーションの構造
こちらでは、このアプリケーションに使用されているツールの紹介と、アプリケーションの機能ごとの各ファイルの役割を**View、Controller、Model**に分けてまとめています。  
このアプリケーションの**View、Controller、Model**の定義は以下のようになっています。  

*View* データの入力を行ったり、Controllerから送られてきたデータを表示する。

*Controller* Viewから送られてきたリクエスト情報を機能に沿って処理し、結果をViewへ送る。処理の際、場合によってModelを使用する。

*Model* Controllerによって実行される。DBの処理やAPIの利用などによりコードが複雑化する場合にそれらの処理を担う。


## 使用しているツール

|ツール|バージョン|
|------|------|
|php|7.4|
|composer|1.10.5|
|npm|3.5.2|
|Laravel|7.12.0|
|Vue|2.6.11|


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
`App/Model/Contribute/Input::writeDB()`  
リクエストの内容を映画のレビュー情報を扱うDBのテーブルへ登録＋画像ファイルの保存

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
もし新規のユーザーであれば`signUp`で新規登録とそのユーザーのデータを返し、既存のユーザーであれば`siginIn`でそのユーザーのデータを返す。

**アカウントの削除(POST /signout)**

*View*
`/resources/views/top.blade.php`

*Controller*
`App/Http/Controller/UsersController::userSignOut`  
Modelを実行し、`/home`へGETリクエストを送りトップ画面へ戻る。

*Model*
`App/Model/User/SignOut::signOut`  
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
一つの紹介記事に対するレビューがある場合、リクエストの情報を含むレビューの情報を扱うDBのテーブルのレコードを削除してtrueを返し、そうではない場合はfalseを返す。

**良いレビューに「いいね」を付ける**
*View*
*Controller*
*Model*

**レビューにつけた「いいね」を取り消す**
*View*
*Controller*
*Model*

**ユーザーが自身のアカウント内容を変更する際に、それまでの内容を表示する**
*View*
*Controller*
*Model*
