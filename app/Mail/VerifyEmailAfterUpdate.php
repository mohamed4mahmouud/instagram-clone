<?php
namespace App\Mail;

use Illuminate\Mail\Mailables\Content;


class VerifyEmailAfterUpdate extends VerifyEmail
{
    public function content(): Content
    {
        return new Content(
            view: 'Mails.verifyemail',
            with:['token'=>$this->token , 'name'=>$this->name]
        );
    }
}
