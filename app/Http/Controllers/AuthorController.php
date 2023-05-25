<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function index(Request $request){
        return view ('back.pages.home');
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function login(LoginRequest $request){

        $login = $request->login_id;
        $password = $request->$password;


        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }
}
