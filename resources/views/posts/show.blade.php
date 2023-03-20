@extends('layouts.app')

@section('title') Show Post @endsection

@section('content')
<div class="card mt-6">
    <div class="card-header">
        Post Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Title: {{$posts->title}}</h5>
        <p class="card-text">Description: {{$posts->description}}</p>
        <p class="card-text">posted at: {{$posts->created_at}}</p>
    </div>
</div>

<div class="card mt-6  my-3">
    <div class="card-header">
        Post Creator Info
    </div>
    <div class="card-body">
        <h5 class="card-title">user : {{$posts->User->name}}</h5>
    </div>
</div>

<h2>Comments</h2>
@foreach ($posts->comments as $comment)
    <div>
        <p>Posted by: {{ $posts->User->name }}</p>
        <p>{{ $comment->content }}</p>

    </div>
@endforeach
{{-- form to create another --}}
<form method="post" action="{{ route('comments.store') }}">
    @csrf
    <input type="hidden" name="commentable_id" value="{{ $posts->id }}">
    <input type="hidden" name="commentable_type" value="{{ get_class($posts) }}">
    <textarea name="content"></textarea>
    <button type="submit">Submit</button>
</form>

{{-- <a type="submit" class="btn btn-primary my-3" href="{{route('posts.index')}}">show all</a> --}}



@endsection
