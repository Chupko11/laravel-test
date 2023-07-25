<?php

namespace App\Http\Controllers\API;

use App\Models\Blog;
use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function index()
    {
        return Comments::all();
    }

    public function create(Request $request, $postid){
        $request->validate([
            'content' => 'required|min:5|max:2000'
        ]);
        //testni request za usera, zamijeniti sa Auth::user()
        $userId = $request->user_id;

        $comment = new Comments();
        $comment->content = $request->content;
        $comment->user_id = $userId;
        $comment->blog_id = $postid;
        $comment->save();

        return response()->json(['message' => 'Comment was successfuly created']);
    }


    //zasto x-form umijesto form data u postmanu
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string'
        ]);
        $comment = Comments::where('id', $id)->first();

        $comment->content = $request->content;
        $comment->save();

        return response()->json(['message' => 'Comment was successfuly updated']);
    }

    public function delete(Comments $id){
        $id->delete();

        return response()->json(['message' => 'Comment was successfuly deleted']);
    }





}
