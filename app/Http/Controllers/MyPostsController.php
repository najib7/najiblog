<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin|author']);
    }


    public function index()
    {
        $posts = Auth::user()->posts;
        return view('posts.my-posts', compact('posts'));
    }
}
