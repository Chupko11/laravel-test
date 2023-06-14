@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Tag')
@section('content')
<div class="card-body">
    <div class="tab-content">
      <div class="tab-pane active show" id="tabs-details">
        <div>
            <form method="post"  action="{{ route('author.storeTag') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tag Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter tag title" required></input>
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
