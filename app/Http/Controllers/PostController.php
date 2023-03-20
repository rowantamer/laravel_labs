<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    public function index()
    {
        //all items in database
        $posts = Post::all();
        $posts = Post::orderBy('created_at', 'asc')->paginate(15);

        return view('posts.index',['posts' => $posts]);

    }


    public function create()
    {
        $users = User::all();

        return view('posts.create',['users' => $users]);
    }


    public function store(Request $request)
    {
        //collect data from form
        $title=request('title');
        $description=request('description');
        $postCreator=request('post_creator');

        //dd($title, $description, $postCreator);

        //save to database
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);



        //redirect to index page
        return redirect()->route('posts.index');
        //return to_route('posts.index');
    }


    public function show($id)
    {
        //show data of specific id
        $posts =  Post::find($id);
        //$posts=Post::where('id', $id)->get(); //==>collection of objects
        //$posts=Post::where('id', $id)->first(); //==>post model object
        $posts->load('comments');

        return view('posts.show',['posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $posts =  Post::find($id);
        return view('posts.edit',['users' => $users],['posts' => $posts]);
    }


    public function update(Request $request, $id)
    {
        //retreive data from database

        $title=request('title');
        $description=request('description');
        $postCreator=request('post_creator');

        //change data save to database
        $post = Post::find($id);
        $post->title = $title;
        $post->description = $description;
        $post->user_id = $postCreator;
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
        //reload page
        return redirect()->route('posts.index');
    }
}
