<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsKeywordCpcKd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keyword', function (Blueprint $table) {
            $table->smallInteger('kd')->default(0)->after('gtrend12m_cat');
            $table->decimal('cps', 5, 2)->default(0)->after('kd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keyword', function (Blueprint $table) {
            $table->dropColumn('cps');
            $table->dropColumn('kd');
        });
    }
}
