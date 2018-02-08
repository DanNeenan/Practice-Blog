<?php

namespace App;

use Carbon\Carbon;

class Post extends Model
{
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->hasOne(Images::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addComment($body)
    {
        if (!auth()->check()) {
            return $this->comments()->create([
                'body' => $body,
            ]);
        }

        return $this->comments()->create([
            'body' => $body,
            'user_id' => auth()->user()->id
        ]);


        // Comment::create([
        //     'body' => $body,
        //     'post_id' => $this->id
        // ]);
    }

    public function scopeFilter($query, $filters)
    {
        if(!empty($filters)) {
            if ($month = $filters['month']) {
                $query->whereMonth('created_at', Carbon::parse($month)->month);
            }
            if ($year = $filters['year']) {
                $query->whereYear('created_at', $year);
            }
        }
    }

    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();

        return view('posts.index', compact('posts'));
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(UserSubscribtion::class);
    }
}
