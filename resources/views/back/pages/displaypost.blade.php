@extends(auth()->check() ? 'back.layouts.pages-layout' : 'back.layouts.pages-layout-guest')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Display post')

@section('content')
<div class="card">
    <div class="card-body">
        <h1>{{ $post->title }}</h1>
        @if ($post->cover_image)
        <img src="{{ asset('/storage' . $post->cover_image) }}" alt="Cover image" class="card-img-top" style="max-width:100%; max-height:100%; display:block; margin-left:auto; margin-right: auto;">
        @endif
        <p>{{ $post->body }}</p>
        <p>Author: {{ $post->user->name }}</p>
        <p>Tags:
            @foreach ($post->tags as $tag)
            {{ $tag->name }}
            @endforeach
        </p>
    </div>
</div>
@endsection
