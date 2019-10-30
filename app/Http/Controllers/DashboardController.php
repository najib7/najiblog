<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    //show all posts
    public function posts()
    {
        $posts = Post::orderBy('id', 'DESC')->get();
        return view('dashboard.posts.posts', compact('posts'));
    }

    //Categories
    public function categories()
    {
        $categories = Categorie::orderBy('id', 'DESC')->get();
        return view('dashboard.categories.categories', compact('categories'));
    }

    //all comments
    public function comments()
    {
        $comments = Comment::orderBy('id', 'DESC')->paginate(6);
        return view('dashboard.comments.comments', compact('comments'));
    }

    //page not found 404
    public function error404()
    {
        return view('errors.404-da');
    }
}
