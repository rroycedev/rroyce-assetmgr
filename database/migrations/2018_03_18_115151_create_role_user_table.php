<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    	/**
     	 * Run the migrations.
     	 *
     	 * @return void
     	 */

    	public function up()
    	{
		Schema::create('role_user', function (Blueprint $table) {
		        $table->charset = 'utf8';
		        $table->collation = 'utf8_general_ci';


            		$table->increments('id');
    			$table->integer('role_id')->unsigned();
    			$table->integer('user_id')->unsigned();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
			$table->unique(array('role_id', 'user_id'));
        	});
    	}

    	/**
     	 * Reverse the migrations.
     	 *
     	 * @return void
     	 */
    
	public function down()
    	{
        	Schema::dropIfExists('role_user');
    	}
}

