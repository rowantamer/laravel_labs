@extends('layouts.app')
@section('title') Edit Post @endsection

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
<form class="mx-5" method="post" action="{{route('posts.update',$posts->id)}}" >
    @csrf
    @method('PUT')
    <div class="form-group"  >
        <label for="exampleFormControlInput1">Title</label>
        <input  name="title" class="form-control" id="exampleFormControlInput1" placeholder="{{$posts->title}}" value="{{$posts->title}}">
      </div>
      <div class="form-group">
          <label for="exampleFormControlInput1">Description</label>
          <input name="description" class="form-control" id="exampleFormControlInput1" placeholder="{{$posts->description}}" value="{{$posts->description}}">
      </div>



      <div class="form-group">
        <label for="exampleFormControlTextarea1">Post creator</label>
        <select name="post_creator" class="form-control">
          @foreach ($users as $user)
          <option value="{{$user->id}}">{{$user->name}}</option>

          @endforeach

      </select>
      </div>
    <div class="form-group my-3">
        <x-button type="submit" class="btn btn-primary">edit</x-button>
      </div>


  </form>


@endsection
