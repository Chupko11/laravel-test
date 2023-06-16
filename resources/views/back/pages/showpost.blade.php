@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Show Posts')
@section('content')

@foreach ($posts as $post)
@if ($post->user_id === auth()->user()->id)


<div class="card">
	<div class="card-body">
        <h1 class="card-title">{{ $post->title }}</h1>
        @if ($post->cover_image)
        <img src="{{ asset('/storage' .$post->cover_image) }}" alt="Cover image" class="card-img-top" style="width:auto; height:auto;">
        @endif
        <p class="card-text">{{ $post->body }}</p>
        <p class="card-text">Author: {{ $post->user->name }}</p>
        <p class="card-text">
            @foreach ($post->tags as $tag)
            {{ $tag->name }}
            @endforeach

        </p>

        <form method="post"  action="{{ route('author.deletePost', ['id' => $post->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" style="float: right" class="btn btn-primary ">Delete post</button>
        </form>

        <form method="post" action="{{ route('author.updatePost', ['id' => $post->id]) }}">
            @csrf
            <button type="submit" style="float: right" class="btn btn-primary ">Update post</button>
        </form>
        </div>
	</div>
@endif
@endforeach

<div class="card align-items-center">
{{ $posts->links() }}
</div>
@endsection
