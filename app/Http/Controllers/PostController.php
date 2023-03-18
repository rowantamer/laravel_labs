<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {

            $posts = [
                [
                    'id' => 1,
                    'title' => 'Laravel',
                    'posted_by' => 'Baekhyun',
                    'created_at' => '2022-08-01 10:00:00'
                ],

                [
                    'id' => 2,
                    'title' => 'PHP',
                    'posted_by' => 'Rowan',
                    'created_at' => '2022-08-01 10:00:00'
                ],

                [
                    'id' => 3,
                    'title' => 'Javascript',
                    'posted_by' => 'Chanyeol',
                    'created_at' => '2022-08-01 10:00:00'
                ],
            ];

        return view('posts.index',['posts' => $posts]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts =  [
            'id' => 3,
            'title' => 'Javascript',
            'posted_by' => 'Rowan',
            'created_at' => '2022-08-01 10:00:00',
            'description' => 'hello description',
        ];

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
        return view('posts.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
