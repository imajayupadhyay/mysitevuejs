<?php

namespace App\Mail;

use App\Models\ServiceInquiry;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServiceInquiryReceived extends Mailable
{
    use SerializesModels;

    public function __construct(public ServiceInquiry $inquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Service Inquiry — ' . $this->inquiry->service . ' from ' . $this->inquiry->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.service-inquiry',
        );
    }
}
