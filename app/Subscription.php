<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subscriptions';

    protected $fillable = ['user_id', 'stripe_id' ,'name', 'stripe_plan', 'braintree_id', 'braintree_plan', 'quantity', 'trial_ends_at', 'ends_at'];
}
