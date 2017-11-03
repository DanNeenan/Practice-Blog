<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\User;
// use App\Role;
use App\Http\Requests;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    // public function index()
    // {
    //     $user = User::where('username')->first();
    //     return view('profiles.users');
    // }
    public function index()
    {
        $users = User::all();
        return view('profiles.users', ['users' => $users]);
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
            Image::make($avatar)
            ->resize(300, 300)
            ->save( public_path('/storage/avatars/' . $filename) );

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

            return view('profiles.show', [
                'profileUser' => $user,
                'posts' => $user->posts()->paginate(10)
            ]);
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

    // public function getRoles()
    // {
    //     $user = User::first()->roles()->attach();

    //     $user->assignRole(1);

    //     return $user->roles;
    // }


}
