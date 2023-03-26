@extends('layouts.admin')

@section('title', 'Admin Users')

@section('content')
    <h1>Platform Users</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Username</th>
            <th scope="col">Created At</th>
            <th scope="col">Last Login At</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">
                <a href="{{url('/user/'.$user->id)}}">  
                  {{$user->username}}
                </a>
                </th>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->last_login_at }}</td>
                <td>
                  @if ($user->trashed())
                    <form action="{{ url('/user/'.$user->id.'/unlock') }}" method="post">
                      @csrf
                      <button type='submit'>Unlock</button>
                    </form>
                  @else
                    <form action="{{url('/user/'.$user->id.'/lock')}}" method="post">
                      @csrf
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Lock
                        </button>
                        <ul class="dropdown-menu">
                          <li><button type='submit' name='reason' value="spamming">Spamming</button></li>
                          <li><button type='submit' name='reason' value="cheating">Cheating</button></li>
                          <li><button type='submit' name='reason' value="other">Other</button></li>
                        </ul>
                      </div>
                    </form>
                  @endif
                </td>
            </tr>
            @endforeach
            
        </tbody>
      </table>
@endsection