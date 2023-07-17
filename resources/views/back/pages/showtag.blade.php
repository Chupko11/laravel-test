@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Show tags')
@section('content')
@foreach ($tags as $tag)
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                <a href="{{ route('author.showTagsPosts', $tag->id) }}">{{ $tag->name }}</a>
            </h1>
        </div>
    </div>
@endforeach

@endsection
