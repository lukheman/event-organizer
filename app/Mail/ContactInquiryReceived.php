<?php

namespace App\Mail;

use App\Models\ContactInquiry;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactInquiryReceived extends Mailable
{
    public function __construct(public ContactInquiry $inquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Inquiry kontak baru dari '.$this->inquiry->name);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contact-inquiry-received');
    }
}
