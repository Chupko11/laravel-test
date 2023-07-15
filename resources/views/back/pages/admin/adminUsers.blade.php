@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin users')
@section('content')
@foreach ($users as $user)
    <div class="card">
        <div class="card-body">

            <h1 class="card-title">
                <span class="avatar avatar-sm" style="background-image: url('{{$user ? asset('storage/' . $user->picture) : ''}}')"></span>
                {{ $user->name }}
            </h1>
            <form method="post" action="{{ route('author.deleteUser',['id'=>$user->id])}}">
                @csrf
                @method('DELETE')
                <button type="submit" style="float: right" class="btn btn-primary">Delete user</button>
            </form>
        </div>
    </div>
@endforeach

@endsection
