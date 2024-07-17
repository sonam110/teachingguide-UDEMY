<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClmUsersTablePaypalId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('paypal_id')->after('stripe_id')->nullable()->comment('For paypal payment');
            $table->string('payer_id')->after('paypal_id')->nullable()->comment('For paypal payment ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('paypal_id');
            $table->dropColumn('payer_id');
        });
    }
}
