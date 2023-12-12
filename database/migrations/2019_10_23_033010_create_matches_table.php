<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matches', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('is_trial')->nullable()->default(0);
			$table->integer('user_id');
			$table->integer('matcher_id')->comment('Request Accepter');
			$table->boolean('is_match');
			$table->boolean('is_decline');
			$table->timestamps();
			$table->boolean('is_seen')->nullable()->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matches');
	}

}
