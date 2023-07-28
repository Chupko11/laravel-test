<?php

namespace App\Http\Controllers\API;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\User;
use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function showUsers(){
        return User::all();
    }

    public function deleteUser(User $id){
        $id->delete();
        return response()->json(['message' => 'User profile deleted successfuly']);
    }

    public function showPosts(){
        return Blog::with('tags','user')->withCount('likes')->orderBy('created_at', 'desc')->paginate(5);
    }

    public function deletePosts(Blog $id){
        $id->delete();
        return response()->json(['message' => 'Post deleted successfuly']);
    }

    public function showTags(){
        return Tag::all();
    }

    public function deleteTag(Tag $id){
        $id->delete();
        return response()->json(['message' => 'Tag deleted successfuly']);
    }

    public function showComments(){
        return Comments::with('user')->withCount('likes')->get();
    }

    public function deleteComments(Comments $id){
        $id->delete();
        return response()->json(['message' => 'Comment deleted successfuly']);
    }

    public function showUserDetails(User $id){
        $posts = Blog::where('id', $id)->get();
        $comments = Comments::where('id', $id)->with('user')->get();
        return [$posts, $comments];

    }


}
