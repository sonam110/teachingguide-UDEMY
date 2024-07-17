<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->integer('coupon_for')->after('id')->nullable()->comment('Plan Id');
            $table->integer('used')->after('number_of_billing_cycles')->nullable();
            $table->string('upgrade_coupon')->after('used')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->dropColumn('coupon_for');
            $table->dropColumn('used');
            $table->dropColumn('upgrade_coupon');
        });
    }
}
