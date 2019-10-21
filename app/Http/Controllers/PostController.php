<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::orderBy('id', 'DESC')->paginate(9);
        return view('posts.index', compact('posts'));
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
        $request->validate([
            'title' => 'required|max:255|min:4',
            'body'  => 'required|min:10',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $post = new Post();

        // upload post image
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'post-image' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
        } else {
            $fileName = "no-image.png";
        }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->image = $fileName;

        $post->save();

        return redirect(route('posts.index'))->with('post-created', 'Post was created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255|min:4',
            'body'  => 'required|min:10',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // upload post image
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'post-image' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            $post->image = $fileName;
        }

        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        return redirect(route('posts.show', $post))->with('post-updated', 'Post was updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(route('posts.index'))->with('post-deleted', 'Post was deleted !');
    }
}
