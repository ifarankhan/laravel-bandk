<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

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
            $subject = $subject . ', '.$this->claim->address1->address;
        }
        if(!empty($this->claim->address_2)) {
            $subject = $subject . ' - Nr/Etage/Side: '.$this->claim->address_2;
        }
        if(!empty($this->customer->policy_number)) {
            $subject = $subject . ' - police nr.: '.$this->customer->policy_number;
        }
        if(!empty($this->claim->selsskab_skade_nummer)) {
            $subject = $subject . ' - skade nr.: '.$this->claim->selsskab_skade_nummer;
        }

        return $this->from('no_reply@bnk.com')
                    ->subject($subject)
                    ->with(
                        [
                            'customer'  => $this->customer,
                            'claim'   => $this->claim,
                            'email'     => $this->email,
                            'images' => $this->claim->images ? $this->claim->images : new Collection()
                        ])
                    ->markdown('emails.send_email_to_customer');
    }
}
