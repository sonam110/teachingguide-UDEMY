<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class User extends Authenticatable
{
    use Notifiable, WebhookNotifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'stripe_id', 'member', 'student','insight', 'compete', 'first_name', 'last_name', 'coupon', 'affiliate_id', 'referred_by', 'last_login', 'logins', 'braintree_id', 'paypal_email','trial_ends_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPassword($token));
    }

    public function routeNotifiactionForMail()
    {
        return $this->email;
    }
}

class CustomPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('We are sending this email because we recieved a forgot password request.')
            ->action('Reset Password', url(config('app.url') . route('password.reset', $this->token, false)))
            ->line('If you did not request a password reset, no further action is required. Please contact us if you did not submit this request.');
    }
}
