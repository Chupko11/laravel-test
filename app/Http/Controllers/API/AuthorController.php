<?php

namespace App\Http\Controllers\API;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    public function index(){
        return Blog::with('tags', 'user')->withCount('likes')->orderBy('created_at', 'desc')->get();
    }

    public function update(Request $request, User $id){

        $id->name = $request->name;
        $id->biography = $request->biography;
        $id->username = $request->username;

        $id->save();

        return response()->json(['message' => 'User profile updated successfuly']);
    }


    Public function updateProfilePicture(Request $request, User $id){
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if($request->hasFile('picture')){

        $currentPicture = $id->picture;
        $newPicture = $request->file('picture');
        $picturePath = $newPicture->store('public/profile_pictures/' . $id->id);
        $id->picture =str_replace('public/' , '', $picturePath);

    }
        $id->save();

        if($currentPicture){
            Storage::disk('public')->delete($currentPicture);
        }

        return response()->json(['message' => 'User profile picture updated successfuly']);
    }

    public function updatePasswordSave(Request $request, User $id){
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);


        if(!Hash::check($request->old_password, $id->password)){
            return redirect()->back()->with('Error', 'The old password is wrong.');
        }

        if($request->get('old_password') === $request->new_password){
            return redirect()->back()->with("error", "New password cannot be same as your old password.");
        }

        $id->password = $request->new_password;
        $id->save();

        return response()->json(['message' => 'User password updated successfuly']);
    }

    public function delete(Request $request, User $id){
        $request->validate([
            'password' => 'required'
        ]);


        if(!Hash::check($request->password, $id->password)){
            return response()->json(['message' => 'Password is incorrect. please input the correct password']);
        }
        $id->delete();

        return response()->json(['message' => 'User deleted successfuly']);
    }



}
