<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetRequest;
use App\Http\Requests\ForgotRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


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

    public function forgotPassword(ForgotRequest $request){
        $user = User::where('email', $request->email)->get()->first();
        Mail::to($request->email)->send(new ForgotPassword($user));

        return redirect()->back();
    }

    public function resetPassword(){
        return view('back.resetpassword');
    }

    public function resetPasswordSave(ResetRequest $request){
        
    }
}
