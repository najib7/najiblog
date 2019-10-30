<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->except('show', 'index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::orderBy('id', 'DESC')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'name'        => 'required|min:3|max:30',
            'description' => 'required|min:10|max:255',
        ]);

        $cat = new Categorie();

        $cat->name        = $request->name;
        $cat->description = $request->description;
        $cat->slug        = Str::slug($request->name);

        $cat->save();

        return redirect(route('categories.index'))->with('success', 'Category created successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $category)
    {
        $posts = $category->posts()->orderBy('id', 'DESC')->paginate(9);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $category)
    {
        $request->validate([
            'name'        => 'required|min:3|max:30',
            'description' => 'required|min:10|max:255',
        ]);

        $category->name        = $request->name;
        $category->description = $request->description;
        $category->slug        = Str::slug($request->name);

        $category->save();

        return redirect(route('categories.index'))->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $category)
    {
        try {
            $category->delete();
        } catch(QueryException $e) {
            return 'hadchi 3amar';
        }
        return redirect(route('categories.index'))->with('success', 'Category deleted successfully');
    }
}
