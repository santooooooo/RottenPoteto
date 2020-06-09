<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="adminerApp">
<h1>Success!</h1>

<nav>
<router-link to="/contribute">投稿フォームへ</router-link>
<router-link to="/controll-users">ユーザー管理ページへ</router-link>
</nav>
<router-view></router-view>

</div>
<script src="{{ asset('/js/app.js') }}"></script>
<script>

$('body').on('submit', 'form', function () {
	$(this).append('@csrf')
});

</script>
</body>
</html>
