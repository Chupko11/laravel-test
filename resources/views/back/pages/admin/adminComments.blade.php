@extends(auth()->check() ? 'back.layouts.pages-layout' : 'back.layouts.pages-layout-guest')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin comments')

@section('content')
<div class="card mt-4">
    <div class="card-body">
        <h4 class="text-center">Comments</h4>
        <hr>
        @foreach ($comments->where('parent_id', null) as $comment)

        <div class="media mb-4">
                <img src="{{ asset('storage/' . $comment->user->picture) }}" class="mr-3 rounded-circle" alt="User Avatar" style="width: 50px; height: 50px;">
                <div class="media-body">
                    <h6 class="mt-0">{{ $comment->user->name }}</h6>
                    <p>{{ $comment->content }}</p>
                    <small class="text-muted">{{ $comment->created_at }}</small>

                    @if (auth()->check())
                        <?php $hasUserLiked = $comment->hasUserLiked() ?>
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
                                <form method="post" action="{{ route('author.deleteComment', ['id' => $comment->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mr-2">Delete Comment</button>
                                </form>

                                <button type="button" class="btn btn-primary" onclick="showUpdateForm('{{ $comment->id }}')">Update Comment</button>
                            </div>

                            <div class="mt-2">
                                <button type="button" class="btn btn-secondary btn-sm" onclick="toggleReplies('{{ $comment->id }}')">View Replies</button>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="showReplyForm('{{ $comment->id }}')">Reply</button>
                            </div>
                        @endif
                    @endif

                    <div id="replies{{ $comment->id }}" style="display: none;">
                        @foreach ($comment->replies as $reply)
                            <div class="media mt-3">
                                <img src="{{ asset('storage/' . $reply->user->picture) }}" class="mr-3 rounded-circle" alt="User Avatar" style="width: 40px; height: 40px;">
                                <div class="media-body">
                                    <h6 class="mt-0">{{ $reply->user->name }}</h6>
                                    <p>{{ $reply->content }}</p>
                                    <small class="text-muted">{{ $reply->created_at }}</small>
                                </div>
                                @if(auth()->check())
                                <?php
                                $hasUserLiked = $reply->hasUserLiked()
                                ?>
                                <form method="POST" action="{{ $hasUserLiked ?
                                    route('author.reply.unlike', $reply->id) :
                                    route('author.reply.like', $reply->id) }}"
                                    >
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary btn-sm ml-2">{{ $hasUserLiked ? 'Dislike' : 'Like' }}</button>
                                    <span class="text-muted ml-2">{{ $reply->likes_count}}</span>
                                </form>
                                @endif
                            </div>
                        @endforeach


                    </div>

                    <div id="replyForm{{ $comment->id }}" class="mt-3" style="display: none;">
                            <form method="POST" action="{{ route('author.comments.reply', $comment->id) }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                <div class="form-group">
                                    <textarea name="content" class="form-control" rows="2" placeholder="Reply to this comment" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Submit Reply</button>
                            </form>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
<script>
    function toggleReplies(commentId) {
        const repliesDiv = document.getElementById(`replies${commentId}`);
        if (repliesDiv.style.display === 'block') {
            repliesDiv.style.display = 'none';
        } else {
            repliesDiv.style.display = 'block';
        }
    }

    function showReplyForm(commentId) {
        const replyForm = document.getElementById(`replyForm${commentId}`);
        if (replyForm.style.display === 'block') {
            replyForm.style.display = 'none';
        } else {
            replyForm.style.display = 'block';
        }
    }
</script>
</div>



@endsection

