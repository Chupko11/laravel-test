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
                            <label class="form-label">Name of an author</label>
                            <input type="search" class="form-control" name="author_name" placeholder="Enter text" required></input>
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
    @if(isset($authorName))
    <h3>Posts by {{ isset($authorName) }}</h3>
    @endif
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

  <div class="card align-items-center">
    @if (isset($authorName))
 {{ $posts->appends(['author_name' => $authorName])->links() }}
    @else
    {{ $posts->links() }}
    @endif
    </div>
@endif

@endsection
