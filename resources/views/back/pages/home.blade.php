@extends('back.layouts.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')

@section('content')
<div class="hero-section">
    <img src="{{ asset('back/heroImage.jpg') }}" alt="Hero Image" style="border-radius: 10%;">
</div>

<h4 class="text-center">All posts</h4>
        <hr>
<div class="row">
    @foreach ($posts as $post)
        <div class="col-md-4">
            <div class="card mb-3">
                @if ($post->cover_image)
                    <div class="card-img-top">
                        <img decoding="async" loading="lazy" src="{{ asset('/storage' .$post->cover_image) }}" alt="Cover image">
                    </div>
                @endif
                <div class="card-body" style="border-radius: 20%;">
                    <h2 class="card-title">
                        <a href="{{ route('author.postsDisplay', $post->id) }}">{{ $post->title }}</a>
                    </h2>
                    <p class="card-text">{{ Str::limit($post->body, 100) }}</p>
                    <div class="author-info">
                        <p>By {{ $post->user->name }}</p>
                        <p class="tags">Tags:
                            @foreach ($post->tags as $tag)
                                <span class="badge badge-primary">{{ $tag->name }}</span>
                            @endforeach
                        </p>
                    </div>
                    <?php
                    $hasUserLiked = $post->hasUserLiked();
                    ?>
                    <form method="POST" action="{{ $hasUserLiked ?
                        route('author.post.unlike', $post->id) :
                        route('author.post.like', $post->id) }}"
                        >
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm ml-2">{{ $hasUserLiked ? 'Dislike' : 'Like' }}</button>
                        {{-- <span class="text-muted ml-2">{{ $comment->like() }}</span> --}}
                        <span class="text-muted ml-2">{{ $post->likes_count }}</span>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="pagination">
    {{ $posts->links() }}
</div>

@endsection
