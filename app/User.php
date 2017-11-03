<?php

namespace App;

use Event;
// use App\Role;
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


    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'user_subscriptions', 'user_id', 'subscriber_id');
    }

    public function subscribed()
    {
        // Event::fire(new NewSubscriber('subscribe'));
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

    public function publish(Post $post, $tag)
    {
        $tag = str_replace(' ', ',', $tag);
        $tags = explode(',', $tag);
        $post = $this->posts()->save($post);

        foreach ($tags as $newTag) {
            if (strlen($newTag)) {
                $post->tags()->attach(Tag::firstOrCreate(['name' => trim($newTag)]));
            }
        }

        // Event::fire(new PostCreated($post));

        // Post::create([
        //     'title' => request('title'),
        //     'body'  => request('body'),
        //     'user_id' => auth()->user()->id
        // ]);
    }

    // public function roles()
    // {
    //     return $this->belongsToMany('Role')->withTimestamps();
    // }

    // public function hasRole($name)
    // {
    //     foreach ($this->roles as $role)
    //     {
    //         if ($role->name == $name) return true;
    //     }
    //     return false;
    // }

    // public function assignRole($role)
    // {
    //     return $this->roles()->attach($role);
    // }

    // public function removeRole($role)
    // {
    //     return $this->roles()->detach($role);
    // }

    public function getRouteKeyName()
    {
        return 'username';
    }
}
