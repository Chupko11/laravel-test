<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    public function index(Request $request){
        $posts = Blog::with('tags', 'user')->withCount('likes')->orderBy('created_at', 'desc')->paginate(5);

        return view ('back.pages.home', compact('posts'));
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('author.homeGuest');
    }


    public function update(Request $request) {

        $user = auth()->user();

        $user->name = $request->name;
        $user->biography = $request->biography;
        $user->username = $request->username;

        $user->save();

        return redirect()->back();
    }


    public function profile() {
        $user = auth()->user();

        return view('back.pages.profile', ['user' => $user]);
    }



    Public function updateProfilePicture(Request $request){
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $user = auth()->user();

        if($request->hasFile('picture')){

        $currentPicture = $user->picture;
        $newPicture = $request->file('picture');
        $picturePath = $newPicture->store('public/profile_pictures/' . $user->id);
        $user->picture =str_replace('public/' , '', $picturePath);

    }
        $user->save();

        if($currentPicture){
            Storage::disk('public')->delete($currentPicture);
        }

        return redirect()->back()->with('Success', 'Profile picture updated successfully');
    }



    public function updatePasswordSave(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);
        $user = Auth::user();

        if(!Hash::check($request->old_password, $user->password)){
            return redirect()->back()->with('Error', 'The old password is wrong.');
        }

        if($request->get('old_password') === $request->new_password){
            return redirect()->back()->with("error", "New password cannot be same as your old password.");
        }

        $user->password = $request->new_password;
        $user->save();

        return redirect()->back()->with('Success', 'The password has been changed');
    }




    public function deleteAccount(Request $request){
        $request->validate([
            'password' => 'required'
        ]);

        $user = Auth::user();

        if(!Hash::check($request->password, $user->password)){
            return redirect()->back()->with('Error', 'Password is incorrect');
        }
        $user->delete();

        Auth::logout();

        return redirect()->route('author.loginView')->with('Account has been deleted succesfully');
    }
}
