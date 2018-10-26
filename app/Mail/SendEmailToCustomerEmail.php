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

    private $claim;
    /**
     * @var
     */
    private $email;

    /**
     * SendEmailToCustomerEmail constructor.
     * @param $customer
     * @param $claim
     * @param $email
     */
    public function __construct($customer, $claim, $email)
    {
        //
        $this->customer = $customer;
        $this->claim = $claim;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = '';

        if(!empty($this->customer->name)) {
            $subject = $this->customer->name;
        }
        if($this->claim->address1) {
            $subject = $subject . ', afd. '.$this->claim->address1->address;
        }
        if(!empty($this->claim->customer_policy_number)) {
            $subject = $subject . ' - police nr,: '.$this->claim->customer_policy_number;
        }
        if(!empty($this->claim->address_2)) {
            $subject = $subject . ' - '.$this->claim->address_2;
        }
        return $this->from('no_reply@bnk.com')
                    ->subject($subject)
                    ->with(
                        [
                            'customer'  => $this->customer,
                            'claim'   => $this->claim,
                            'email'     => $this->email,
                        ])
                    ->markdown('emails.send_email_to_customer');
    }
}
