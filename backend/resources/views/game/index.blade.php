@extends('layouts.admin')

@section('title', 'Games')

@section('content')
    <h1>Games</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Author</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($games as $game)
            <tr>
                <th scope="row">
                <a href="{{url('/game/'.$game->slug)}}">  
                  {{$game->title}}
                  @if ($game->trashed())
                    <span>(deleted)</span>
                  @endif
                </a>
                </th>
                <td>{{ $game->gameAuthor->username }}</td>
                <td>
                  @if (!$game->trashed())
                    <form action="{{ url('/game/'.$game->slug) }}" method="post">
                      @csrf
                      <input type="hidden" name="_method" value="delete">
                      <button type='submit'>Delete</button>
                    </form>
                  @endif
                </td>
            </tr>
            @endforeach
            
        </tbody>
      </table>
@endsection