<?php

namespace App\Models;

use App\Traits\HasLikes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    use HasLikes;

    protected $fillable = [
        'content',
    ];

    public function user(){
        return $this->belongsTo(User::class);

    }

    public function blogs(){
        return $this->belongsTo(Blog::class);
    }

    public function replies(){
        return $this->hasMany(Comments::class, 'parent_id');
    }
}
