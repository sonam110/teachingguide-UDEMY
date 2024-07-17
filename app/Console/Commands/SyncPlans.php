<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Braintree_Plan;
use App\Plan;

class SyncPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //////////////////////////////////
    ////////Run command : php artisan braintree:sync-plans
    //////////////////////////////////
    protected $signature = 'braintree:sync-plans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync with online plans on Braintree';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Empty table
        Plan::truncate();

        // Get plans from Braintree
        $braintreePlans = Braintree_Plan::all();
        //var_dump($braintreePlans);

        // Iterate through the plans while populating our table with the plan data
        foreach ($braintreePlans as $braintreePlan) {
            Plan::create([
                'name' => $braintreePlan->name,
                'slug' => str_slug($braintreePlan->name),
                'braintree_plan' => $braintreePlan->id,
                'cost' => $braintreePlan->price,
                'currency' => $braintreePlan->currencyIsoCode,
                'billing_frequency' => $braintreePlan->billingFrequency,
                'number_of_billing_cycles' => $braintreePlan->numberOfBillingCycles,
                'trial_duration' => $braintreePlan->trialDuration,
                'trial_duration_unit' => $braintreePlan->trialDurationUnit,
                'trial_period' => $braintreePlan->trialPeriod,
                'description' => $braintreePlan->description,
            ]);
        }
    }
}
