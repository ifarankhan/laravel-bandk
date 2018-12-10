<?php

namespace App\Listeners;

use App\Events\SendUpdatePasswordEmailEvent;
use App\Mail\SendUpdatePasswordEmailMail;


class SendUpdatePasswordEmailListner
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
     * @param SendUpdatePasswordEmailEvent $event
     */
    public function handle(SendUpdatePasswordEmailEvent $event)
    {
        \Mail::to($event->email)->send(new SendUpdatePasswordEmailMail($event->user, $event->email));
    }
}
