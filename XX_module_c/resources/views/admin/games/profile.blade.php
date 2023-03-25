@extends('layouts.index')

@section('title', 'Game Profile')

@section('content')
<p>Title: {{ $game->name }}</p>
<p>Author: {{ $game->game_author->username }}</p>
<p>Description: {{ $game->created_at }}</p>
@if ($game->thumbnail)
    <img src="{{$game->thumbnail}}" alt="" srcset="">
    
@endif
<p>Status: {{ $game->status }}</p>

<form action="{{ route('admin.games.reset', ['slug' => $game->slug]) }}" method="POST">
    @csrf
    <button type="submit">Reset Hightscores</button>
    
</form>

<h2>Versions</h2>
    <ul>
        @foreach($versions as $version)
            <li><a href="{{ route('admin.games.profile', ['slug' => $game->slug, 'version_id' => $version->id]) }}">{{ $version->version }}</a></li>
        @endforeach
    </ul>

    <h2>Scores</h2>
    @if ($scores)
    <table>
        <thead>
            <tr>
                <th>Player</th>
                <th>Version</th>
                <th>Score</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($scores as $score)
                <tr>
                    <td>{{ $score->player->username }}</td>
                    <td>{{ $score->version->version }}</td>
                    <td>{{ $score->score }}</td>
                    <td>
                        <form action="{{route('admin.games.delete.player.score', ['slug'=> $game->slug,'score_id'=>$score->id])}}" method="post">
                            @csrf
                            <button type="submit">Delete Score</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('admin.games.delete.all.player.scores', ['slug'=>$game->slug, 'player_id'=>$score->player->id])}}" method="post">
                            @csrf
                            <button type="submit">Delete Scores of Player</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>No scores yet.</p>
    @endif
    
@endsection