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
        return redirect()->route('author.homeGuest');
    }

    public function login(LoginRequest $request){

        $login = $request->login_id;
        $password = $request->password;


        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function update(Request $request) {

        $user = auth()->getUser();

        $user->name = $request->name;
        $user->biography = $request->biography;
        $user->email = $request->email;
        $user->username = $request->username;

        $user->save();

        return redirect()->back();
    }

    public function profile() {
        $user = auth()->getUser();

        return view('back.pages.profile', ['user' => $user]);
    }
}
