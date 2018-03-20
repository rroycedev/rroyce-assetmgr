<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('password_resets', function (Blueprint $table) {
   	    $table->charset = 'utf8';
	    $table->collation = 'utf8_general_ci';

            $table->string('email', 200);
            $table->string('token');
            $table->timestamp('created_at')->nullable();
	    $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}
