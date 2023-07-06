@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Blog')
@section('content')
<div class="card-body">
    <div class="tab-content">
        <div class="tab-pane active show" id="tabs-details">
            <div>
                <form method="post" action="{{ route('author.storePost') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter title">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Body</label>
                                <textarea class="form-control" name="body" placeholder="Enter text"></textarea>
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
                        <select name="tags[]" id="tags" class="form-select">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"> {{ $tag->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
