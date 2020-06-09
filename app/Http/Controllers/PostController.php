<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin|author'])->except('show', 'index', 'showCat');
        $this->middleware(['auth'])->only('indexapi');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(config('blog.post_per_page'));
        return view('blog.posts.index', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.posts.create');
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
            'title'  => 'required|min:4|max:60|unique:posts,title',
            'body'   => 'required|min:10',
            'cat_id' => 'required|integer|exists:categories,id',
            'image'  => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $post = new Post();

        // upload post image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'post-image' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
        } else {
            $fileName = "no-image.svg";
        }
        $title = $request->title;

        $post->title   = $title;
        $post->body    = $request->body;
        $post->image   = $fileName;
        $post->user_id = Auth::user()->id;
        $post->slug    = Str::slug($title);
        $post->cat_id  = $request->cat_id;

        $post->save();

        return redirect(route('posts.index'))->with('success', 'Post was created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('blog.posts.show', compact('post'));
    }

    public function showCat(Categorie $cat, Post $post)
    {
        return view('blog.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        session(['url-prev' => url()->previous()]);
        return view('blog.posts.edit', compact('post'));
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
            'title'  => 'required|max:255|min:4|unique:posts,title,' . $post->id,
            'body'   => 'required|min:10',
            'cat_id' => 'required|integer|exists:categories,id',
            'image'  => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        // upload post image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'post-image' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            $post->image = $fileName;
        }

        $post->title  = $request->title;
        $post->body   = $request->body;
        $post->cat_id = $request->cat_id;
        $post->save();

        return redirect(route('posts.edit', $post))->with('success', 'test');
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
        return back()->with('success', 'Post was deleted !');
    }

    //my posts route
    public function myPosts()
    {
        $posts = Auth::user()->posts()->orderBy('id', 'desc')->paginate(config('blog.post_per_page'));
        return view('blog.posts.index', compact('posts'));
    }
}
