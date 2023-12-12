<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeatureSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feature_settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->nullable();
			$table->integer('tokens')->nullable();
			$table->string('billing_interval', 191)->nullable();
			$table->integer('amount_days')->nullable();
			$table->string('user_group', 191)->nullable();
			$table->string('visibility', 191)->nullable();
			$table->text('info', 65535)->nullable();
			$table->string('plan_id')->nullable();
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
		Schema::drop('feature_settings');
	}

}
