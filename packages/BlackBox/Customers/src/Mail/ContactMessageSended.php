<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageSended extends Mailable
{
    use Queueable, SerializesModels;

    public ContactMessage $contact;

    public function __construct(ContactMessage $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $bcc = [];
        if (setting('email.bcc')) {
            $bcc = array_map(fn ($email) => new Address($email), setting('email.bcc'));
        }

        return new Envelope(
            from: new Address($this->contact->email, $this->contact->name),
            bcc: array_merge([
                new Address('grupoquimaira@gmail.com'),
            ], $bcc),
            subject: 'Mensaje de contacto enviado desde '.config('app.url'),
            to: [new Address(setting('email.email'))]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message',
        );
    }
}
