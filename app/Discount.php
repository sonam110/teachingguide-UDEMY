<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['coupon_for', 'name', 'slug', 'discount_id', 'amount', 'description', 'type', 'never_expires', 'number_of_billing_cycles', 'used', 'upgrade_coupon'];

    protected $casts = ['never_expires' => 'boolean'];
}
