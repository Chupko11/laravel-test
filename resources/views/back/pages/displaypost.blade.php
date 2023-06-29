@extends(auth()->check() ? 'back.layouts.pages-layout' : 'back.layouts.pages-layout-guest')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Display post')

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <h1 class="card-title mb-4">{{ $post->title }}</h1>
        @if ($post->cover_image)
            <img src="{{ asset('/storage' . $post->cover_image) }}" alt="Cover image" class="card-img-top mb-4" style="max-width: 100%; display: block; margin: 0 auto;">
        @endif
        <p class="card-text">{{ $post->body }}</p>
        <p class="card-text">Author: {{ $post->user->name }}</p>
        <p class="card-text">Tags:
            @foreach ($post->tags as $tag)
                <span class="badge badge-primary">{{ $tag->name }}</span>
            @endforeach
        </p>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h4 class="text-center">Comments</h4>
        <hr>
        @foreach ($post->comments as $comment)
        <div class="media mb-4">
            <img src="{{ asset('storage/' . $comment->user->picture) }}" class="mr-3 rounded-circle" alt="User Avatar" style="width: 50px; height: 50px;">
            <div class="media-body">
                <h6 class="mt-0">{{ $comment->user->name }}</h6>
                <p>{{ $comment->content }}</p>
                <small class="text-muted">{{ $comment->created_at }}</small>
            </div>
        </div>
        @endforeach
    </div>
</div>


<div class="card mt-4">
    <div class="card-body">
        <h4 class="text-center">Add a Comment</h4>
        <form action="{{ route('author.createComment', $post->id) }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $post->user->id }}">
            <div class="form-group">
                <textarea name="content" class="form-control" rows="4" placeholder="Your comment" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </div>
        </form>
    </div>
</div>



@endsection
