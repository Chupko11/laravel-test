@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Delete tags')
@section('content')
@foreach ($tags as $tag)
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                <a href="{{ route('author.showTagsPosts', $tag->id) }}">{{ $tag->name }}</a>
            </h1>
            <form method="post" action="{{ route('author.deleteTag', ['id' => $tag->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" style="float: right" class="btn btn-primary">Delete tag</button>
            </form>
        </div>
    </div>
@endforeach

@endsection
