<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Mail\RegistrationSuccess;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetRequest;
use App\Http\Requests\ForgotRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{
    public $user, $password;

public function index(){
    $posts = Blog::with('tags', 'user')->withCount('likes')->orderBy('created_at', 'desc')->paginate(5);
    return view ('back.pages.homeguest', compact('posts'));
}

    public function create(){
        return view ('back.pages.auth.signup');
    }

    public function store(Request $request){
        $this->validate(request(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',


        ]);
        $user = User::create(request(['name','username','email', 'password']));

        Mail::to($request->email)->send(new RegistrationSuccess($user));


        return redirect()->route('author.loginView');



    }

    public function login(LoginRequest $request){
        $creds = [
            'email'=> $request->login_id,
            'password' => $request->password,

        ];
        if(Auth::guard('web')->attempt($creds)){
            $user= User::where('email', $request->login_id)->get()->first();
            Auth::login($user);
            session()->flash('Success','Welcome back,' . $user->name . '.');
            return redirect(route('author.home'))->with( session()->flash('status','Welcome back,' . $user->name . '.'));
        }else{
            session()->flash('fail','Incorrect Email/Username or Password');
            return redirect()->back();
        }
    }

    public function forgotPassword(ForgotRequest $request){

        $user = User::where('email', $request->email)->get()->first();
        $token = Str::random(60);
        $user->token = $token;
        $user->save();
        Mail::to($request->email)->send(new ForgotPassword($user));

        return redirect()->back();
    }

    public function resetPassword($token){
        return view('back.resetpassword', compact('token'));
    }

    public function resetPasswordSave(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);
        $user = User::where('email', $request->email)->get()->first();
        if($request->token !== $user->token){
            return redirect()->back()->with('Error', 'Invalid token');
        }
        else{
            $user->password = $request->new_password;
            $user->save();
            return redirect()->back()->with('Success', 'Password has been updated');
        }
    }
}
