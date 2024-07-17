<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaypalProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pr_id')->comment('Product table id');
            $table->string('plan_id')->nullable();
            $table->string('sub_name');
            $table->string('sub_sname');
            $table->string('sub_interval');
            $table->decimal('sub_price', 9, 2);
            $table->decimal('offer', 5, 2);
            $table->string('stripe_id')->comment('same as stipe plan name like: tg_free_monthly');
            $table->text('features');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paypal_products');
    }
}
