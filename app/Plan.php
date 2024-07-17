<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'slug', 'braintree_plan', 'cost', 'billing_frequency', 'number_of_billing_cycles', 'trial_duration', 'trial_duration_unit', 'trial_period', 'description','active', 'level'];


    public function getRouteKeyName()
	{
	  return 'slug';
	}
}
