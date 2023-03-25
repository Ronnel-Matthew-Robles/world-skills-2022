@extends('layouts.index')

@section('title', 'Admin Users')

@section('content')
    <h1>Admin Users</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Created At</th>
                <th>Last Login</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adminUsers as $adminUser)
                <tr>
                    <td>{{ $adminUser->id }}</td>
                    <td>{{ $adminUser->username }}</td>
                    <td>{{ $adminUser->created_at }}</td>
                    <td>{{ $adminUser->last_login_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection