@extends('layouts.app')

@section('title') Home @endsection

@section('content')
    <div class="text-center">
        <a type="button" class="mt-4 btn btn-success" href="{{route('posts.create')}}">Create Post</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post )
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->User->name}}</td>
                <td>{{$post->created_at}}</td>
                <td>
                    <form action="{{route('posts.destroy',$post->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                    <a href="{{route('posts.show', $post->id)}}" class="btn btn-info">View</a>
                    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary">Edit</a>
                    <button type="submit" class="btn btn-danger"  onclick="return confirm('Are you sure you want to delete {{$post->User->name}}?')">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
    {{ $posts->links('pagination::bootstrap-5') }}
    {{-- <script>
        let deleteBtn = document.querySelectorAll('.btn-danger');

        deleteBtn.forEach((e) =>
        e.addEventListener("click", function (e) {
       confirm("Are you sure you want to delete this post?");
  })
);
    </script> --}}

@endsection

