@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@section('content')
<div style="position: relative; height: 500px; overflow: hidden;">
    <img src="{{ asset('back/heroImage.jpg') }}" alt="Hero Image" style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
</div>
<div class="card-container">
@foreach ($posts as $post)
<div class="col">
<div class="card">
	<div class="card-body">
        <h1 class="card-title">{{ $post->title }}</h1>
        @if ($post->cover_image)
        <div class="image-container"></div>
        <img src="{{ asset('/storage' .$post->cover_image) }}" alt="Cover image" class="card-img-top" style="width:auto; height:auto;">
        </div>
        @endif
        <p class="card-text">{{ $post->body }}</p>
        <p class="card-text">Author: {{ $post->user->name }}</p>
        <p class="card-text">Tags:
            @foreach ($post->tags as $tag)
            {{ $tag->name }}
            @endforeach
        </p>
</div>
</div>
</div>


@endforeach

<style>
.card-container{
    display: flex;
    flex-wrap: wrap;

}

.col{
    flex-basis: 33%;
    padding: 10px;
    box-sizing: border-box;
}

.card{

    width: calc(23% - 10px);
    margin-bottom:20px
}
.image-container{
    display: flex;
    justify-content: center;
}
.card-img-top{
    max-width:100%;
    max-height: 100%;
}



</style>

@endsection
