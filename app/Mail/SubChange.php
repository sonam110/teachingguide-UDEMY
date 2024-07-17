<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class SubChange extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $subscription;

    public function __construct($user, $subscription)
    {
        $this->user = $user;
        $this->subscription = $subscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $subject = ucwords($this->user->name) . ', your plan has been updated.';
      return $this->from('support@teachinguide.com')
                  ->view('mails.subchange')
                  ->subject($subject)
                  ->with([
                    'user' => $this->user,
                    'subscription' => $this->subscription
                  ]);
    }
}
