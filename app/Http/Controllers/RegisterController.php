<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public $user, $password;
public function index(){
    $posts = Blog::orderBy('created_at', 'desc')->paginate(5);
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

    public function login(LoginRequest $request){
        $creds = [
            'email'=> $request->login_id,
            'password' => $request->password,

        ];
        if(Auth::guard('web')->attempt($creds)){
            $user= User::where('email', $request->login_id)->get();
            Auth::login($user);
            return redirect('author.home');
        }else{
            session()->flash('fail','Incorrect Email/Username or Password');
            return redirect()->back();
        }
    }

}
