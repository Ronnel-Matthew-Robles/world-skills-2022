@extends('layouts.admin')
@section('title', 'Games')
@section('content')
<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($games as $game)
            <tr>
                <td>
                    <a href="{{ url('/game/'.$game->slug) }}">
                        {{ $game->title }}
                    </a>
                    @if($game->trashed())
                        <span class="badge bg-danger">deleted</span>
                    @endif
                </td>
                <td>{{ $game->gameAuthor->username }}</td>
                <td>
                    @if(!$game->trashed())
                        <form method="POST" action="{{ url('/game/'.$game->slug) }}">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
