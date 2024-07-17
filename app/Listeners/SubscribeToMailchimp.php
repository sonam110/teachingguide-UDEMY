<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribeToMailchimp
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $mailchimp;

    public function __construct(\Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**
     * https://blog.damirmiladinov.com/laravel/integrating-mailchimp-subscription-with-laravel.html#.W8jWM2gzaUk
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
      $user = $event->user;
      try {
        $this->mailchimp->lists->subscribe(
            env('MAILCHIMP_LIST_ID'),
            ['email' => $user->email],
            ['fname' => $user->first_name, 'lname' => $user->last_name],
            null,
            false
        );
      } catch (\Mailchimp_List_AlreadySubscribed $e) {
        // do nothing
      } catch (\Mailchimp_Error $e) {
        // do something
      }
    }
}
