<?php

namespace App\Http\Controllers\API;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;



class PostController extends Controller
{
    public function index(Request $request){
        $column = $request->column;
        $sort = $request->sort;
        if($column && $sort){
            return Blog::withCount('likes')->orderBy($column, $sort)->get();
        }else{
            return Blog::all();
        }
    }

    public function create(Request $request){

        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'cover_image'=> 'image|mimes:jpeg,png,jpg,gif',
            'tags' => 'required',
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
        $post->tags()->attach($tags);

        return response()->json(['message'=> 'Post has been created successfuly']);
    }

    public function update(Request $request, Blog $id){
        $id->title = $request->title;
        $id->body = $request->body;

        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $imagePath = $coverImage->store('cover_images', 'public');
            $id->cover_image = "/" . $imagePath;
        }

        $id->tags()->sync($request->input('tags'));

        $id->save();

        return response()->json(['message' => 'Post has been updated successfuly']);

        }



    public function delete(Blog $id){
        $id->delete();
        return response()->json(['message' => 'Post was successfuly deleted']);
    }

    public function displayUsersPosts(User $userid){
        return $userid->posts;
    }

    public function displayPost(Blog $id){
        return $id->load('tags', 'comments')->loadCount('likes');
    }

    public function displayTagPost(Tag $tagid){
        return $tagid->blogs;
    }




}
