<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Repositories\Posts;
use App\Inspections\Spam;
use Carbon\Carbon;
use App\Events\PostCreatedBySubscribee;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Spam $spam)
    {
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        $spam->detect(request('title'));

        $spam->detect(request('body'));

        $post = auth()->user()->publish(
            new Post(request(['title', 'body'])),
            request('tag'),
            request('post_image') ?? null
        );

        \Event::fire(new PostCreatedBySubscribee($post));

        session()->flash('message', 'Your post has now been published.');

        //and then redirect to the home page
        return redirect('/');
    }

    public static function destroy($id)
    {
        $post = Post::findOrFail($id);
        // $this->authorize('update', $post);
        if (auth()->user()->id == $post->user_id) {
            $post->comments()->delete();
            $post->tags()->detach();
            $post->delete();
            session()->flash('message', 'Your post has been deleted.');
            return redirect('/');
        }
        return back('');
    }
}
