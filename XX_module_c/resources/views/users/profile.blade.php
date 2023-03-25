@extends('layouts.index')

@section('title', 'Profile')

@section('content')
<p>Username: {{ $platformUser->username }}</p>
<p>Created: {{ $platformUser->created_at }}</p>
<p>Status: {{ $platformUser->is_blocked ? 'Blocked' : 'Active' }}</p>
@if ($platformUser->is_blocked)
    <p>Reason: {{$platformUser->block_reason}}</p>    
@endif
<!-- Add more user details here -->
@endsection