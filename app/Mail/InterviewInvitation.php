<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterviewInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $date;
    public $pesan;

    /**
     * Create a new message instance.
     */
    public function __construct($application, $date, $pesan)
    {
        $this->application = $application;
        $this->date = $date;
        $this->pesan = $pesan;
    }

    public function build()
    {
        return $this->subject('Undangan Interview - ' . $this->application->job->title)
            ->view('email.interview');
    }
}
