<?php

namespace App\Listeners;

use Session;
use App\Events\SendFlashMessageEvent;

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
