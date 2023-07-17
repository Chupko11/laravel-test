@extends(auth()->check() ? 'back.layouts.pages-layout' : 'back.layouts.pages-layout-guest')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Display post')

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <h1 class="card-title mb-4">{{ $post->title }}</h1>
        @if ($post->cover_image)
            <img src="{{ asset('/storage' . $post->cover_image) }}" alt="Cover image" class="card-img-top mb-4" style="max-width: 100%; display: block; margin: 0 auto;">
        @endif

        @if(auth()->check())

        <?php
        $hasUserLiked = $post->hasUserLiked()
        ?>
        <form method="POST" action="{{ $hasUserLiked ?
            route('author.post.unlike', $post->id) :
            route('author.post.like', $post->id) }}"
            >
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm ml-2">{{ $hasUserLiked ? 'Dislike' : 'Like' }}</button>
            <span class="text-muted ml-2">{{ $post->likes_count }}</span>
        </form>
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
                <style>
                    .btn-outline-secondary {
                    color: #6c757d;
                    border-color: #6c757d;
                	}

                    .btn-outline-secondary:hover {
                        color: #fff;
                        background-color: #6c757d;
                        border-color: #6c757d;
                    }
                </style>

                @if(auth()->check())
                <?php
                $hasUserLiked = $comment->hasUserLiked()
                ?>
                <form method="POST" action="{{ $hasUserLiked ?
                    route('author.comments.unlike', $comment->id) :
                    route('author.comments.like', $comment->id) }}"
                    >
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm ml-2">{{ $hasUserLiked ? 'Dislike' : 'Like' }}</button>
                    {{-- <span class="text-muted ml-2">{{ $comment->like() }}</span> --}}
                    <span class="text-muted ml-2">{{ $comment->likes_count}}</span>
                </form>



                @if (auth()->user()->is($comment->user))
                <div class="d-flex justify-content-end">
                    <form method="post" action="{{ route('author.deleteComment', ['id' => $comment->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mr-2">Delete Comment</button>
                    </form>

                    <form>
                        @csrf
                        <button type="button" class="btn btn-primary" onclick="showUpdateForm('{{ $comment->id }}')">Update Comment</button>
                    </form>
                </div>
                    <script>
                    function showUpdateForm(commentId) {
                        const updateForm = document.getElementById(`updateComment${commentId}`);
                        if (updateForm.style.display === 'block') {
                        updateForm.style.display = 'none';
                        } else {
                        updateForm.style.display = 'block';
                        }
                    }
                </script>


                <div id="updateComment{{ $comment->id }}" style="display: none;">
                    <form method="post" action="{{ route('author.updateComment', ['id' => $comment->id]) }}">
                        @csrf
                        <textarea name="content" class="form-control" rows="4" placeholder="Update your comment" required>{{ $comment->content }}</textarea>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>


            @endif
            @endif
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

