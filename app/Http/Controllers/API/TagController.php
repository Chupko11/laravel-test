<?php

namespace App\Http\Controllers\API;

use App\Models\Tag;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index(){
        return Tag::all();
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required|unique:tags',
        ]);
            $tagName = $request->name;
        Tag::create(['name' => $tagName]);
        return response()->json(['message' => 'Tag created successfully']);
    }

    public function blogsWithTags(Tag $id){
        return $id->blogs;
    }

    public function delete(Tag $id){
        $id->delete();
        return response()->json(['message' => 'Tag deleted successfully']);
    }




}
