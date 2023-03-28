<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Game Portal</title>
    <link rel="stylesheet" href="{{ url('/css/bootstrap.css')}}">
</head>
<body>
    @yield('content')
    <script src="{{url('/js/bootstrap.js')}}"></script>
</body>
</html>