<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">

@if (session('message'))
{{session('message')}}
@endif

<form action="/adminer" method="post">
@csrf
<input type="email" name="gmail">
<input type="password" name="password">
<input type="submit" value="認証">
</form>

</div>

</body>
</html>
