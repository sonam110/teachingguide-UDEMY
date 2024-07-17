<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Braintree_Discount;
use App\Discount;

class SyncDiscount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //////////////////////////////////
    ////////Run command : php artisan braintree:sync-discount
    //////////////////////////////////
    protected $signature = 'braintree:sync-discount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync with online discounts on Braintree';

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
        Discount::truncate();

        // Get Discout from Braintree
        $braintreeDiscounts = Braintree_Discount::all();
        //var_dump($braintreeDiscounts);

        // Iterate through the discounts while populating our table with the discount data
        foreach ($braintreeDiscounts as $braintreeDiscount) {
            Discount::create([
                'name' => $braintreeDiscount->name,
                'slug' => str_slug($braintreeDiscount->name),
                'discount_id' => $braintreeDiscount->id,
                'amount' => $braintreeDiscount->amount,
                'description' => $braintreeDiscount->description,
                'type' => $braintreeDiscount->kind,
                'never_expires' => $braintreeDiscount->neverExpires,
                'number_of_billing_cycles' => $braintreeDiscount->numberOfBillingCycles
            ]);
        }
    }
}
