@extends('layouts.index')

@section('title', 'Games')

@section('content')
    <h1>Games</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach($games as $game)
                <tr>
                    <td>{{ $game->id }}</td>
                    <td>{{ $game->title }}</td>
                    <td>{{ $game->description }}</td>
                    <td>{{ $game->status }}</td>
                    <td><a href="{{route('admin.games.profile', ['slug'=>$game->slug])}}">View Profile</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection