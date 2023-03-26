@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h1>Login</h1>
    <form action="" method="post">
        @csrf 
        <label for="username">Username</label>
        <input type="text" name="username">
        <label for="password">Password</label>
        <input type="password" name="password">
        <button type="submit">Login</button>
        @if ($errors)
            <p>{{ $errors->first('login') }}</p>
            
        @endif
    </form>
@endsection