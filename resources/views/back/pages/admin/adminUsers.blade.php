@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin users')
@section('content')
@foreach ($users as $user)
    <div class="card">
        <div class="card-body">

            <h1 class="card-title">
                <span class="avatar avatar-sm" style="background-image: url('{{$user ? asset('storage/' . $user->picture) : ''}}')"></span>

               <a href="{{ route('author.showUserDetails', ['id' => $user->id]) }}">{{ $user->name }}</a>
            </h1>
            <form method="post" action="{{ route('author.deleteUserAdmin',['id'=>$user->id])}}">
                @csrf
                @method('DELETE')
                <button type="submit" style="float: right" class="btn btn-primary">Delete user</button>
            </form>
        </div>
    </div>
@endforeach

@endsection
