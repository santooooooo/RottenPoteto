<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">
<h1>Jamboo!</h1>
<nav>
<router-link to="/">Example</router-link>
<router-link to="/login">Login</router-link>
</nav>
<router-view></router-view>
</div>

<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
