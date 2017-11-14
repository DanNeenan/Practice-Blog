<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class ProfilesSettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show()
    {
        return view('profiles.settings');
    }

    public function showChangeUsername()
    {
        return view('profiles.changeUsername');
    }

    public function updateUsername()
    {
        $this->validate(request(), [
            'username' => 'required|min:6|unique:users',
            'password' => 'required'
        ]);

        if (\Hash::check(request('password'), auth()->user()->password)) {
            $user = auth()->user();
            $user->update([
                'username' => request('username'),
            ]);
            $user->save();
            session()->flash('message', 'Username has been changed.');
            return redirect('/profiles/settings');
        }
        return redirect()->back()->withErrors([
            'message' => 'Please check you entered the right password'
        ]);
    }

    public function showChangePassword()
    {
        return view('profiles.changePassword');
    }

    public function updatePassword()
    {
        $this->validate(request(), [
            'password' => 'required',
            'password_new' => 'required|confirmed',

        ]);
        if (\Hash::check(request('password'), auth()->user()->password)) {
            $user = auth()->user();
            $user->update([
                'password' => bcrypt(request('password_new')),
            ]);
            $user->save();
            session()->flash('message', 'Password has been changed.');
            return redirect('/profiles/settings');
        }
        return redirect()->back()->withErrors([
            'message' => 'Please check you entered the right password'
        ]);
    }

    public function showChangeEmail()
    {
        return view('profiles.changeEmail');
    }

    public function updateEmail()
    {
        $this->validate(request(), [
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        if (\Hash::check(request('password'), auth()->user()->password)) {
            $user = auth()->user();
            $user->update([
                'email' => request('email'),
            ]);
            $user->save();
            session()->flash('message', 'Email has been changed.');
            return redirect('/profiles/settings');
        }
        return redirect()->back()->withErrors([
            'message' => 'Please check you entered the right password'
        ]);
    }

    public function showDeleteAccount()
    {
        return view('profiles.deleteAccount');
    }

    public function destroy(User $id)
    {
        $this->validate(request(), [
            'password' => 'required|confirmed'
        ]);

        $user = User::findOrFail($id);
        auth()->user()->subscribed()->detach(request('user_id'));
        auth()->user()->delete();

        session()->flash('message', 'Your account has been deleted.');
        return redirect('/');
    }
}
