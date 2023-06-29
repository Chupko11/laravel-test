@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Show Posts')
@section('content')

@foreach ($posts as $post)
@if ($post->user_id === auth()->user()->id)

<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title"><a href="{{ route('author.postsDisplay', $post->id) }}" class="text-decoration-none text-dark">{{ $post->title }}</a></h5>
        @if ($post->cover_image)
        <img src="{{ asset('/storage' . $post->cover_image) }}" alt="Cover image" class="card-img-top" style="max-width:20%; max-height:20%; display: block; margin-left: auto; margin-right: auto;">
        @endif
        <p class="card-text">{{ $post->body }}</p>
        <p class="card-text">Author: {{ $post->user->name }}</p>
        <p class="card-text">
            @foreach ($post->tags as $tag)
            <span class="badge badge-primary">{{ $tag->name }}</span>
            @endforeach
        </p>

        <div class="d-flex justify-content-end">
            <form method="post" action="{{ route('author.deletePost', ['id' => $post->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mr-2">Delete Post</button>
            </form>

            <form method="post" action="{{ route('author.updatePost', ['id' => $post->id]) }}">
                @csrf
                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </div>
</div>

@endif
@endforeach

<div class="card align-items-center">
    {{ $posts->links() }}
</div>
@endsection
