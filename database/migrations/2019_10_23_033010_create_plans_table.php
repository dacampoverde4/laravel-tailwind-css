<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('plan_id', 191);
			$table->string('name', 191);
			$table->text('description', 65535)->nullable();
			$table->integer('price');
			$table->string('billing_interval', 191);
			$table->string('trial_period', 191)->nullable();
			$table->string('features', 191);
			
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
		Schema::drop('plans');
	}

}
