<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Admin Portal</title>
    <link rel="stylesheet" href="{{ url('/public/css/bootstrap.min.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Admin Portal</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link" aria-current="page" href="{{route('admin.users')}}">Admin Users</a>
              <a class="nav-link" href="{{route('user.index')}}">Platform Users</a>
              <a class="nav-link" href="{{route('game.index')}}">Games</a>
            </div>
          </div>
        </div>
      </nav>

      @yield('content')
      <script src="{{ url('/public/js/bootstrap.bundle.js') }}"></script>
</body>
</html>