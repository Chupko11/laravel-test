<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('back.pages.blog', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'cover_image'=> 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $post = new Blog;

        $post->title = $request->title;
        $post->body = $request->body;

        if($request->hasFile('cover_image')){
            $coverImage = $request->file('cover_image');
            $imagePath = $coverImage->store('public/cover_images');
            $post->cover_image = $imagePath;
        }
        $post->save();

        $tags = $request->input('tags');
        $post->tags()->attach($request->input('tags'));
        return redirect()->route('author.createPost')->with('Post created successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    //Tags
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

}
