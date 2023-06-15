@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Post update')
@section('content')
<div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active show" id="tabs-details">
        <div>
            <form method="post" action="{{ route('author.postUpdatePost') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter title" value="{{ $post->title }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Body</label>
                            <textarea class="form-control" name="body" placeholder="Enter text">{{ $post->body }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Post picture</label>
                            <input type="file" class="form-control" name="cover_image">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tags</label>
                    <select name="tags[]" id="tags" multiple>
                        @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
      </div>
    </div>
  </div>
@endsection
