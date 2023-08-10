<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $number;
    public string $question;

    public function __construct($name, $number, $question)
    {
        $this->name = $name;
        $this->number = $number;
        $this->question = $question;
    }

    public function build()
    {
        return $this->subject(config('app.name') . ' - Форма с сайта')
            ->view('emails.contact-form');
    }
}
