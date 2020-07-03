<template>
	<div class="main">

		<div class="picture">
			<img src="storage/home/potatoMain">
		</div>

		<div class="section">
			<h2>ここはどのようなところなの？</h2>
			<p>当サイトは<span>映画のレビューサイト</span>です。</p>
			<p>当サイトを管理する人が最近見た映画を紹介していくので、
			その映画についてのレビューをご自由にお書きください。</p>
		</div>

		<div class="section">
			<h2>ここで何ができるの？</h2>
			<h3>レビュワーの方</h3>
			<p>1.紹介された映画に対するみんなのレビューが見れる。</p>
			<p>2.当サイトのレビュワーの方は、映画一覧で紹介している映画のレビューが書ける。</p>
			<p>3.自分が良いなと思ったレビューに対してポテトを送ることができる。</p>
			<p>(ポテトとは、SNSでいう「いいね」みたいなものです。送るときっと相手も喜びます)</p>
			<p>4.管理する人が直々に描いたポテトのイラストが楽しめる。</p>
			<h3>レビュワーではない方</h3>
			<p>1.紹介された映画に対するもんなのレビューが見れる。</p>
			<p>2.管理する人が直々に描いたポテトのイラストが楽しめる。</p>
		</div>

		<div class="section">
				<h2>レビュワーになるには？</h2>
				<p>当サイトの右上にある<span>「新規登録orログイン」</span>ボタンを押すとGoogleアカウントの
				認証画面が表示され、その認証が通るとレビュワーとなれます。</p>		
		</div>

		<div class="section">
			<h2>皆さんが気持ちよく利用するために</h2>
			<p>当サイトへレビューを書くに当たり、以下のことをお守りください。</p>
			<p>1.映画に関係ない方々の誹謗中傷</p>
			<p>2.紹介している映画とは全く関係ない書き込み</p>
			<p>3.その他当サイトの利用者を不快にさせる書き込み</p>
			<p>上記の３点のいずれかが守られていないと管理者が判断した方はレビューができなります。</p>
			<p>当サイトが良いものになるようにご協力お願いします。</p>
		</div>

		<div class="section">
			<h2>管理する人へ何か言いたい場合</h2>
			<p>このサイトに関する疑問等がある際は、管理する人のtwitterのアカウントへDM送ってください。</p>
			<p>また、このアカウントでは当サイトに関することを色々とつぶやいているので覗いてみてください。</p>
			<a href="https://twitter.com/RottemPotato">twitterはこちら！</a>
		</div>

	</div>
</template>

<style scoped>

.main {
	width: 90%;
	margin: 0 auto;
}

.picture img {
	width: 90%;
	margin: 30px 0;
}

.section {
	margin: 70px 0;
}
.section h2 {
	width: 60%;
	margin: 30px 0;
	padding: 5px;
	color: black;
	background-color: orange;
	border-radius: 20px;
}
.section h3 {
	margin: 20px 0;
}
.section span {
	color: yellow;
}
.section a {
	color: cyan;
	background-color: black;
	border: solid 3px cyan;
	border-radius: 10px;
	text-decoration: none;
}
.section a:hover {
	color: black;
	background-color: cyan;
}

</style>

<script>

</script>
