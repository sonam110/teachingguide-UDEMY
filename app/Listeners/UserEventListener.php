<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Carbon\Carbon;

class UserEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLoggedIn  $event
     * @return void
     */
    public function handle($event)
    {
        //dd("fired");
        $user = $event->user;
        $user->last_login = Carbon::now()->toDateTimeString();
        if (is_null($user->logins)) {
            $user->logins = 1;
        } else {
            $user->logins = $user->logins+1;
        }
        $user->save();
    }
}
