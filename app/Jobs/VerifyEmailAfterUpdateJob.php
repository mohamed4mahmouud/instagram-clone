<?php

use App\Jobs\VerifyEmailJob;
use App\Mail\VerifyEmailAfterUpdate;
use Illuminate\Support\Facades\Mail;

class VerifyEmailAfterUpdateJob extends VerifyEmailJob
{
    public function handle(): void
    {
            Mail::to(parent::$email)->send(new VerifyEmailAfterUpdate(parent::$name,parent::$token))->cc('hamo@gmail.com')
            ->bcc('hamo2@gmail.com');
    }
}
