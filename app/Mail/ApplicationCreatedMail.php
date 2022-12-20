<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Application $application;
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function envelope()
    {
        return new Envelope(
            from: $this->application->user->email,
            // to: [''],
            subject: 'Application Created',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mails.application-created',
        );
    }

    public function attachments()
    {
        if($this->application->file_url) {
            return [
                Attachment::fromStorageDisk('public', $this->application->file_url)
            ];
        }
        return [];
    }
}
