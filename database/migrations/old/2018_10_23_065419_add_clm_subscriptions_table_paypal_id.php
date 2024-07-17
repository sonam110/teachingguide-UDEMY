<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClmSubscriptionsTablePaypalId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->string('paypal_id')->after('stripe_id')->nullable()->comment('For paypal payment');
            $table->string('plan_id')->after('paypal_id')->nullable()->comment('For paypal payment ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('paypal_id');
            $table->dropColumn('plan_id');
        });
    }
}
