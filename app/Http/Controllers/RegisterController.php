<?php

namespace App\Http\Controllers;
use App\Http\Controllers\LoginRequest;
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
