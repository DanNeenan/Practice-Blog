<?php

namespace App;

use Event;
use Image;
use App\Events\PostCreated;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'about', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'user_subscriptions', 'user_id', 'subscriber_id');
    }

    public function subscribed()
    {
        return $this->belongsToMany(User::class, 'user_subscriptions', 'subscriber_id', 'user_id');
    }

    public function isSubscribed(User $user)
    {
        return $this->subscribed()->where('user_id', $user->id)->exists();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function publish(Post $post, $tag, $image = null)
    {
        $tag = str_replace(' ', ',', $tag);
        $tags = explode(',', $tag);
        $post = $this->posts()->save($post);

        foreach ($tags as $newTag) {
            if (strlen($newTag)) {
                $post->tags()->attach(Tag::firstOrCreate(['name' => trim($newTag)]));
            }
        }

        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();

            Image::make($image)
                ->save( public_path('/storage/post_images/' . $filename) );

            $post->posts_image = $filename;
            $post->save();
        }

        return $post;
    }

    public function scopeFilter($query, $filters)
    {
        if(!empty($filters)) {
            if ($letter = $filters['letter']) {
                $query->where('username', 'LIKE', $letter.'%');
            }
        }
    }

    public function roles()
    {
        return $this->belongsToMany('Role')->withTimestamps();
    }

    public function hasRole($name)
    {
        foreach ($this->roles as $role)
        {
            if ($role->name == $name) return true;
        }
        return false;
    }

    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    public function getRouteKeyName()
    {
        return 'username';
    }
}
