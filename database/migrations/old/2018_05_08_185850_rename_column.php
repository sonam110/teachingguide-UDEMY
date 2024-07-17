<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function($t) {
                      $t->renameColumn('insight_user', 'insight');
                      $t->renameColumn('compete_user', 'compete');
              });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function($t) {
                      $t->renameColumn('insight', 'insight_user');
                      $t->renameColumn('compete', 'compete_user');
              });
    }
}
