<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginRequest;

class RegisterController extends Controller
{
    public $user, $password;
public function index(){
    $posts = Blog::all();
    return view ('back.pages.homeguest', compact('posts'));
}

    public function create(){
        return view ('back.pages.auth.signup');
    }

    public function store(){
        $this->validate(request(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',


        ]);


        $user = User::create(request(['name','username','email', 'password']));

        return redirect()->route('author.login');



    }


}
