@extends('layouts.admin')
@section('title', $game->title)
@section('content')
<table class="table">
    <tbody>
      <tr>
        <th>Title</th>
        <td>{{$game->title}}</td>
     </tr>
     <tr>
        <th>Description</th>
        <td>{{$game->description}}</td>
     </tr>
     <tr>
        <th>Author</th>
        <td>{{$game->gameAuthor->username}}</td>
     </tr>
     <tr>
        <th>Created At</th>
        <td>{{$game->created_at}}</td>
     </tr>
    </tbody>
  </table>    

  <h2>Scores</h2>
  @foreach ($game->versions as $version)
      <h3>Version {{$version->version}}</h3>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Score</th>
            <th scope="col">Player</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($version->scores as $score)
          @if ($score->user)
          <tr>
            <td>{{$score->score}}</td>
            <td>{{$score->user->username}}</td>
            <td></td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
  @endforeach
@endsection