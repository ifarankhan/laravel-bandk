<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmailMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    private $user;

    private $email;

    /**
     * SendWelcomeEmailMail constructor.
     * @param $user
     * @param $email
     */
    public function __construct($user, $email)
    {
        //
        $this->user = $user;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Velkommen til Bækmark & Kvists skadeanmeldelsessystem';
        return $this->from("no_reply@mail.insurance.bk-as.dk")
                    ->subject($subject)
                    ->with(
                        [
                            'user'  => $this->user,
                            'email'     => $this->email,
                        ])
                    ->markdown('emails.new_user_email');
    }
}
