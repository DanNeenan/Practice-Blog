<?php

namespace App\Listeners;

use App\User;
use App\Mail\NewPost;
use App\Events\PostCreatedBySubscribee;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySubscribers
{

    public $user;
    public $post;
    public $subscribers;
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
     * @param  PostCreatedBySubscribee  $event
     * @return void
     */
    public function handle(PostCreatedBySubscribee $event)
    {
        $subscribers = $event->post->user->subscribers;
        foreach ($subscribers as $subscriber) {
            \Mail::to($subscriber)->send(new NewPost($subscriber, $event->post));
        }
    }
}
