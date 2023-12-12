<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrialLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trial_locations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('image', 191);
			$table->text('description', 65535);
			$table->text('address', 65535);
			$table->integer('status');
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
		Schema::drop('trial_locations');
	}

}
