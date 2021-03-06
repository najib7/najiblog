<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('store');
        $this->middleware(['can:edit-comment,comment'])->only('edit', 'update');
        $this->middleware(['can:destroy-comment,comment'])->only('destroy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Post $post)
    {
        $validator = Validator::make($request->all(),[
            'comment' => 'required|min:8|max:500'
        ]);

        // scroll down to the comment sections
        if ($validator->fails()) {
            return redirect(url()->previous() . "#comments")->withErrors($validator->errors());
        }
        
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
        $comment->save();

        return redirect(route('posts.show', $post))->with('success', 'Comment added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $validator = Validator::make($request->all(),[
            'comment' => 'required|min:8|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => $validator->errors()
            ]);
        }

        $comment->comment = $request->comment;
        $comment->save();
        
        return response()->json([
            'status'  => 'success',
            'message' => 'Comment edited successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect(url()->previous())->with('success', 'Comment deleted successfully');
    }
}
