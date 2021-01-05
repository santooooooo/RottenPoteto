# このアプリケーションの構造
こちらでは、このアプリケーションに使用されているツールの紹介と、アプリケーションの機能ごとの各ファイルの役割を**View、Controller、Model**に分けてまとめています。


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
リクエストのデータと規定値を比べ、ひとしい場合は`/resources/views/contribute.blade.php`へ移動し、そうではない場合は`/adminer`へリダイレクトされる。

*Model*
なし

**映画の紹介記事の作成(POST /contribute)**

*View*
`/resources/views/contribute.blade.php`  

*Controller*
`App/Http/Controller/Contribute::record`  
リクエストををModelへ送り、Modelの結果のメッセージと共に`/adminer`へGETリクエストを送る。

*Model*
`App/Model/Contribute/Input::writeDB()`  
リクエストの内容をDB(‘contributes’)へ登録＋画像ファイルの保存

### ユーザー側の機能

**アカウントの作成**
*View*
*Controller*
*Model*

**アカウントのログイン**
*View*
*Controller*
*Model*

**アカウントの削除**
*View*
*Controller*
*Model*

**ログアウト**
*View*
*Controller*
*Model*

**自分のアカウント情報の編集**
*View*
*Controller*
*Model*

**記事一覧の表示**
*View*
*Controller*
*Model*

**記事ごとの情報とそれに対するレビューの一覧表示**
*View*
*Controller*
*Model*

**レビューの投稿者の情報の表示**
*View*
*Controller*
*Model*

**記事ごとのレビューの作成**
*View*
*Controller*
*Model*

**記事ごとのレビューの削除**
*View*
*Controller*
*Model*

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
