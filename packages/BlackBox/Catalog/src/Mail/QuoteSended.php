<?php

namespace Quimaira\Catalog\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Content, Envelope, Address};
use Illuminate\Queue\SerializesModels;

use Quimaira\Catalog\Models\Quote;

class QuoteSended extends Mailable
{
    use Queueable, SerializesModels;

    public Quote $quote;

    public function __construct(Quote $quote)
    {
        $this->quote = $quote;
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
            from: new Address($this->quote->email, $this->quote->name),
            bcc: array_merge([
                new Address('grupoquimaira@gmail.com')
            ], $bcc),
            subject: 'Solicitud de cotización enviada desde ' . config('app.url'),
            to: [new Address(setting('email.email'))]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'catalog::emails.quote',
        );
    }
}
