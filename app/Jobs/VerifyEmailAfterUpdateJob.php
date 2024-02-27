<?php

namespace App\Jobs;

use App\Mail\VerifyEmailAfterUpdate;
use Illuminate\Support\Facades\Mail;

class VerifyEmailAfterUpdateJob extends VerifyEmailJob
{
    public function handle(): void
    {
        Mail::to($this->email)
            ->cc('hamo@gmail.com')
            ->bcc('hamo2@gmail.com')
            ->send(new VerifyEmailAfterUpdate($this->name, $this->token));
    }
}
