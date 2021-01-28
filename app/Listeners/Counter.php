<?php

namespace App\Listeners;

use App\Events\PostHasViewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Counter
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
     * @param  PostHasViewed  $event
     * @return void
     */
    public function handle(PostHasViewed $event)
    {
        $event->article->increment('view_count');
    }
}
