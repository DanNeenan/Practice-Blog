<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use App\Post;
use App\Repositories\Posts;
use App\Inspections\Spam;
use Carbon\Carbon;

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
        //one way to save a form
        // Create a new post using the request data
        // $post = new Post;

        // $post->title = request('title');
        // $post->body = request('body');
        // save it to the database
        // $post->save();

        $spam->detect(request('body'));

        auth()->user()->publish(
            new Post(request(['title', 'body'])),
            request('tag')
        );

        session()->flash('message', 'Your post has now been published.');

        //and then redirect to the home page
        return redirect('/');
    }

    public static function destroy($id)
    {
        $posts = Post::findOrFail($id);
        $posts->comments()->delete();
        $posts->tags()->detach();
        $posts->delete();

        session()->flash('message', 'Your post has been deleted.');
        return redirect('/');
    }
}
