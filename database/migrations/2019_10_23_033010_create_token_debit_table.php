<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTokenDebitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('token_debit', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->nullable();
			$table->integer('token')->nullable();
			$table->integer('user_id')->nullable();
			$table->string('featured_id')->nullable();
			$table->string('connection', 191)->nullable();
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
		Schema::drop('token_debit');
	}

}
