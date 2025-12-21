<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hotel TV</title>
    <link rel="stylesheet" href="{{ asset('/css/tv.css') }}">
</head>
<body>

<div class="container">
    @yield('content')
</div>

<script src="{{ asset('/js/remote.js') }}"></script>
</body>
</html>
