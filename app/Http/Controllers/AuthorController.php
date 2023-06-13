<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    Public function updateProfilePicture(Request $request){
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $currentPicture = $user->picture;

        $newPicture = $request->file('picture')->store('picture', 'public');

        $user->picture = $newPicture;
        $user->save();

        if($currentPicture){
            Storage::disk('public')->delete($currentPicture);
        }

        return redirect()->back()->with('Success', 'Profile picture updated successfully');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = auth()->user();

        if(!Hash::check($request->old_password, $user->password)){
            return redirect()->back()->withErrors(['old_password' => 'The old password is wrong.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('Success', 'The password has been changed');
    }
}
