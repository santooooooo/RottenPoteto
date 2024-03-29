<html lang="ja">

<head>
<meta charset="UTF-8">
<title>ロッテンポテト</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:url" content="https://talk-cinema.net">
<meta property="og:type" content="website">
<meta property="og:title" content="ロッテンポテト">
<meta property="og:description" content="気軽に映画の話でもしませんか?">
<link rel="icon" href="storage/home/potatoIcon">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div id="app">

@if (session('user'))
<div :value="user = {{session('user')}}"></div>
@endif

<div :value="csrf_token = {{json_encode(csrf_token())}}"></div>

<div class="header">
<router-link to="/">
<img src="storage/home/potatoTop">
</router-link>
<div>
<login :user-info='user' :csrf-token='csrf_token'></login>
</div>
</div>

<nav>
<router-link to="/">Top</router-link>
<router-link to="/contribute">映画一覧</router-link>
</nav>
<router-view :user-info='user' :csrf-token='csrf_token'></router-view>
</div>


<style>

p,a,h1,h2, h3 {
 color: white;
}
a {
 text-decoration: none;
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
@media screen and (max-width:480px) {
 .header {
   display: unset;
   margin: 30px 3%;
 }
 .header a {
  width:;
 }
.header img {
  width: 90%;
 }
.header div {
  width: 90%;
  margin: 0 auto;
 }
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


</body>
</html>
