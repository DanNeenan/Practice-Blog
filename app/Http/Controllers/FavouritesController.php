<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class FavouritesController extends Controller
{
    protected $guarded= [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post, Comment $comment)
    {
        $comment->toggleFavourite();

        return back();
    }
}
