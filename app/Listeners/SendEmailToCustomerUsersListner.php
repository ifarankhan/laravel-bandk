<?php

namespace App\Listeners;

use App\Events\SendEmailToCustomerUsers;
use App\Mail\SendEmailToCustomerEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailToCustomerUsersListner
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
     * @param SendEmailToCustomerUsers $event
     */
    public function handle(SendEmailToCustomerUsers $event)
    {
        \Mail::to($event->email)->send(new SendEmailToCustomerEmail($event->customer, $event->claim, $event->email));
    }
}
