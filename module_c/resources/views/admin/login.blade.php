@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <h1>Login</h1>
    <form action="" method="POST">
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input name="username" type="text" class="form-control" id="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input name="password" type="password" class="form-control" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        @if ($errors->has('login'))
        <span class="text-danger">{{ $errors->first('login') }}</span>
        @endif
      </form>
</div>
    
@endsection