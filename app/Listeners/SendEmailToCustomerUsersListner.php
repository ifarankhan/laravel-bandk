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
     * @return SendEmailToCustomerEmail
     */
    public function handle(SendEmailToCustomerUsers $event)
    {
        return new SendEmailToCustomerEmail($event->customer, $event->claim, $event->email);
    }
}
