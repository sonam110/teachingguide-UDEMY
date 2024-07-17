<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCourseBacklinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_links', function (Blueprint $table) {
            $table->unsignedInteger('course_id');
            $table->smallInteger('bl')->default(0);
            $table->smallInteger('dr')->default(0);
            $table->smallInteger('ur')->default(0);
            $table->smallInteger('domains')->default(0);
            $table->unsignedInteger('ext')->default(0);
            $table->unsignedInteger('int')->default(0);
            $table->unsignedInteger('traffic')->default(0);
            $table->smallInteger('kw')->default(0);
            $table->unsignedInteger('age');
            $table->string('link_type');
            $table->string('ref_page');
            $table->string('ref_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_links');
    }
}
