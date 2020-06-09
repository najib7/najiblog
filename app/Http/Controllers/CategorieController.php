<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::orderBy('id', 'DESC')->get();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|min:3|max:30',
            'description' => 'required|min:10|max:255',
        ]);

        if($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        $cat = new Categorie();
        $cat->name        = $request->name;
        $cat->description = $request->description;
        $cat->slug        = Str::slug($request->name);
        $cat->save();
        
        return response()->json(['status' => 'success', 'message' => 'category added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $category)
    {
        $posts = $category->posts()->orderBy('id', 'DESC')->paginate(config('blog.post_per_page'));
        return view('blog.posts.index', compact('posts', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Categorie::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'        => 'required|min:3|max:30',
            'description' => 'required|min:10|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'error', 
                'message' => $validator->errors()
            ]);
        }

        $category->name        = $request->name;
        $category->description = $request->description;
        $category->slug        = Str::slug($request->name);

        $category->save();

        return response()->json([
            'status'  => 'success',
            'message' => $category->name . ' category  edited successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categorie::findOrFail($id);
        try {
            $category->delete();
        } catch(QueryException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'This category is not empty. Please remove category posts first!'
            ]);
        }
        return response()->json([
            'status'  => 'success',
            'message' => 'Category deleted successfully'
        ]);
    }
}
