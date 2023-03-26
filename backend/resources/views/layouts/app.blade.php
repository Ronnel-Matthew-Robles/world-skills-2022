<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Gaming Portal</title>
    <link rel="stylesheet" href="{{ url('/public/css/bootstrap.min.css') }}">
</head>
<body>
    @yield('content')
    <script src="{{ url('/public/js/bootstrap.bundle.js') }}"></script>
</body>
</html>