@extends(auth()->check() ? 'back.layouts.pages-layout' : 'back.layouts.pages-layout-guest')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin comments')

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <h4 class="text-center">Comments</h4>
        <hr>
        @foreach ($comments as $comment)
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
                    <span class="text-muted ml-2">{{ $comment->likes_count }}</span>
                </form>



                @if (auth()->user()->is($comment->user))
                <div class="d-flex justify-content-end">
                    <form method="post" action="{{ route('author.deleteCommentsAdmin', ['id' => $comment->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mr-2">Delete Comment</button>
                    </form>
                </div>

            @endif
            @endif
            </div>
        </div>

        @endforeach
    </div>
</div>
@endsection

