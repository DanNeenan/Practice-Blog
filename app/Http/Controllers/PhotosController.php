<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\Post;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function store(Post $post, Request $request)
    {
        if ($request->hasFile('post_image')) {
            $posts_image = $request->file('post_image');
            $filename = time() . '.' . $posts_image->getClientOriginalExtension();
            Image::make($posts_image)
                ->save( public_path('/storage/post_images/' . $filename) );

            $post->posts_image = $filename;
            $post->save();
        }
        return redirect()->back();
    }
}
