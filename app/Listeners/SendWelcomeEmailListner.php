<?php

namespace App\Listeners;

use App\Events\SendWelcomeEmailEvent;
use App\Mail\SendWelcomeEmailMail;

class SendWelcomeEmailListner
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
     * @param SendWelcomeEmailEvent $event
     */
    public function handle(SendWelcomeEmailEvent $event)
    {
        \Mail::to($event->email)->send(new SendWelcomeEmailMail($event->user, $event->email));
    }
}
