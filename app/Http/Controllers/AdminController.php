<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
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

}
