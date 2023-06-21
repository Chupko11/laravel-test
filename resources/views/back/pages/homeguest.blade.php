@extends('back.layouts.pages-layout-guest')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'HomeGuest')
@section('content')
<div style="position: relative; height: 500px; overflow: hidden;">
    <img src="{{ asset('back/heroImage.jpg') }}" alt="Hero Image" style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
</div>

<div class="row">
    @foreach ($posts as $post)
    <div class="col-md-4">
    <div class="card mb-3">

            @if ($post->cover_image)
            <img src="{{ asset('/storage' .$post->cover_image) }}" alt="Cover image" class="card-img-top" style="object-fit: cover;">
            @endif
            <div class="card-body">
            <a href="{{ route('author.postsDisplay', $post->id) }}" class="card-title">{{ $post->title }}</a>
            <p class="card-text">{{Str::limit($post->body, 100)  }}</p>
            <p class="card-text">Author: {{ $post->user->name }}</p>
            <p class="card-text">Tags:
                @foreach ($post->tags as $tag)
                {{ $tag->name }}
                @endforeach
            </p>
    </div>
    </div>
    </div>

    @endforeach
    </div>
    <div class="card align-items-center">
    {{ $posts->links() }}
    </div>
    @endsection
