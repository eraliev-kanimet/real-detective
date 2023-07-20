<?php

namespace App\Jobs;

use App\Models\Newsletter;
use App\Models\Subscribe;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewsletterJob implements ShouldQueue, ShouldBeUnique
{
    use InteractsWithQueue, Queueable;

    public static function dispatch(Newsletter $newsletter): void
    {
        $id = $newsletter->id;
        $key = 1;

        foreach (Subscribe::all('email')->pluck('email')->chunk(25) as $emails) {
            dispatch(new self($id . '_' . $key, $id, $emails->toArray()));

            $key++;
        }
    }

    public function __construct(
        protected readonly string $key,
        protected readonly int    $id,
        protected readonly array  $emails
    )
    {
    }

    public function handle(): void
    {
        $newsletter = Newsletter::find($this->id);

        if ($newsletter) {
            $subject = $newsletter->subject;
            $content = $newsletter->content;

            foreach ($this->emails as $email) {
                Mail::html($content, function ($message) use ($subject, $email) {
                    $message->to($email);
                    $message->subject($subject);
                });
            }
        }
    }

    public function uniqueId(): string
    {
        return $this->key;
    }
}
