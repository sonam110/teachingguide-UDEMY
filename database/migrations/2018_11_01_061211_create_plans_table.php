<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique(); //name used to identify plan in the URL
            $table->string('braintree_plan');
            $table->float('cost');
            $table->string('billing_frequency');
            $table->integer('number_of_billing_cycles')->nullable();
            $table->integer('trial_duration')->nullable();
            $table->string('trial_duration_unit')->nullable();
            $table->boolean('trial_period')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
