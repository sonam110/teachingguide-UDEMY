<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalProduct extends Model
{
    protected $fillable = ['pr_id', 'plan_id', 'sub_name', 'sub_sname', 'sub_interval', 'sub_price','offer', 'stripe_id', 'features'];
}
