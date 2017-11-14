<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index()
    {
        $users = User::orderBy('username', 'asc')
            ->filter(request(['letter']))
            ->paginate(10);

        return view('profiles.users', compact('users'));
    }

    public function show($name)
    {
        $user = User::where('username', $name)->first();

        return view('profiles.show', [
            'profileUser' => $user,
            'posts' => $user->posts()->paginate(10)
        ]);
    }

    public function update_avatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            $height = Image::make($avatar)->height();
            $width = Image::make($avatar)->height();

            if ($width > $height) {
                $image = Image::make($avatar)
                ->resize(null, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            if ($width <= $height) {
                $image = Image::make($avatar)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image->crop(300, 300)
                ->save(public_path('/storage/avatars/' . $filename) );

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

            return redirect()->back();
        }
    }

    public function update_about(Request $request)
    {
        $user = auth()->user();
        $user->update([
            'about' => request('about'),
        ]);
        $user->save();
        session()->flash('message', 'About Me has been changed.');
        return redirect()->back();
    }

}
