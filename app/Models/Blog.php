<?php

namespace App\Models;

use App\Traits\HasLikes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    use HasLikes;

    protected $table = 'blogs';


    protected $fillable = [
        'title',
        'body',
        'cover_image',
    ];

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comments::class);
    }
}
