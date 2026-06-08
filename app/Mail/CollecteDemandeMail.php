<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CollecteDemandeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $data) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle demande de collecte — ' . $this->data['nom'],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.collecte-demande',
            with: ['data' => $this->data],
        );
    }
}
