<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">
<h1>Success!</h1>

@if (session('message'))
{{session('message')}}
@endif

</div>
<script></script>
</body>
</html>
