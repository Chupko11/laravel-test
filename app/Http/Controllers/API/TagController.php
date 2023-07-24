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

    public function blogsWithTags(Tag $id){
        return $id->blogs;
    }

}
