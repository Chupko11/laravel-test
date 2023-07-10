<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use Illuminate\Http\Request;

class TagController extends Controller
{


    public function createTag(){
        $tags = Tag::all();

        return view('back.pages.tag', compact('tags'));
    }

    public function storeTag(Request $request){
        $request->validate([
            'name' => 'required|unique:tags',
        ]);

            $tagName = $request->input('name');

        Tag::create(['name' => $tagName]);

        return redirect()->route('author.createTag')->with('Tag was created successfuly.');
    }

    public function deleteTag($id){
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->back()->with('Success', 'Tag deleted successfully');
    }

    public function showTags(){
        $tags = Tag::all();

        return view('back.pages.deleteTag', compact('tags'));
    }


    public function showTagsPosts(Tag $tag){
        $posts = Blog::whereHas('tags', function ($query) use ($tag){
            $query->where('name', $tag->name);
        })->get();

       return view('back.pages.showtagpost', compact('tag', 'posts'));
    }

}
