@extends('layouts.index')

@section('title', 'Platform Users')

@section('content')
<h1>Platform Users</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Created At</th>
            <th>Last Login</th>
            <th>Status</th>
            <th>Block Reason</th>
            <th>Link</th>
            <th>Actions</th>
            <th>Reason</th>
        </tr>
    </thead>
    <tbody>
        @foreach($platformUsers as $platformUser)
            <tr>
                <td>{{ $platformUser->id }}</td>
                <td>{{ $platformUser->username }}</td>
                <td>{{ $platformUser->created_at }}</td>
                <td>{{ $platformUser->last_login_at }}</td>
                <td>{{ $platformUser->is_blocked ? 'Blocked' : 'Active' }}</td>
                <td><a href="{{route('platform.user.profile', ['username'=>$platformUser->username])}}">View Profile</a></td>
                
                    @if($platformUser->is_blocked)
                    
                        <form action="{{ route('platform.users.unblock', ['username' => $platformUser->username]) }}" method="POST">
                            @csrf
                            <td>
                                <button type="submit">Unblock</button>
                            </td>
                            
                        </form>
                    @else
                        <form action="{{ route('platform.users.block', ['username' => $platformUser->username]) }}" method="POST">
                            @csrf
                            <td>
                                <button type="submit">Block</button>
                            </td>
                            <td>
                                <select name='block_reason'>
                                    <option value="You have been blocked by an administrator">You have been blocked by an administrator</option>
                                    <option value="You have been blocked for spamming">You have been blocked for spamming</option>
                                    <option value="You have been blocked for cheating">You have been blocked for cheating</option>
                                </select>
                            </td>
                        </form>
                    @endif    
                
                @if($platformUser->is_blocked)

                    <td>{{ $platformUser->block_reason }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@endsection