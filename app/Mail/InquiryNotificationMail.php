<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;

    /**
     * Create a new message instance.
     */
    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function build()
    {
        return $this->subject('新しいお問い合わせが届きました')
                    ->view('email.inquiry-notification')
                    ->with([
                        'inquiry' => $this->inquiry,
                    ]);
    }
}
