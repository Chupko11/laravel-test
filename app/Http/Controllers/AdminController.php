<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\User;
use App\Models\Comments;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function showUsers(){
        $users = User::all()->except(auth()->user()->id);
        return view ('back.pages.admin.adminUsers', compact('users'));
    }

    public function deleteUser(User $id){
        $id->delete();
        return redirect()->back();
    }

    public function showPosts(){
        $posts = Blog::with('tags','user')->withCount('likes')->orderBy('created_at', 'desc')->paginate(5);
        return view('back.pages.admin.adminPosts', compact('posts'));
    }

    public function deletePost(Blog $id){
        $id->delete();
        return redirect()->back();
    }

    public function showTags(){
        $tags = Tag::all();

        return view('back.pages.admin.adminTags', compact('tags'));
    }

    public function showComments(){
        $comments = Comments::with('user')->withCount('likes')->get();
        return view('back.pages.admin.adminComments', compact('comments'));

    }

    public function deleteComments(Comments $id){
        $id->delete();
        return redirect()->back();
    }

}
