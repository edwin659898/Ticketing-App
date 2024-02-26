<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminResponse extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $sender;
    public $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket,$comments, $user)
    {
        $this->ticket = $ticket;
        $this->sender = $user;
        $this->comment = $comments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.AdminResponse')
        ->replyTo('liazurah@betterglobeforestry.com', 'Systems and Administration Manager');
    }
}
