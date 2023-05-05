<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class LoginMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function build()
    {
        $apiVerifyUrl = URL::signedRoute('email_otp_verify', ['userId' => $this->userId]);
        $signatureQuery = parse_url($apiVerifyUrl)['query'];
        $frontendCallBackUrl = env("FRONTEND_CALLBACK_URL") . '/verify/mail-otp?' . $signatureQuery;
        return $this->subject('Login Notification')
            ->markdown('emails.login', [
                'url' => $frontendCallBackUrl
            ]);
    }
}
