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
    //radi
    public function index(Request $request){
        $column = $request->column;
        $sort = $request->sort;
        if($column && $sort){
            return Blog::withCount('likes')->orderBy($column, $sort)->get();
        }else{
            return Blog::all();
        }
    }


    //ne sprema dobro tagove
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


    //update ne radi, title i body su null
    public function update(Request $request, Blog $id){
        $id->title = $request->title;
        $id->body = $request->body;
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $imagePath = $coverImage->store('cover_images', 'public');
            $id->cover_image = "/" . $imagePath;
        }
        $id->tags()->sync($request->input('tags'));
        dd($id);
        $id->save();
        return response()->json(['message' => 'Post has been updated successfuly']);
        }


    //radi
    public function delete(Blog $id){
        $id->delete();
        return response()->json(['message' => 'Post was successfuly deleted']);
    }


    //radi
    public function search(Request $request){
        $searchField = $request->searchField;
        $search = '%'. $searchField .'%' ?? "%";
        $posts = Blog::whereHas('user',function (Builder $query) use ($search) {
            $query->where('username','like', $search);
        })->orWhereHas('tags', function (Builder $query) use ($search){
            $query->where('name', 'like', $search);
        })
        ->orWhere('title','like', $search)->get();

        return $posts->load('tags')->loadCount('likes');
    }

    //radi
    public function displayUsersPosts(User $userid){
        return $userid->posts;
    }

    //radi
    public function displayPost(Blog $id){
        return $id->load('tags', 'comments')->loadCount('likes');
    }

    //radi
    public function displayTagPost(Tag $tagid){
        return $tagid->blogs;
    }


    

    //za provjeru likePost i unlikePost treba user token

    public function likePost(Request $request, Blog $id){
        $userId = $request->user_id;
        $hasUserLiked = $id->likes()->where('user_id', $userId)->exists();

        if(!$hasUserLiked){
            $id->likes()->create([
                'user_id' => $userId,
            ]);
        }

        return response()->json(['message' => 'Post liked successfully']);
    }

    //potrebno je sa auth::user()
    public function unlikePost(Request $request, Blog $id){
        $userId = $request->user_id;
        $hasUserLiked = $id->likes()->where('user_id', $userId)->exists();
        if($hasUserLiked){
            $id->likes()->delete();
        }

        return response()->json(['message' => 'Post unliked successfully']);
    }




}
