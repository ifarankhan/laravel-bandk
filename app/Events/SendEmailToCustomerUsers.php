<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendEmailToCustomerUsers
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customer;
    public $claim;
    public $email;

    /**
     * SendEmailToCustomerUsers constructor.
     * @param $customer
     * @param $claim
     * @param $email
     */
    public function __construct($customer, $claim, $email)
    {
        $this->customer = $customer;
        $this->claim = $claim;
        $this->email = $email;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
