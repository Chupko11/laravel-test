@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')
@section('content')

<div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <span class="avatar avatar-md" style="background-image: url('{{ asset('storage/' . $id->picture) }}')"></span>
      </div>
      <div class="col-md-6">
        <h2 class="page-title">{{ $id->name }}</h2>
        <div class="page-subtitle">
          <div class="row">
            <div class="col-auto">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M5 21v-14l8 -4v18" /><path d="M19 21v-10l-6 -4" /><path d="M9 9l0 .01" /><path d="M9 12l0 .01" /><path d="M9 15l0 .01" /><path d="M9 18l0 .01" /></svg>
              <a href="#" class="text-reset">UI Designer</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>


    <div class="row">
      <div class="card">

  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
      <li class="nav-item">
        <a href="#tabs-details" class="nav-link active" data-bs-toggle="tab">Personal details</a>
      </li>
      <li class="nav-item">
        <a href="#tabs-posts" class="nav-link" data-bs-toggle="tab">User's posts</a>
      </li>
      <li class="nav-item">
        <a href="#tabs-comments" class="nav-link" data-bs-toggle="tab">User's comments</a>
      </li>
    </ul>
  </div>
</div>
</div>

  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active" id="tabs-details">
        <div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input class="form-control" name="name" value="{{ $id->name }}" nullable></input>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $id->username }}" nullable></input>
                        </div>

                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Biography</label>
                    <textarea class="form-control" name="biography" value="{{ $id->biography }}" nullable></textarea>
                </div>
        </div>
      </div>
    </div>
  </div>


  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane" id="tabs-posts">
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
      </div>
    </div>
  </div>

  <div class="card-body">
    <div class="tab-content">
      <div class="tab-pane" id="tabs-comments">
        <div>

        <div>
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


                            <div class="d-flex justify-content-end">
                                <form method="post" action="{{ route('author.deleteComment', ['id' => $comment->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mr-2">Delete Comment</button>
                                </form>
                            </div>

                            <div class="mt-2">
                                <button type="button" class="btn btn-secondary btn-sm" onclick="toggleReplies('{{ $comment->id }}')">View Replies</button>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="showReplyForm('{{ $comment->id }}')">Reply</button>
                            </div>
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

                    @endforeach
                    </div>
                    

      </div>
      </div>
    </div>
  </div>







@endsection
