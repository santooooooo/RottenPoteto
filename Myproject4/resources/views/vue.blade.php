<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">
<h1>Jamboo!</h1>
<example-component></example-component>
<login></login>
</div>

<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
