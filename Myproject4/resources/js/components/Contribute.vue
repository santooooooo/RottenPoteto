<template>
<div>
<h1>投稿フォーム</h1>
<form action="/contribute" method="post" enctype="multipart/form-data">
<p>タイトル</p>
<input type="text" name="title">
<p>内容</p>
<textarea name="contents" rows="5" cols="50"></textarea>
<p>画像</p>
<input type="file" name="picture">
<p>ジャンル</p>
<select name="genre">
<option value="アニメ">アニメ</option>
<option value="アクション">アクション</option>
<option value="アドベンチャー">アドベンチャー</option>
<option value="SF">SF</option>
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
<input id="submit" type="submit" value="投稿">
</form>
</div>
</template>

<script>

</script>
