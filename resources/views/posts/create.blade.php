@extends('layouts.app')

@section('title') Create Post @endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form class="mx-5" method="post" action="{{route('posts.store')}}" enctype="multipart/form-data" >
    @csrf
    <div class="form-group"  >
      <label for="exampleFormControlInput1">Title</label>
      <input  name="title" class="form-control" id="title" placeholder="">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Description</label>
        <input name="description" class="form-control" id="exampleFormControlInput1" placeholder="">
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Post creator</label>
      <select name="post_creator" class="form-control">
        @foreach ($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
      </select>
    </div>

    <div class="my-5">
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
    </div>

    <div class="form-group my-3">
        <x-button type="submit" class="btn btn-primary">create</x-button>
    </div>


  </form>
  @endsection
