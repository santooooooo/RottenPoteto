<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ロッテンポテト</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="storage/home/potatoIcon">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div id="app">

@if (session('user'))
<div :value="user = {{session('user')}}"></div>
@endif

@if (session('message'))
<div :value="message = {{session('message')}}"></div>
@endif

<div class="header">
<router-link to="/">
<img src="storage/home/potatoTop">
</router-link>
<div>
<login :user-info='user'></login>
</div>
</div>

<nav>
<router-link to="/">Top</router-link>
<router-link to="/contribute">映画一覧</router-link>
</nav>
<router-view :user-info='user'></router-view>
</div>


<style>

p,a,h1,h2,input {
 color: white;
}

body {
 background-color: black;
}

.header {
 display: flex;
 justify-content: space-between;
 margin: 30px 3%;
}
.header img {
 width: 40%;
}
.header div {
 width: 80%;
}

nav {
 width: 60%;
 margin: 0 auto;
 display: flex;
 justify-content: space-between;
}
nav a {
 padding: 5px 5%;
 border: solid 3px yellow;
 border-radius: 10px;
 color: yellow;
}
nav a:hover {
 color: black;
 background-color: yellow;
}

</style>


<script src="{{ asset('/js/app.js') }}"></script>
<script>
$('body').on('submit', 'form', function () {
	$(this).append('@csrf')
});
</script>


</body>
</html>
