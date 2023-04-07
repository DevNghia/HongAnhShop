<?php

namespace App\Mail\Authentication;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;

    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $email, string $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public
    function build()
    {
        return $this->subject(__('auth.verify_user'))
            ->view('mails.authentication.verify_user')
            ->with([
                'email' => $this->email,
                'token' => $this->token,
            ]);
    }
}
