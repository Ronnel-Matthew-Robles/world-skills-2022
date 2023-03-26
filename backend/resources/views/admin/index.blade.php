@extends('layouts.admin')

@section('title', 'Admin Users')

@section('content')
    <h1>Admin Users</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Username</th>
            <th scope="col">Created At</th>
            <th scope="col">Last Login At</th>
          </tr>
        </thead>
        <tbody>
          
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{$user->username}}</th>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->last_login_at }}</td>
            </tr>
            @endforeach
            
        </tbody>
      </table>
@endsection