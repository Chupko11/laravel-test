@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Search post')
@section('content')
<div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active show" id="tabs-details">
        <div>
            <form method="post"  action="{{ route('author.postSearchPost') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Name of an author</label>
                            <input type="text" class="form-control" name="author_name" placeholder="Enter tag title" required></input>
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
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
    <h3>Posts by {{ isset($authorName) }}</h3>
    @foreach ($posts as $post)
<div class="card">
<div class="card-body">
    <h1 class="card-text">{{ $post->title }}</h1>
    @if ($post->cover_image)
    <img src="{{ asset('/storage' . $post->cover_image) }}" alt="Cover image" style="max-width:20%; max-height:20%; display: block; margin-left: auto; margin-right: auto;">
    @endif
    <p class="card-text">{{ $post->body }}</p>
    <p class="card-text">Author: {{ $post->user->name }}</p>
    <p class="card-text">
        Tags:
        @foreach ($post->tags as $tag)
        {{ $tag->name }}
        @endforeach
    </p>
</div>
</div>
    @endforeach
  </div>
  @endif

@endsection
