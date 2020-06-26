<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">

@if (session('user'))
<div :value="user = {{session('user')}}"></div>
@endif

@if (session('message'))
<div :value="message = {{session('message')}}"></div>
@endif

<h1>Jamboo!</h1>
<login :user-info='user'></login>
<nav>
<router-link to="/contribute">Example</router-link>
</nav>
<router-view :user-info='user'></router-view>
</div>

<script src="{{ asset('/js/app.js') }}"></script>
<script>
$('body').on('submit', 'form', function () {
	$(this).append('@csrf')
});
</script>
</body>
</html>
