<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $posts = Post::orderBy('created_at', 'asc')->paginate(15);
        return PostResource::collection($posts);

    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->post_creator;
        $post->save();
        return new PostResource($post);

    }


    public function show($id)
    {
        $posts = Post::find($id);
        if($posts){
            return new PostResource($posts);
        }
        else{
            return response()->json(['message' => 'Post not found'], 404);
        }


    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
