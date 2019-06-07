<?php

namespace App\Listeners;

use App\Events\SendFlashMessageEvent;
use Session;

class SendFlashMessageListener
{
    /**
     * Handle the event.
     *
     * @param  SendFlashMessageEvent  $event
     * @return void
     */
    public function handle(SendFlashMessageEvent $event)
    {
        Session::flash($event->type, $event->message);
    }
}
