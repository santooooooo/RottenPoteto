<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h1>投稿フォーム</h1>
<form action="/contribute" method="post" enctype="multipart/form-data">
@csrf
<p>タイトル</p>
<input type="text" name="title">
<p>内容</p>
<input type="text" name="contents">
<p>画像</p>
<input type="file" name="picture">
<input type="submit" value="投稿">
</form>
</body>
</html>
