<?php

namespace App\Mail;

use App\Models\Answer;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AnswerToApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Answer $answer;

    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function envelope()
    {
        $manager = User::first();
        return new Envelope(
            from: $manager->email,
            subject: 'Answered to application',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mails.answer-application',
        );
    }

    public function attachments()
    {
        return [];
    }
}
