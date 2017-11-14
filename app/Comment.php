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
        return $this->belongsTo(User::Class);
    }

    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favourited');
    }

    public function toggleFavourite()
    {
        $attributes = ['user_id' => auth()->user()->id];
        if(! $this->favourites()->create($attributes)->exists()) {
            $this->favourites()->create($attributes);
        } elseif($this->favourites()->create($attributes)->exists()) {
            $this->favourites()->delete();
        }
    }

    public function isFavourited()
    {
        return $this->favourites()->where('user_id', auth()->id())->exists();
    }
}
