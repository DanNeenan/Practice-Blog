<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Inspections\Spam;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Post $post, Spam $spam)
    {
        $this->validate(request(), ['body' => 'required|min:2']);

        $spam->detect(request('body'));

        $post->addComment(request('body'));

        return back();
    }

    public function destroy(Post $post, Comment $comment)
    {
        if (auth()->user()->id == $comment->user_id || auth()->user()->id == $comment->post_creater_id) {
            $comment->delete();
        }
        return back();
    }
}
