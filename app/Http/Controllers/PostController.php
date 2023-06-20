<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
            'cover_image'=> 'image|mimes:jpeg,png,jpg,gif',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $post = new Blog;

        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        if($request->hasFile('cover_image')){

            $coverImage = $request->file('cover_image');
            $imagePath = $coverImage->store('cover_images', 'public');
            $post->cover_image = "/" . $imagePath;

        }


    $post->save();

        $tags = $request->input('tags');
        $post->tags()->attach($request->input('tags'));

        return redirect()->route('author.showPosts')->with('Post created successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $posts = Blog::where('user_id', auth()->user()->id)->paginate(5);
        return view('back.pages.showpost', compact('posts'));
    }

    public function delete($id){
        Blog::destroy($id);
        return redirect()->back()->with('success', 'Post was deleted successfuly');
    }

    public function updatePost($id){

        $post =Blog::find($id);
        $tags = Tag::all();
        return view('back.pages.updatepost', compact('post', 'tags'));
    }



    public function postUpdatePost(Request $request){
    $postId = $request->input('post_id');
    $post = Blog::find($postId);

    $post->title = $request->input('title');
    $post->body = $request->input('body');

    if ($request->hasFile('cover_image')) {
        $coverImage = $request->file('cover_image');
        $imagePath = $coverImage->store('cover_images', 'public');
        $post->cover_image = "/" . $imagePath;
    }

    $post->tags()->sync($request->input('tags'));

    $post->save();

    return redirect()->route('author.showPosts')->with('success', 'Post updated successfully');

    }






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

    public function search(){
        $posts = Blog::with('user')->orderBy('created_at', 'desc')->paginate(5);
        return view ('back.pages.searchpost', compact('posts'));
    }

    public function postSearchPost(Request $request){
        $authorName = $request->input('author_name');
        $posts = [];
        if ($authorName){
            $author = User::where('name', $authorName)->first();

            if($author){
                $posts = Blog::where('user_id', $author->id)->with('user')->orderBy('created_at', 'desc')->paginate(5);

            }
        }
        if(empty($posts)) {
            $posts = Blog::with('user')->orderBy('created_at', 'desc')->paginate(5);
        }

        return view('back.pages.searchpost', compact('posts', 'authorName'));
    }

}
