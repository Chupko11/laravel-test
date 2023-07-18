<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $post_id)
    {
        $request->validate([
            'content' => 'required|min:5|max:2000'
        ]);

        $comment = new Comments();
        $comment->content = $request->content;
        $comment->user_id = Auth::user()->id;
        $comment->blog_id = $post_id;
        $comment->save();

        Session::flash('Success', 'The comment has been added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string'
        ]);
        $comment = Comments::where('id', $id)->first();

        $comment->content = $request->content;
        $comment->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comments::where('id', $id)->first();
        $comment->delete();
        return redirect()->back();
    }

    public function likeComment(Comments $id){

        $hasUserLiked = $id->likes()->where('user_id', auth()->user()->id)->exists();

        if (!$hasUserLiked) {
            $id->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
        }

        return redirect()->back();
    }

    public function unlikeComment(Comments $id){

        $hasUserLiked = $id->likes()->where('user_id', auth()->user()->id)->exists();

        if ($hasUserLiked) {
            $id->likes()->delete();
        }

        return redirect()->back();
    }

    public function commentReply(Request $request, $post_id){
        $request->validate([
            'content' => 'required|min:5|max:2000',
            'user_id' =>'required',
            'parent_id' =>'required',
        ]);

        $comment = new Comments();
        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        $comment->parent_id = $request->parent_id;
        $comment->blog_id = $post_id;
        $comment->save();

        Session::flash('Success', 'The comment has been added');
        return redirect()->back();
    }

    public function likeReply(Comments $id){

        $hasUserLiked = $id->likes()->where('user_id', auth()->user()->id)->exists();

        if (!$hasUserLiked) {
            $id->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
        }

        return redirect()->back();
    }

    public function unlikeReply(Comments $id){

        $hasUserLiked = $id->likes()->where('user_id', auth()->user()->id)->exists();

        if ($hasUserLiked) {
            $id->likes()->delete();
        }

        return redirect()->back();
    }

}
