<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';


    protected $fillable = [
        'title',
        'body',
        'cover_image',
    ];

    public function tags(){
        return $this->belongsToMany(Tag::class, 'blog_tag');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}