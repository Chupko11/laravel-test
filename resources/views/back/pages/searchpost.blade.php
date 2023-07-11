@extends(auth()->check() ? 'back.layouts.pages-layout' : 'back.layouts.pages-layout-guest')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Search post')

@section('content')
<div class="card-body">
    <div class="tab-content">
        <div class="tab-pane active show" id="tabs-details">
            <div>
                <form action="{{ route('author.postSearchPost') }}">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Search</label>
                                <input type="search" class="form-control" name="searchPost" placeholder="Enter text" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<hr>

<div>
    @if($posts->isEmpty())
    <p>No posts found.</p>
    @else
    @if(isset($authorName))
    <h3>Posts by {{ isset($authorName) }}</h3>
    @endif
    @foreach ($posts as $post)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"><a href="{{ route('author.postsDisplay', $post->id) }}" class="text-decoration-none text-dark">{{ $post->title }}</a></h5>
            @if ($post->cover_image)
            <img src="{{ asset('/storage' . $post->cover_image) }}" alt="Cover image" class="card-img-top mb-3" style="max-width:20%; max-height:20%; display: block; margin-left: auto; margin-right: auto;">
            @endif
            <p class="card-text">{{ $post->body }}</p>
            <p class="card-text">Author: {{ $post->user->name }}</p>
            <p class="card-text">
                Tags:
                @foreach ($post->tags as $tag)
                <span class="badge badge-primary">{{ $tag->name }}</span>
                @endforeach
            </p>

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
    @endforeach
</div>

{{-- <div class="card align-items-center">
    @if (isset($search))
    {{ $posts->appends(['searchPost' => $authorName])->links() }}
    @else
    {{ $posts->links() }}
    @endif
</div> --}}
@endif

@endsection
