@extends('layouts.admin')
@section('title', $user->username)
@section('content')
<h1>{{$user->username}}</h1>    
@endsection