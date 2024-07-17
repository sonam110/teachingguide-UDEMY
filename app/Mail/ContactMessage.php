<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $message;
    public $email;
    public $name;

    public function __construct($message, $email, $name)
    {
        $this->message = $message;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $subject = 'Website Contact Message from '.$this->name;
      $message = $this->message;
      return $this->from($this->email)
                  ->view('mails.contact', compact('message'))
                  ->subject($subject);
    }
}
