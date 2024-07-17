<?php

namespace App\Notifications;

use App\Channels\WebhookChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Log;

class ApifyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var array string
     */
    private $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
        //Log::info($message);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebhookChannel::class, 'database'];  //'mail'
    }


    public function toWebhook($notifiable)
    {
        return [
            'id'            => $this->message['id'],
            'actId'         => $this->message['actId'],
            'data'          => $this->message['data'],
            'detailsUrl'    => $this->message['detailsUrl'],
            'resultsUrl'    => $this->message['resultsUrl'],
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('This is test webhook notification')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id'            => $this->message['id'],
            'actId'         => $this->message['actId'],
            'data'          => $this->message['data'],
            'detailsUrl'    => $this->message['detailsUrl'],
            'resultsUrl'    => $this->message['resultsUrl'],
        ];
    }
}
