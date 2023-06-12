<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public $user, $password;
public function index(){
    return view ('back.pages.homeguest');
}

    public function create(){
        return view ('back.pages.auth.signup');
    }

    public function store(Request $request){
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'username' => 'required'
        ]);


        $user = User::create(request(['name', 'email', 'password', 'username']));

        auth()->login($user);

        return redirect()->to('/home');

    }
}
