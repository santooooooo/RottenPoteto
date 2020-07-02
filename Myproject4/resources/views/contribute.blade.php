<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h1>投稿フォーム</h1>
<form action="/contribute" method="post" enctype="multipart/form-data">
@csrf
<p>タイトル</p>
<input type="text" name="title" size="100">
<p>内容</p>
<textarea name="contents" rows="5" cols="50"></textarea>
<p>画像</p>
<input type="file" name="picture">
<p>ジャンル</p>
<select name="genre">
<option value="アニメ">アニメ</option>
<option value="アクション">アクション</option>
<option value="アドベンチャー">アドベンチャー</option>
<option value="S F">S F</option>
<option value="コメディ">コメディ</option>
<option value="サスペンス">サスペンス</option>
<option value="青春">青春</option>
<option value="戦争">戦争</option>
<option value="ドキュメンタリー">ドキュメンタリー</option>
<option value="ドラマ">ドラマ</option>
<option value="ファンタジー">ファンタジー</option>
<option value="ホラー">ホラー</option>
<option value="ミュージカル・音楽">ミュージカル・音楽</option>
<option value="恋愛">恋愛</option>
</select>
<input type="submit" value="投稿">
</form>

<h2>記事削除フォーム</h2>
<form action="/contribute/delete" method="post">
@csrf
<p>タイトル</p>
<input type="text" name="title" size="100">
<input type="submit" value="記事を削除する">
</form>
</body>
</html>
