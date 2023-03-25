<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Jobs\PruneOldPostsJob;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{

    public function index()
    {
        //all items in database
        $posts = Post::all();
        $posts = Post::orderBy('created_at', 'asc')->paginate(15);

        return view('posts.index', ['posts' => $posts]);

    }


    public function create()
    {
        $users = User::all();

        return view('posts.create', ['users' => $users]);
    }


    public function store(StorePostRequest $request)
    {
        //1-get data from form
        //2-collect data from form
        //dd($title, $description, $postCreator);
        //3-save to database
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->post_creator;
        $path = $request->file('image')->store('public/images');

        // Create the post

        $post->image = $path;
        $post->save();


        //4-redirect to index page
        return redirect()->route('posts.index');
        //return to_route('posts.index');
    }


    public function show($id)
    {
        //show data of specific id
        $posts = Post::find($id);
        //$posts=Post::where('id', $id)->get(); //==>collection of objects
        //$posts=Post::where('id', $id)->first(); //==>post model object
        $posts->load('comments');

        return view('posts.show', [
            'posts' => $posts,
            'imageUrl' => Storage::url('public/images/' . $posts->image),
        ]);
    }

    public function edit($id)
    {
        $users = User::all();
        $posts = Post::find($id);
        // dd($posts);

        return view('posts.edit', ['users' => $users], ['posts' => $posts]);
    }


    public function update(StorePostRequest $request, $id, Post $post)
    {
        //retreive data from database
        //change data save to database
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->post_creator;
        if ($request->filled('title') && $request->input('title') !== $post->title) {
            $post->title = $request->input('title');
        }
        if ($request->hasFile('image')) {
            // Delete the old image file
            Storage::delete($post->image);

            // Store the new image file
            $path = $request->file('image')->store('public/images');
            $post->image = $path;
        }


        $post->save();
        //redirect to index page
        return redirect()->route('posts.index');
    }


    public function destroy($id)
    {
        //get id
        $post = Post::find($id);
        //delete post
        $post->delete();
        Storage::delete($post->image);
        //reload page
        return redirect()->route('posts.index');
    }
    public function deletePostsFromTwoYears()
    {
        dispatch(new PruneOldPostsJob());
        return redirect()->back()->with('message', 'Old posts have been deleted.');
    }

}
