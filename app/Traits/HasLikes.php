<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasLikes
{
    public function hasUserLiked(): bool
    {
        return $this->likes()->where('user_id', auth()->user()->id)->exists();
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'item');
    }
}
