<?php

namespace App\Listeners;

use App\Events\PostCreatedEvent;
use App\Models\Subscription;
use App\Notifications\PostCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendPostNotification implements ShouldQueue
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
     * @param  \App\Providers\PostCreatedEvent  $event
     * @return void
     */
    public function handle(PostCreatedEvent $event)
    {
        $post = $event->post;
        $subscribers = $post->website->subscriptions;

        Notification::send($subscribers, new PostCreatedNotification($post));
    }
}
