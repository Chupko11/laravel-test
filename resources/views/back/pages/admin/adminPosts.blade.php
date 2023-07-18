@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin posts')
@section('content')
@foreach ($posts as $post)
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title"><a href="{{ route('author.postsDisplay', $post->id) }}" class="text-decoration-none text-dark">{{ $post->title }}</a></h5>
        @if ($post->cover_image)
        <img src="{{ asset('/storage' . $post->cover_image) }}" decoding="async" loading="lazy" alt="Cover image" class="card-img-top mb-3" style="max-width:20%; max-height:20%; display: block; margin-left: auto; margin-right: auto;">
        @endif
        <p class="card-text">{{ $post->body }}</p>
        <p class="card-text">Author: {{ $post->user->name }}</p>
        <p class="card-text">
            Tags:
            @foreach ($post->tags as $tag)
            <span class="badge badge-primary">{{ $tag->name }}</span>
            @endforeach
        </p>
        <form method="post" action="{{ route('author.deletePostAdmin', ['id' => $post->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mr-2">Delete Post</button>
        </form>
    </div>
</div>
@endforeach


@endsection
