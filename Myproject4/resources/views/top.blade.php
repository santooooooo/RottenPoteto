<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">

@if (session('user'))
<div v-bind:value="user = {{session('user')}}"></div>
@endif

<h1>Jamboo!</h1>
<login v-bind:user-info='user'></login>
<nav>
<router-link to="/">Example</router-link>
</nav>
<router-view></router-view>
</div>

<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
