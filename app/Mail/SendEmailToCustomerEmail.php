<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailToCustomerEmail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    private $customer;
    /**
     * @var
     */
    private $claimId;
    /**
     * @var
     */
    private $userName;
    /**
     * @var
     */
    private $email;

    /**
     * SendEmailToCustomerEmail constructor.
     * @param $customer
     * @param $claimId
     * @param $userName
     * @param $email
     */
    public function __construct($customer, $claimId, $userName, $email)
    {
        //
        $this->customer = $customer;
        $this->claimId = $claimId;
        $this->userName = $userName;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no_reply@bnk.com')
                    ->with(
                        [
                            'customer'  => $this->customer,
                            'claimId'   => $this->claimId,
                            'userName'  => $this->userName,
                            'email'     => $this->email,
                        ])
                    ->markdown('emails.send_email_to_customer');
    }
}
