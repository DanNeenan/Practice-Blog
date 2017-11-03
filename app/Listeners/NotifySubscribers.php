<?php

namespace App\Listeners;

use App\Events\PostCreatedBySubscribee;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySubscribers
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
     * @param  PostCreatedBySubscribee  $event
     * @return void
     */
    public function handle(PostCreatedBySubscribee $event)
    {
        //
    }
}
