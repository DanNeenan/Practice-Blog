<?php

namespace App\Listeners;

use App\User;
use App\Mail;
use App\Events\NewSubscriber;
use App\Mail\NewSubscriber as SubscriberMailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySubscribee
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewSubscriber  $event
     * @return void
     */
    public function handle(NewSubscriber $event)
    {
        \Mail::to($event->user)->send(new SubscriberMailable($event->user));
    }
}
