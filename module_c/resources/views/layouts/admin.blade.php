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
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Admin Portal</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.index')}}">Admin Users</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('user.index')}}">Platform Users</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('game.index')}}">Games</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    @yield('content')
    <script src="{{url('/js/bootstrap.bundle.js')}}"></script>
</body>
</html>