<?php

namespace App\Http\Controllers;

use App\User;
use App\Events\NewSubscriber;
use Illuminate\Http\Request;
use Event;

class ProfilesSubscriptionController extends Controller
{
    public function store()
    {
        if (request()->has('subscribe')) {
            auth()->user()->subscribed()->attach(request('user_id'));
            $subscribee = User::findOrFail(request('user_id'));
            Event::fire(new NewSubscriber($subscribee));
        }
        if (request()->has('unsubscribe')) {
            auth()->user()->subscribed()->detach(request('user_id'));
        }


        return back();
    }
}
