<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trials', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->nullable();
			$table->integer('matcher_id')->nullable();
			$table->string('trial_date', 191)->nullable();
			$table->string('trial_time', 191)->nullable();
			$table->integer('trial_location_id')->nullable();
			$table->string('trial_family_role', 191)->nullable()->comment('Adopter Family Role');
			$table->string('adoptee_family_role', 191);
			$table->boolean('is_accepted')->default(0);
			$table->boolean('is_decline')->default(0);
			$table->integer('is_maybe')->default(0);
			$table->integer('is_ended')->default(0);
			$table->boolean('is_success')->default(0);
			$table->integer('adoption_success')->nullable()->default(0);
			$table->boolean('agree')->default(0);
			$table->dateTime('success_date');
			$table->timestamps();
			$table->integer('is_sent')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trials');
	}

}
