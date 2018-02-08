<?php

namespace App;

class Comment extends Model
{
    protected $guarded =[];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favourited');
    }

    public function toggleFavourite()
    {
        $attributes = ['user_id' => auth()->user()->id];

        if($this->isFavourited()) {
             return $this->favourites()->delete($attributes);
        }

        return $this->favourites()->create($attributes);
    }

    public function isFavourited()
    {
        return $this->favourites()->where('user_id', auth()->id())->exists();
    }
}
