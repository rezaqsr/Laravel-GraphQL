<!doctype html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel + VueJS + GraphQL</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js', 'resources/js/Bootstrap.js'])
</head>
<body>
<div id="app"></div>
</body>
</html>
