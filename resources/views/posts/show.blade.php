@extends('layouts.app')

@section('title') Show Post @endsection

@section('content')
<div class="card mt-6">
    <div class="card-header">
        Post Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Title: {{$posts['title']}}</h5>
        <p class="card-text">Description: {{$posts['description']}}</p>
    </div>
</div>

<div class="card mt-6">
    <div class="card-header">
        Post Creator Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    </div>
</div>

<a type="submit" class="btn btn-primary" href="{{route('posts.index')}}">show all</a>


@endsection
