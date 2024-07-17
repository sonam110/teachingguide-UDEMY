<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklySummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_weekly_summary', function (Blueprint $table) {
            $table->integer('week_of_year')->nullable();
            $table->integer('year')->nullable();
            $table->integer('students')->nullable();
            $table->integer('reviews')->nullable();
            $table->integer('courses')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_weekly_summary');
    }
}
