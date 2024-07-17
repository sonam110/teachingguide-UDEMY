<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class PaypalHistory extends Model
{
    protected $fillable = [
        'user_id', 'paypal_id', 'plan_id', 'amount', 'stripe_plan'
    ];

    public function getUserPaypal()
	{
	    return $this->belongsTo(User::class, 'user_id', 'id');
	}

}
