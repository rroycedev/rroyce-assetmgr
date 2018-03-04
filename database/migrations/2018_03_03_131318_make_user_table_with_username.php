<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeUserTableWithUsername extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('uid', 60)->after('id');
            $table->dropColumn('name');
            $table->string('first_name', 60)->after('uid');
            $table->string('last_name', 60)->after('first_name');
            $table->unique('uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function($table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('uid');
            $table->string('name', 255)->after('id');
        });
    }
}
